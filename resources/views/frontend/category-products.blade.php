<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} Products</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- HEADER -->
<div class="bg-white shadow">

    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

        <a href="/" class="text-2xl font-bold text-indigo-600">
            ShopNest
        </a>

        <a href="/"
           class="text-gray-700 hover:text-indigo-600">
            Home
        </a>

    </div>

</div>

<!-- CATEGORY TITLE -->
<div class="container mx-auto px-6 py-8">

    <h1 class="text-3xl font-bold text-gray-800">
        {{ $category->name }} Products
    </h1>

    <p class="text-gray-500 mt-2">
        Browse all products from this category
    </p>

</div>

<!-- PRODUCTS GRID -->
<div class="container mx-auto px-6 pb-10">

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        @forelse($products as $product)

            @php
                $images = $product->images;

                if (is_string($images)) {
                    $images = json_decode($images, true) ?? [];
                }
            @endphp

            <!-- PRODUCT CARD -->
            <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">

                <!-- IMAGE -->
                @if(is_array($images) && count($images) > 0)

                    <img src="{{ asset('storage/' . $images[0]) }}"
                         class="w-full h-52 object-cover">

                @else

                    <div class="w-full h-52 bg-gray-200 flex items-center justify-center text-gray-400">
                        No Image
                    </div>

                @endif

                <!-- CONTENT -->
                <div class="p-4">

                    <h2 class="text-lg font-bold mb-2">
                        {{ $product->name }}
                    </h2>

                    <p class="text-gray-500 text-sm mb-3">
                        {{ Str::limit($product->description, 60) }}
                    </p>

                    <!-- PRICE -->
                    <div class="flex justify-between items-center">

                        <span class="text-indigo-600 font-bold text-xl">
                            ৳{{ number_format($product->price, 2) }}
                        </span>

                        <!-- DETAILS BUTTON -->
                        <a href="{{ route('product.details', $product->slug) }}"
                           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">

                            View

                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-span-4 text-center py-10">

                <h2 class="text-2xl font-bold text-gray-500">
                    No Products Found
                </h2>

            </div>

        @endforelse

    </div>

    <!-- PAGINATION -->
    <div class="mt-10">
        {{ $products->links() }}
    </div>

</div>

</body>
</html>