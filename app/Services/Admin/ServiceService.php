<?php

namespace App\Services\Admin;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceService
{
    public function getAll(array $filters = [])
    {
        $query = Service::with([
            'company',
            'category'
        ]);

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', "%{$filters['search']}%")
                    ->orWhere('description', 'like', "%{$filters['search']}%");
            });
        }

        if (!empty($filters['category'])) {
            $query->where('category_id', $filters['category']);
        }

        if (!empty($filters['company'])) {
            $query->where('company_id', $filters['company']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['featured']) && $filters['featured'] !== '') {
            $query->where('featured', $filters['featured']);
        }

        return $query
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function store(array $data): Service
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('services', 'public');
        }

        $slug = Str::slug($data['name']);

        if (Service::where('slug', $slug)->exists()) {
            $slug .= '-' . time();
        }

        $data['slug'] = $slug;

        return Service::create($data);
    }

    public function update(Service $service, array $data): Service
    {
        if (isset($data['image'])) {

            if (
                $service->image &&
                Storage::disk('public')->exists($service->image)
            ) {

                Storage::disk('public')->delete($service->image);
            }

            $data['image'] = $data['image']->store('services', 'public');
        }

        if ($service->name !== $data['name']) {

            $slug = Str::slug($data['name']);

            if (
                Service::where('slug', $slug)
                ->where('id', '!=', $service->id)
                ->exists()
            ) {
                $slug .= '-' . time();
            }

            $data['slug'] = $slug;
        }

        $service->update($data);

        return $service->fresh();
    }

    public function delete(Service $service): bool
    {
        if (
            $service->image &&
            Storage::disk('public')->exists($service->image)
        ) {

            Storage::disk('public')->delete($service->image);
        }

        return $service->delete();
    }
}
