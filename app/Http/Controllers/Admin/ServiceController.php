<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::with([
            'company',
            'category'
        ]);

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {

            $query->where('category_id', $request->category);
        }

        if ($request->filled('company')) {

            $query->where('company_id', $request->company);
        }

        if ($request->filled('status')) {

            $query->where('status', $request->status);
        }

        if ($request->filled('featured')) {

            $query->where('featured', $request->featured);
        }

        $services = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        $companies = Company::orderBy('name')->get();

        return view('admin.listings.services.index', compact(
            'services',
            'categories',
            'companies'
        ));
    }

    public function show(Service $service)
    {
        $service->load([
            'company',
            'category'
        ]);

        return view(
            'admin.listings.services.show',
            compact('service')
        );
    }
}
