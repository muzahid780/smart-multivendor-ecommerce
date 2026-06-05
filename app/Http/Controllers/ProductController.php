<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function home()
    {
        return view('frontend.home', [
            'products' => Product::approved()->latest()->paginate(8),
            'categories' => Category::latest()->get(),
        ]);
    }

    //SHOP
    public function shop(Request $request)
    {
        $search = $request->search;
        $category = $request->category;
        $products = Product::approved()
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%")
                        ->orWhereHas('category', function ($c) use ($search) {
                            $c->where('name', 'LIKE', "%{$search}%")
                              ->orWhere('slug', 'LIKE', "%{$search}%");
                        });
                });
            })

            ->when($category, function ($q) use ($category) {
                if (is_numeric($category)) {
                    $q->where('category_id', $category);
                } else {
                    $q->whereHas('category', function ($c) use ($category) {
                        $c->where('slug', $category);
                    });
                }
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('frontend.shop', [
            'products' => $products,
            'categories' => Category::latest()->get(), // 🔥 FIXED HERE
            'search' => $search,
            'category' => $category,
        ]);
    }

    public function search(Request $request)
    {
        return $this->shop($request);
    }

    //PRODUCT DETAILS
    public function show($slug)
    {
        $product = Product::approved()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.product-details', [
            'product' => $product,
            'relatedProducts' => Product::approved()
                ->where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->latest()
                ->take(4)
                ->get(),
            'categories' => Category::latest()->get(),
        ]);
    }

    //VENDOR PANEL
    public function index()
    {
        return view('vendor.products.index', [
            'products' => Product::where('vendor_id', auth()->id())
                ->latest()
                ->paginate(10),
        ]);
    }

    public function create()
    {
        return view('vendor.products.create', [
            'categories' => Category::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $images[] = $file->store('products', 'public');
                }
            }
        }

        Product::create([
            'vendor_id' => auth()->id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . uniqid(),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'images' => $images,
            'status' => 0,
            'is_approved' => false,
            'approval_status' => 'pending',
        ]);
        return redirect()->route('vendor.products.index')
            ->with('success', 'Product submitted for admin approval');
    }

    public function edit($id)
    {
        return view('vendor.products.edit', [
            'product' => Product::where('vendor_id', auth()->id())->findOrFail($id),
            'categories' => Category::latest()->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('vendor_id', auth()->id())->findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);
        $images = $product->images ?? [];
        if ($request->hasFile('images')) {
            foreach ((array) $images as $img) {
                Storage::disk('public')->delete($img);
            }
            $images = [];
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $images[] = $file->store('products', 'public');
                }
            }
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'images' => $images,
        ]);
        return redirect()->route('vendor.products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::where('vendor_id', auth()->id())->findOrFail($id);
        foreach ((array) $product->images as $img) {
            Storage::disk('public')->delete($img);
        }
        $product->delete();
        return back()->with('success', 'Product deleted successfully');
    }
}