<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /* =========================================
    | ADMIN CATEGORY
    ========================================= */

    public function index()
    {
        $categories = Category::latest()->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')
                ->store('categories', 'public');
        }

        Category::create([
            'name'   => $request->name,
            'slug'   => Str::slug($request->name),
            'image'  => $imagePath,
            'status' => 1,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully');
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
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $category->image;

        if ($request->hasFile('image')) {

            if (
                $category->image &&
                Storage::disk('public')->exists($category->image)
            ) {
                Storage::disk('public')->delete($category->image);
            }

            $imagePath = $request->file('image')
                ->store('categories', 'public');
        }

        $category->update([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name),
            'image' => $imagePath,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if (
            $category->image &&
            Storage::disk('public')->exists($category->image)
        ) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully');
    }

    /* =========================================
    | FRONTEND CATEGORY
    ========================================= */

    public function frontendIndex()
    {
        $categories = Category::where('status', 1)
            ->latest()
            ->get();

        return view('frontend.categories.index', compact('categories'));
    }

    public function show($slug)
    {
        // CATEGORY FIND
        $category = Category::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        // CATEGORY PRODUCTS
        $products = $category->products()
            ->where('status', 1)
            ->latest()
            ->paginate(12);

        // FIXED VIEW
        return view('frontend.category-products', compact('category', 'products'));
    }
}