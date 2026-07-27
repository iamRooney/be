<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreServiceRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\Service;
use App\Services\Admin\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected ServiceService $service;

    public function __construct(ServiceService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $services = $this->service->getAll($request->all());

        $categories = Category::orderBy('name')->get();

        $companies = Company::orderBy('name')->get();

        return view('admin.listings.services.index', compact(
            'services',
            'categories',
            'companies'
        ));
    }

    public function create()
    {
        $companies = Company::orderBy('name')->get();

        $categories = Category::orderBy('name')->get();

        return view('admin.listings.services.create', compact(
            'companies',
            'categories'
        ));
    }

    public function store(StoreServiceRequest $request)
    {
        $this->service->store($request->validated());

        return redirect()
            ->route('admin.listings.services.index')
            ->with('success', 'Service created successfully.');
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

    public function edit(Service $service)
    {
        $companies = Company::orderBy('name')->get();

        $categories = Category::orderBy('name')->get();

        return view('admin.listings.services.edit', compact(
            'service',
            'companies',
            'categories'
        ));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $this->service->update($service, $request->validated());

        return redirect()
            ->route('admin.listings.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $this->service->delete($service);

        return redirect()
            ->route('admin.listings.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    public function approve(Service $service)
    {
        $service->update([
            'status' => 'approved'
        ]);

        return back()->with(
            'success',
            'Service approved successfully.'
        );
    }

    public function reject(Service $service)
    {
        $service->update([
            'status' => 'rejected'
        ]);

        return back()->with(
            'success',
            'Service rejected successfully.'
        );
    }

    public function toggleFeatured(Service $service)
    {
        $service->update([
            'featured' => !$service->featured,
        ]);

        return back()->with(
            'success',
            $service->featured
                ? 'Service marked as featured.'
                : 'Service removed from featured.'
        );
    }
}
