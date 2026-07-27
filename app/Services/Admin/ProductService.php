<?php

namespace App\Services\Admin;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService
{
    public function getAll(array $filters = [])
    {
        $query = Product::with(['company', 'category']);

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('short_description', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('description', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['category'])) {
            $query->where('category_id', $filters['category']);
        }

        if (!empty($filters['company'])) {
            $query->where('company_id', $filters['company']);
        }

        if (isset($filters['featured'])) {
            $query->where('featured', $filters['featured']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest()->paginate(10);
    }

    public function store(array $data)
    {
        if (isset($data['image']) && $data['image']) {
            $data['image'] = $data['image']->store('products', 'public');
        }

        $data['slug'] = Str::slug($data['name']);

        return Product::create($data);
    }

    public function update(Product $product, array $data)
    {
        if (isset($data['image']) && $data['image']) {

            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $data['image']->store('products', 'public');
        }

        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $product->update($data);

        return $product->fresh();
    }

    public function delete(Product $product): void
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
    }
}
