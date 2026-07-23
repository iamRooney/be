<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class EnquiryController extends Controller
{
    public function index()
    {
        return view('admin.enquiries.index');
    }

    public function show($id)
    {
        return view('admin.enquiries.show');
    }
}
