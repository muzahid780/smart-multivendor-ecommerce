<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-bold mb-5">Edit Product</h2>

    <form action="{{ route('products.update', $product->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <!-- Name -->
        <input type="text"
               name="name"
               value="{{ $product->name }}"
               class="w-full border p-2 mb-3 rounded">

        <!-- Price -->
        <input type="number"
               name="price"
               value="{{ $product->price }}"
               class="w-full border p-2 mb-3 rounded">

        <!-- Description -->
        <textarea name="description"
                  class="w-full border p-2 mb-3 rounded">{{ $product->description }}</textarea>

        <!-- Image -->
        <input type="file" name="image" class="mb-3">

        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}"
                 class="w-20 h-20 rounded mb-3">
        @endif

        <button class="bg-indigo-600 text-white px-4 py-2 rounded">
            Update Product
        </button>

    </form>

</div>

</body>
</html>