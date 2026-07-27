<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function store(Request $request)
    {
        return response()->json([
            'success' => true,
            'received' => $request->all(),
        ]);
    }
}
