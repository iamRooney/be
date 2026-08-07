<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\CompanyDocumentController as SellerCompanyDocumentController;
use App\Models\CompanyDocument;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Admin review queue for seller identity/legal documents (Aadhar, PAN,
 * GST certificate, etc). Approving/rejecting is the only state change
 * an admin makes here — the file itself was already validated and
 * stored by the seller-facing upload (see Api\CompanyDocumentController).
 */
class CompanyDocumentController extends Controller
{
    public function index(Request $request)
    {
        $documents = CompanyDocument::with(['company:id,name,slug', 'reviewer:id,name'])
            ->when($request->query('status'), fn ($q, $status) => $q->where('status', $status))
            ->when($request->query('type'), fn ($q, $type) => $q->where('type', $type))
            ->when($request->query('company_id'), fn ($q, $companyId) => $q->where('company_id', $companyId))
            ->latest()
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $documents,
        ]);
    }

    /** Stream a document's file so the admin can view/download it. */
    public function show(CompanyDocument $document): Response
    {
        return SellerCompanyDocumentController::streamDocument($document);
    }

    public function approve(Request $request, CompanyDocument $document)
    {
        $document->update([
            'status' => 'approved',
            'notes' => null,
            'reviewed_by' => $request->user()->id,
            'reviewed_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Document approved.',
            'data' => $document->fresh(['company:id,name,slug', 'reviewer:id,name']),
        ]);
    }

    public function reject(Request $request, CompanyDocument $document)
    {
        $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $document->update([
            'status' => 'rejected',
            'notes' => $request->input('notes'),
            'reviewed_by' => $request->user()->id,
            'reviewed_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Document rejected.',
            'data' => $document->fresh(['company:id,name,slug', 'reviewer:id,name']),
        ]);
    }
}
