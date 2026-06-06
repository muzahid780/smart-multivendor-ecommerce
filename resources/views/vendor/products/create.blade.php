@extends('vendor.layout')
@section('content')

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Add Product</h1>
        <p class="text-gray-500 mt-1">Create and publish a new product</p>
    </div>

    <a href="{{ route('vendor.products.index') }}"
       class="bg-gray-800 hover:bg-black text-white px-5 py-3 rounded-xl font-semibold transition">
        ← Back
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border p-8">
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-6">
            <strong class="font-bold">Fix these errors:</strong>

            <ul class="list-disc pl-5 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM -->
    <form action="{{ route('vendor.products.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- PRODUCT NAME -->
            <div>
                <label class="block font-semibold text-gray-700">
                    Product Name *
                </label>

                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       placeholder="Enter product name"
                       class="w-full border rounded-xl px-4 py-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- CATEGORY -->
            <div>
                <label class="block font-semibold text-gray-700">
                    Category *
                </label>
                <select name="category_id"
                        required
                        class="w-full border rounded-xl px-4 py-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- PRICE -->
            <div>
                <label class="block font-semibold text-gray-700">
                    Price (৳) *
                </label>

                <input type="number"
                       step="0.01"
                       min="0"
                       name="price"
                       value="{{ old('price') }}"
                       required
                       placeholder="0.00"
                       class="w-full border rounded-xl px-4 py-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-400">

                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- STOCK -->
            <div>
                <label class="block font-semibold text-gray-700">
                    Stock *
                </label>

                <input type="number"
                       min="0"
                       name="stock"
                       value="{{ old('stock') }}"
                       required
                       placeholder="0"
                       class="w-full border rounded-xl px-4 py-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-400">

                @error('stock')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- DESCRIPTION -->
        <div class="mt-6">
            <label class="block font-semibold text-gray-700">
                Description
            </label>
            <textarea name="description"
                      rows="5"
                      placeholder="Write product description..."
                      class="w-full border rounded-xl px-4 py-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('description') }}</textarea>

            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- IMAGES -->
        <div class="mt-6">
            <label class="block font-semibold text-gray-700 mb-2">
                Product Images *
            </label>

            <input type="file"
                   name="images[]"
                   id="images"
                   multiple
                   required
                   accept="image/*"
                   onchange="previewImages(event)"
                   class="w-full border rounded-xl px-4 py-3 bg-white cursor-pointer focus:outline-none">

            <p class="text-sm text-gray-500 mt-2">
                You can upload multiple images. Max size: 5MB each.
            </p>

            @error('images')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

            <!-- IMAGE PREVIEW -->
            <div id="preview"
                 class="flex flex-wrap gap-4 mt-5">
            </div>
        </div>

        <!-- SUBMIT -->
        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 transition text-white py-4 rounded-xl font-bold mt-8">
            Create Product
        </button>
    </form>
</div>

<!-- IMAGE PREVIEW SCRIPT -->
<script>
    function previewImages(event) {
        const preview = document.getElementById('preview');
        preview.innerHTML = '';
        const files = event.target.files;
        if (!files.length) {
            return;
        }
        Array.from(files).forEach(file => {
            if (!file.type.startsWith('image/')) {
                return;
            }
            if (file.size > 5 * 1024 * 1024) {
                alert(file.name + ' is larger than 5MB.');
                return;
            }
            const reader = new FileReader();

            reader.onload = function(e) {
                const wrapper = document.createElement('div');
                wrapper.className = 'relative';
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className =
                    'w-28 h-28 object-cover rounded-xl border shadow-sm';
                wrapper.appendChild(img);
                preview.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });
    }
</script>

@endsection