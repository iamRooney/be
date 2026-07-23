<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.listings.products.index');
    }

    public function show($id)
    {
        return view('admin.listings.products.show');
    }
}
