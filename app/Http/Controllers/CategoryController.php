<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display all categories.
     */
    public function index()
    {
        return response()->json(
            Category::latest()->get()
        );
    }

    /**
     * Store a new category.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'status' => 'boolean'
        ]);

        $iconName = null;

        if ($request->hasFile('icon')) {

            $iconName = time() . '.' . $request->icon->extension();

            $request->icon->move(
                public_path('uploads/categories'),
                $iconName
            );
        }

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'icon' => $iconName,
            'status' => $request->status ?? true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully.',
            'data' => $category
        ], 201);
    }

    /**
     * Display a single category.
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Update category.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'status' => 'boolean'
        ]);

        if ($request->hasFile('icon')) {

            if (
                $category->icon &&
                File::exists(public_path('uploads/categories/' . $category->icon))
            ) {
                File::delete(public_path('uploads/categories/' . $category->icon));
            }

            $iconName = time() . '.' . $request->icon->extension();

            $request->icon->move(
                public_path('uploads/categories'),
                $iconName
            );

            $category->icon = $iconName;
        }

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->status = $request->status ?? $category->status;

        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully.',
            'data' => $category
        ]);
    }

    /**
     * Delete category.
     */
    public function destroy(Category $category)
    {
        if (
            $category->icon &&
            File::exists(public_path('uploads/categories/' . $category->icon))
        ) {
            File::delete(public_path('uploads/categories/' . $category->icon));
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully.'
        ]);
    }
}
