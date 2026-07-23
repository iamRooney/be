<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        return view('admin.companies.index');
    }

    public function show(string $id)
    {
        return view('admin.companies.show');
    }
}
