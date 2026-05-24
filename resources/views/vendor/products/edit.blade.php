@extends('vendor.layout')

@section('content')

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

    <div>
        <h1 class="text-3xl font-bold text-gray-800">Edit Product</h1>
        <p class="text-gray-500 mt-1">Update product information</p>
    </div>

    <a href="{{ route('vendor.products.index') }}"
       class="bg-gray-800 text-white px-5 py-2 rounded-lg hover:bg-black transition">
        ← Back
    </a>

</div>

<div class="bg-white p-6 rounded-2xl shadow border">

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <form action="{{ route('vendor.products.update', $product->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- NAME --}}
        <label class="font-semibold">Product Name</label>
        <input type="text"
               name="name"
               value="{{ old('name', $product->name) }}"
               class="border p-3 rounded w-full mb-4"
               required>

        {{-- CATEGORY --}}
        <label class="font-semibold">Category</label>
        <select name="category_id"
                class="border p-3 rounded w-full mb-4"
                required>

            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach

        </select>

        {{-- PRICE --}}
        <label class="font-semibold">Price (৳)</label>
        <input type="number"
               step="0.01"
               min="0"
               name="price"
               value="{{ old('price', $product->price) }}"
               class="border p-3 rounded w-full mb-4"
               required>

        {{-- STOCK --}}
        <label class="font-semibold">Stock</label>
        <input type="number"
               min="0"
               name="stock"
               value="{{ old('stock', $product->stock) }}"
               class="border p-3 rounded w-full mb-4"
               required>

        {{-- DESCRIPTION --}}
        <label class="font-semibold">Description</label>
        <textarea name="description"
                  rows="5"
                  class="border p-3 rounded w-full mb-4">{{ old('description', $product->description) }}</textarea>

        {{-- CURRENT IMAGES --}}
        <label class="font-semibold block mb-2">Current Images</label>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-5">

            @if(!empty($product->images) && is_array($product->images))
                @foreach($product->images as $img)
                    <div class="border rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $img) }}"
                             class="w-full h-24 object-cover">
                    </div>
                @endforeach
            @else
                <p class="text-gray-500">No images found</p>
            @endif

        </div>

        {{-- NEW IMAGES --}}
        <label class="font-semibold">Upload New Images</label>

        <input type="file"
               name="images[]"
               multiple
               accept="image/*"
               class="border p-3 rounded w-full mb-4 bg-white">

        <p class="text-sm text-gray-500 mb-4">
            Uploading new images will replace old ones.
        </p>

        {{-- BUTTON --}}
        <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg w-full font-semibold transition">

            Update Product

        </button>

    </form>

</div>

@endsection