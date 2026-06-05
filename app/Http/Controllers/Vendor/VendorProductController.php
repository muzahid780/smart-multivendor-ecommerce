<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VendorProductController extends Controller
{
    public function index()
    {
        $products = Product::where('vendor_id', auth()->id())
            ->latest()
            ->get();

        return view('vendor.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::latest()->get();

        return view('vendor.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'images'      => 'required|array|min:1',
            'images.*'    => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $images = [];

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $file) {

                if ($file && $file->isValid()) {

                    $images[] = $file->store('products', 'public');
                }
            }
        }

        Product::create([
            'vendor_id'   => auth()->id(),
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'slug'        => Str::slug($request->name) . '-' . uniqid(),
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'images'      => $images,
            'status'      => 1,
        ]);

        return redirect()
            ->route('vendor.products.index')
            ->with('success', 'Product added successfully');
    }

    public function edit($id)
    {
        $product = Product::where('vendor_id', auth()->id())
            ->findOrFail($id);

        $categories = Category::latest()->get();

        return view('vendor.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('vendor_id', auth()->id())
            ->findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'images.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $images = $product->images ?? [];

        if ($request->hasFile('images')) {

            // delete old images
            if (!empty($product->images) && is_array($product->images)) {

                foreach ($product->images as $oldImage) {

                    Storage::disk('public')->delete($oldImage);
                }
            }

            $images = [];

            foreach ($request->file('images') as $file) {

                if ($file && $file->isValid()) {

                    $images[] = $file->store('products', 'public');
                }
            }
        }

        $product->update([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'slug'        => Str::slug($request->name) . '-' . uniqid(),
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'images'      => $images,
        ]);

        return redirect()
            ->route('vendor.products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::where('vendor_id', auth()->id())
            ->findOrFail($id);

        // delete images
        if (!empty($product->images) && is_array($product->images)) {

            foreach ($product->images as $image) {

                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();

        return redirect()
            ->route('vendor.products.index')
            ->with('success', 'Product deleted successfully');
    }
}