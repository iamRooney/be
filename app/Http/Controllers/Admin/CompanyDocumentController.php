<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\CompanyDocumentController as ApiCompanyDocumentController;
use App\Http\Controllers\Controller;
use App\Models\CompanyDocument;
use Illuminate\Http\Request;

class CompanyDocumentController extends Controller
{
    /**
     * Stream the document for the admin to view/download. Reuses the
     * same hardened streaming logic the seller-facing controller uses
     * — the file is only ever served through an authenticated action,
     * never a direct public URL.
     */
    public function show(CompanyDocument $document)
    {
        return ApiCompanyDocumentController::streamDocument($document);
    }

    public function approve(CompanyDocument $document)
    {
        $document->update([
            'status' => 'approved',
            'notes' => null,
            'reviewed_by' => auth('admin')->id(),
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Document approved.');
    }

    public function reject(Request $request, CompanyDocument $document)
    {
        $request->validate([
            'notes' => 'required|string|max:500',
        ]);

        $document->update([
            'status' => 'rejected',
            'notes' => $request->input('notes'),
            'reviewed_by' => auth('admin')->id(),
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Document rejected.');
    }
}
