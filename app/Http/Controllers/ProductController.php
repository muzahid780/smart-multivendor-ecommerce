<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // ================= PRODUCT LIST =================
    public function index()
    {
        $products = Product::with('category')->latest()->get();

        return view('admin.products.index', compact('products'));
    }

    // ================= CREATE FORM =================
    public function create()
    {
        $categories = Category::latest()->get();

        return view('admin.products.create', compact('categories'));
    }

    // ================= STORE PRODUCT =================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;

        // Upload image
        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')
                ->store('products', 'public');
        }

        // Create product
        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'vendor_id' => auth()->id(),
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product added successfully!');
    }

    // ================= EDIT FORM =================
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::latest()->get();

        return view('admin.products.edit', compact(
            'product',
            'categories'
        ));
    }

    // ================= UPDATE PRODUCT =================
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $product->image;

        // New image upload
        if ($request->hasFile('image')) {

            // Delete old image
            if ($product->image) {
                \Storage::disk('public')
                    ->delete($product->image);
            }

            $imagePath = $request->file('image')
                ->store('products', 'public');
        }

        // Update product
        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    // ================= DELETE PRODUCT =================
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete image
        if ($product->image) {

            \Storage::disk('public')
                ->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }

    // ================= CATEGORY PRODUCTS =================
    public function categoryProducts($slug)
    {
        $category = Category::where('slug', $slug)
            ->firstOrFail();

        $products = Product::where('category_id', $category->id)
            ->latest()
            ->get();

        return view(
            'frontend.category-products',
            compact('category', 'products')
        );
    }
    public function show($slug)
{
    $product = Product::with('category')
        ->where('slug', $slug)
        ->firstOrFail();

    // related products
    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->latest()
        ->take(4)
        ->get();

    return view('frontend.product-details', compact(
        'product',
        'relatedProducts'
    ));
}
}