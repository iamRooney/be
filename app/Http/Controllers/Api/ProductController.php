<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Seller-facing product management.
 *
 * Scoped entirely to the authenticated seller's own company — a seller
 * can never see or touch another company's products. Admin-only actions
 * (approve/reject/feature) live in Api\Admin\ProductController.
 */
class ProductController extends Controller
{
    private function sellerCompany(Request $request)
    {
        $user = $request->user();

        if (! $user || $user->role !== 'seller') {
            return null;
        }

        return $user->company;
    }

    public function index(Request $request)
    {
        $company = $this->sellerCompany($request);

        if (! $company) {
            return response()->json([
                'success' => false,
                'message' => 'Only sellers with a company profile can manage products.',
            ], 403);
        }

        $products = $company->products()
            ->with('category')
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $company = $this->sellerCompany($request);

        if (! $company) {
            return response()->json([
                'success' => false,
                'message' => 'Only sellers with a company profile can add products. Complete your seller profile first.',
            ], 403);
        }

        $data = $request->validated();
        $data['company_id'] = $company->id;

        // New products always start pending — admins approve/reject them.
        $data['status'] = 'pending';
        $data['featured'] = false;

        if (! empty($data['image'])) {
            $data['image'] = $data['image']->store('products', 'public');
        }

        $product = Product::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Product submitted for approval.',
            'data' => $product->fresh('category'),
        ], 201);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $company = $this->sellerCompany($request);

        if (! $company || $product->company_id !== $company->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.',
            ], 403);
        }

        $data = $request->validated();

        if (! empty($data['image'])) {

            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $data['image']->store('products', 'public');
        }

        // Any edit needs re-approval, same as a fresh submission.
        $data['status'] = 'pending';

        $product->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Product updated and resubmitted for approval.',
            'data' => $product->fresh('category'),
        ]);
    }

    public function destroy(Request $request, Product $product)
    {
        $company = $this->sellerCompany($request);

        if (! $company || $product->company_id !== $company->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.',
            ], 403);
        }

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully.',
        ]);
    }
}
