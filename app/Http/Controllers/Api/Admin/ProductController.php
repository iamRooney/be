<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;
use App\Services\Admin\ProductService;
use Illuminate\Http\JsonResponse;
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

    return ProductResource::collection($products);
}

    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = $this->service->store(

            $request->validated()

        );

        return response()->json([

            'success' => true,

            'message' => 'Product created successfully.',

            'data' => new ProductResource($product)

        ], 201);
    }

    public function show(Product $product): ProductResource
    {
        $product->load(['company', 'category']);

        return new ProductResource($product);
    }

    public function update(
        UpdateProductRequest $request,
        Product $product
    ): JsonResponse {

        $product = $this->service->update(

            $product,

            $request->validated()

        );

        return response()->json([

            'success' => true,

            'message' => 'Product updated successfully.',

            'data' => new ProductResource($product)

        ]);
    }

    public function destroy(Product $product): JsonResponse
    {
        $this->service->delete($product);

        return response()->json([

            'success' => true,

            'message' => 'Product deleted successfully.'

        ]);
    }

    public function approve(Product $product): JsonResponse
    {
        $product->update([
            'status' => 'approved'
        ]);

        return response()->json([

            'success' => true,

            'message' => 'Product approved successfully.',

            'data' => new ProductResource($product)

        ]);
    }

    public function reject(Product $product): JsonResponse
    {
        $product->update([
            'status' => 'rejected'
        ]);

        return response()->json([

            'success' => true,

            'message' => 'Product rejected successfully.',

            'data' => new ProductResource($product)

        ]);
    }

    public function toggleFeatured(Product $product): JsonResponse
    {
        $product->update([
            'featured' => ! $product->featured,
        ]);

        return response()->json([

            'success' => true,

            'message' => $product->featured
                ? 'Product marked as featured.'
                : 'Product removed from featured.',

            'data' => new ProductResource($product)

        ]);
    }
}
