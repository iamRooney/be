<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['company', 'category'])
            ->latest()
            ->paginate(10);

        return response()->json($services);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'starting_price' => 'nullable|numeric|min:0',
            'service_area' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'availability' => 'nullable|string|max:255',
            'featured' => 'nullable|boolean',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $data['slug'] = Str::slug($data['name']);

        if (Service::where('slug', $data['slug'])->exists()) {
            $data['slug'] .= '-' . time();
        }

        $service = Service::create($data);

        return response()->json([
            'message' => 'Service created successfully.',
            'data' => $service->load(['company', 'category'])
        ], 201);
    }

    public function show(Service $service)
    {
        return response()->json(
            $service->load(['company', 'category'])
        );
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'starting_price' => 'nullable|numeric|min:0',
            'service_area' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'availability' => 'nullable|string|max:255',
            'featured' => 'nullable|boolean',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        if ($request->hasFile('image')) {

            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }

            $data['image'] = $request->file('image')->store('services', 'public');
        }

        if ($service->name !== $data['name']) {

            $slug = Str::slug($data['name']);

            if (Service::where('slug', $slug)
                ->where('id', '!=', $service->id)
                ->exists()
            ) {
                $slug .= '-' . time();
            }

            $data['slug'] = $slug;
        }

        $service->update($data);

        return response()->json([
            'message' => 'Service updated successfully.',
            'data' => $service->fresh()->load(['company', 'category'])
        ]);
    }

    public function destroy(Service $service)
    {
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return response()->json([
            'message' => 'Service deleted successfully.'
        ]);
    }

    public function approve(Service $service)
    {
        $service->update([
            'status' => 'approved'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Service approved successfully.',
            'data' => $service->fresh()->load(['company', 'category'])
        ]);
    }

    public function reject(Service $service)
    {
        $service->update([
            'status' => 'rejected'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Service rejected successfully.',
            'data' => $service->fresh()->load(['company', 'category'])
        ]);
    }

    public function toggleFeatured(Service $service)
    {
        $service->update([
            'featured' => ! $service->featured,
        ]);

        return response()->json([
            'success' => true,
            'message' => $service->featured
                ? 'Service marked as featured.'
                : 'Service removed from featured.',
            'data' => $service->fresh()->load(['company', 'category'])
        ]);
    }
}
