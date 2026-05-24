<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-900 text-white p-5">

        <h1 class="text-2xl font-bold mb-6">
            Admin Panel
        </h1>

        <nav class="space-y-2">

            <a href="{{ route('admin.dashboard') }}"
               class="block p-3 rounded hover:bg-gray-800 transition">
                Dashboard
            </a>

            <a href="{{ route('admin.products.index') }}"
               class="block p-3 rounded bg-gray-800 transition">
                Products
            </a>

        </nav>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-10">

        <!-- PAGE HEADER -->
        <div class="mb-8">

            <h2 class="text-4xl font-bold text-gray-800">
                Create Product
            </h2>

            <p class="text-gray-500 mt-2">
                Add a new product to your store
            </p>

        </div>

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- ERROR MESSAGE -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-6">

                <ul class="list-disc pl-5 space-y-1">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>
        @endif

        <!-- FORM CARD -->
        <div class="bg-white rounded-2xl shadow-lg p-8 max-w-4xl">

            <form action="{{ route('admin.products.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <!-- PRODUCT NAME -->
                <div class="mb-6">

                    <label class="block mb-2 font-semibold text-gray-700">
                        Product Name
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Enter product name"
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           required>

                </div>

                <!-- PRICE -->
                <div class="mb-6">

                    <label class="block mb-2 font-semibold text-gray-700">
                        Price
                    </label>

                    <input type="number"
                           step="0.01"
                           name="price"
                           value="{{ old('price') }}"
                           placeholder="Enter price"
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           required>

                </div>

                <!-- STOCK -->
                <div class="mb-6">

                    <label class="block mb-2 font-semibold text-gray-700">
                        Stock Quantity
                    </label>

                    <input type="number"
                           name="stock"
                           value="{{ old('stock') }}"
                           placeholder="Enter stock quantity"
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>



<!-- CATEGORY -->
<div class="mb-6">

    <label class="block mb-2 font-semibold text-gray-700">
        Category
    </label>

    <select name="category_id"
            class="w-full text-gray-700 border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            required>

        <option value="" disabled selected hidden>
            Select Category
        </option>

        @foreach($categories as $category)

            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>

        @endforeach

    </select>

</div>

                <!-- STATUS -->
                <div class="mb-6">

                    <label class="block mb-2 font-semibold text-gray-700">
                        Status
                    </label>

                    <select name="status"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>

                <!-- DESCRIPTION -->
                <div class="mb-6">

                    <label class="block mb-2 font-semibold text-gray-700">
                        Description
                    </label>

                    <textarea name="description"
                              rows="5"
                              placeholder="Write product description..."
                              class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description') }}</textarea>

                </div>

                <!-- IMAGE UPLOAD -->
                <div class="mb-6">

                    <label class="block mb-2 font-semibold text-gray-700">
                        Product Images
                    </label>

                    <input type="file"
                           id="images"
                           name="images[]"
                           multiple
                           accept="image/*"
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-white cursor-pointer">

                    <p class="text-sm text-gray-500 mt-2">
                        JPG, PNG, WEBP allowed. Max 5MB per image.
                    </p>

                    <!-- IMAGE PREVIEW -->
                    <div id="preview"
                         class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                    </div>

                </div>

                <!-- BUTTONS -->
                <div class="flex items-center gap-4">

                    <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 transition text-white px-8 py-3 rounded-xl font-semibold">

                        Save Product

                    </button>

                    <a href="{{ route('admin.products.index') }}"
                       class="bg-green-600 hover:bg-green-700 transition text-white px-8 py-3 rounded-xl font-semibold">

                        Back

                    </a>

                </div>

            </form>

        </div>

    </main>

</div>

<!-- IMAGE PREVIEW SCRIPT -->
<script>

    const imageInput = document.getElementById('images');
    const previewBox = document.getElementById('preview');

    imageInput.addEventListener('change', function (event) {

        previewBox.innerHTML = '';

        const files = event.target.files;

        Array.from(files).forEach(file => {

            // Only image check
            if (!file.type.startsWith('image/')) {
                return;
            }

            // Max 5MB check
            if (file.size > 5 * 1024 * 1024) {

                alert(file.name + ' is larger than 5MB');

                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {

                const div = document.createElement('div');

                div.innerHTML = `
                    <img src="${e.target.result}"
                         class="w-full h-32 object-cover rounded-xl border shadow">
                `;

                previewBox.appendChild(div);
            };

            reader.readAsDataURL(file);

        });

    });

</script>

</body>
</html>