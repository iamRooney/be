<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnquiryRequest;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        $enquiries = Enquiry::where('user_id', $request->user()->id)
            ->with([
                'company:id,name,slug,logo',
                'product:id,name,slug,image',
                'service:id,name,slug',
            ])
            ->orderByDesc('created_at')
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

        return response()->json([
            'success' => true,
            'message' => 'Enquiry submitted successfully.',
            'data' => $enquiry,
        ], 201);
    }
}
