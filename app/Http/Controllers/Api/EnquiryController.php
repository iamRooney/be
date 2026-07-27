<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnquiryRequest;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    public function store(StoreEnquiryRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();

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
