<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Services\Admin\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $products = $this->service->getAll($request->all());

        $categories = Category::orderBy('name')->get();

        $companies = Company::orderBy('name')->get();

        return view('admin.listings.products.index', compact(
            'products',
            'categories',
            'companies'
        ));
    }

    public function create()
    {
        $companies = Company::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.listings.products.create', compact('companies', 'categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $this->service->store($request->validated());

        return redirect()
            ->route('admin.listings.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $product->load(['company', 'category']);

        return view('admin.listings.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $companies = Company::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.listings.products.edit', compact(
            'product',
            'companies',
            'categories'
        ));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->service->update($product, $request->validated());

        return redirect()
            ->route('admin.listings.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $this->service->delete($product);

        return redirect()
            ->route('admin.listings.products.index')
            ->with('success', 'Product deleted successfully.');
    }
    public function approve(Product $product)
    {
        $product->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Product approved successfully.');
    }

    public function reject(Product $product)
    {
        $product->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', 'Product rejected successfully.');
    }

    public function toggleFeatured(Product $product)
    {
        $product->update([
            'featured' => !$product->featured,
        ]);

        return redirect()
            ->back()
            ->with('success', $product->featured
                ? 'Product marked as featured.'
                : 'Product removed from featured.');
    }
}
