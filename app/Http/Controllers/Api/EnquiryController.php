<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnquiryRequest;
use App\Mail\EnquiryReceivedMail;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EnquiryController extends Controller
{
    /**
     * The buyer's own enquiries — powers "My Enquiries" and the
     * dashboard overview. Sellers don't have a user_id on enquiries
     * (they're always the buyer side), so this is buyer-only.
     */
    public function index(Request $request)
    {
        if ($request->user()->role !== 'buyer') {
            abort(403, 'Only buyers can view their enquiries.');
        }

        $limit = min($request->integer('limit', 50), 100);

        $enquiries = $request->user()
            ->enquiries()
            ->with(['company', 'product', 'service'])
            ->latest()
            ->limit($limit)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $enquiries,
        ]);
    }

    public function store(StoreEnquiryRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = $request->user()->id;

        $data['status'] = 'open';

        $data['priority'] = $data['priority'] ?? 'medium';

        $enquiry = Enquiry::create($data);

        $this->notifySeller($enquiry);

        return response()->json([
            'success' => true,
            'message' => 'Enquiry submitted successfully.',
            'data' => $enquiry,
        ], 201);
    }

    /**
     * Best-effort — a failed mail send should never fail the enquiry
     * submission itself.
     */
    private function notifySeller(Enquiry $enquiry): void
    {
        $enquiry->loadMissing(['company', 'product', 'service']);

        $companyEmail = $enquiry->company?->email;

        if (! $companyEmail) {
            return;
        }

        try {
            Mail::to($companyEmail)->send(new EnquiryReceivedMail($enquiry));
        } catch (\Throwable $e) {
            Log::warning('Failed to send enquiry notification email', [
                'enquiry_id' => $enquiry->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
