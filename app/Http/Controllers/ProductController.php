<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

/**
 * Public, read-only product listing — only ever returns approved products.
 * Sellers manage their own (including pending/rejected) via
 * Api\ProductController; admins moderate via Api\Admin\ProductController.
 */
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['company', 'category'])
            ->where('status', 'approved');

        if ($request->boolean('featured')) {
            $query->where('featured', true);
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->string('category'));
            });
        }

        $limit = min($request->integer('limit', 20), 50);

        return response()->json(
            $query->latest()->limit($limit)->get()
        );
    }

    public function show(string $slug)
    {
        $product = Product::with(['company.city', 'company.state', 'company.country', 'category'])
            ->where('slug', $slug)
            ->where('status', 'approved')
            ->firstOrFail();

        $product->increment('views');

        return response()->json($product);
    }
}
