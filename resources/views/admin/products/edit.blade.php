<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-4xl mx-auto py-10">

    <div class="bg-white rounded-2xl shadow-lg p-8">

        <h2 class="text-4xl font-bold mb-8 text-gray-800">
            Edit Product
        </h2>

        <!-- ERROR HANDLING -->
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('admin.products.update', $product->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!-- NAME -->
            <div class="mb-6">
                <label class="block mb-2 font-semibold">Product Name</label>

                <input type="text"
                       name="name"
                       value="{{ old('name', $product->name) }}"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3">
            </div>

            <!-- PRICE -->
            <div class="mb-6">
                <label class="block mb-2 font-semibold">Price</label>

                <input type="number"
                       step="0.01"
                       name="price"
                       value="{{ old('price', $product->price) }}"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3">
            </div>

            <!-- STOCK -->
            <div class="mb-6">
                <label class="block mb-2 font-semibold">Stock</label>

                <input type="number"
                       name="stock"
                       value="{{ old('stock', $product->stock) }}"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3">
            </div>

            <!-- CATEGORY -->
            <div class="mb-6">
                <label class="block mb-2 font-semibold">Category</label>

                <select name="category_id"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3">

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- STATUS -->
            <div class="mb-6">
                <label class="block mb-2 font-semibold">Status</label>

                <select name="status"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3">

                    <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>
            </div>

            <!-- DESCRIPTION -->
            <div class="mb-6">
                <label class="block mb-2 font-semibold">Description</label>

                <textarea name="description"
                          rows="6"
                          class="w-full border border-gray-300 rounded-xl px-4 py-3">{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- CURRENT IMAGES -->
            <div class="mb-6">
                <label class="block mb-2 font-semibold">Current Images</label>

                <div class="flex gap-4 flex-wrap">

                    @php
                        $images = $product->images ?? [];
                    @endphp

                    @if(is_array($images) && count($images) > 0)

                        @foreach($images as $img)
                            <img src="{{ asset('storage/' . $img) }}"
                                 class="w-24 h-24 object-cover rounded-xl border">
                        @endforeach

                    @else
                        <p class="text-gray-500">No images found</p>
                    @endif

                </div>
            </div>

            <!-- NEW IMAGES -->
            <div class="mb-6">
                <label class="block mb-2 font-semibold">Upload New Images</label>

                <input type="file"
                       name="images[]"
                       multiple
                       accept="image/*"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-white">

                <p class="text-sm text-gray-500 mt-2">
                    Upload করলে পুরাতন images replace হবে
                </p>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-semibold transition">

                Update Product
            </button>

        </form>

    </div>

</div>

</body>
</html>