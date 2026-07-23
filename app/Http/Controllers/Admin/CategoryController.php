<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('slug', 'LIKE', "%{$search}%");
            });
        }

        $categories = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'nullable',
            'icon' => 'nullable|image|mimes:jpg,jpeg,jfif,png,svg,webp|max:2048',
            'status' => 'required|boolean',
        ]);

        $iconName = null;

        if ($request->hasFile('icon')) {

            $iconName = time() . '.' . $request->icon->extension();

            $request->icon->move(public_path('uploads/categories'), $iconName);
        }

        Category::create([

            'name' => $request->name,

            'slug' => Str::slug($request->name),

            'description' => $request->description,

            'icon' => $iconName,

            'status' => $request->status,

        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable',
            'icon' => 'nullable|image|mimes:jpg,jpeg,jfif,png,svg,webp|max:2048',
            'status' => 'required|boolean',
        ]);

        // Handle icon upload
        if ($request->hasFile('icon')) {

            // Delete old icon
            if (
                $category->icon &&
                file_exists(public_path('uploads/categories/' . $category->icon))
            ) {

                unlink(public_path('uploads/categories/' . $category->icon));
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
        $category->status = $request->status;

        $category->save();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Delete icon if it exists
        if (
            $category->icon &&
            file_exists(public_path('uploads/categories/' . $category->icon))
        ) {
            unlink(public_path('uploads/categories/' . $category->icon));
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $category = Category::findOrFail($id);

        $category->status = !$category->status;

        $category->save();

        return redirect()
            ->back()
            ->with('success', 'Category status updated successfully.');
    }
}
