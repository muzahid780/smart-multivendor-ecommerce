<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

<!-- HEADER -->
<header class="bg-white shadow-sm">

    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

        <a href="/"
           class="text-3xl font-bold text-indigo-600">
            SmartShop
        </a>

        <!-- CART BUTTON -->
        <a href="{{ route('cart.page') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">

            Cart

        </a>

    </div>

</header>

<!-- PRODUCT DETAILS -->
<section class="container mx-auto px-6 py-10">

    <div class="bg-white rounded-3xl shadow-lg overflow-hidden grid md:grid-cols-2 gap-10 p-8">

        <!-- PRODUCT IMAGE -->
        <div>

            @if($product->image)

                <img src="{{ asset('storage/'.$product->image) }}"
                     class="w-full h-[500px] object-cover rounded-2xl">

            @else

                <div class="w-full h-[500px] bg-gray-200 rounded-2xl flex items-center justify-center">

                    <span class="text-gray-500 text-xl">
                        No Image
                    </span>

                </div>

            @endif

        </div>

        <!-- PRODUCT INFO -->
        <div class="flex flex-col justify-center">

            <!-- CATEGORY -->
            <p class="text-indigo-600 font-semibold text-lg mb-2">

                {{ $product->category->name ?? 'No Category' }}

            </p>

            <!-- TITLE -->
            <h1 class="text-4xl font-bold text-gray-800 mb-4">

                {{ $product->name }}

            </h1>

            <!-- DESCRIPTION -->
            <p class="text-gray-600 leading-7 mb-6">

                {{ $product->description }}

            </p>

            <!-- PRICE -->
            <div class="mb-8">

                <span class="text-4xl font-bold text-green-600">

                    ${{ $product->price }}

                </span>

            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex gap-4">

                <!-- ADD TO CART -->
                <form action="{{ route('cart.add', $product->id) }}"
                      method="POST">

                    @csrf

                    <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-semibold transition">

                        Add to Cart

                    </button>

                </form>

                <!-- WISHLIST -->
                <button class="bg-gray-200 hover:bg-gray-300 px-8 py-3 rounded-xl font-semibold transition">

                    Wishlist

                </button>

            </div>

        </div>

    </div>

</section>

<!-- RELATED PRODUCTS -->
<section class="container mx-auto px-6 pb-12">

    <div class="flex justify-between items-center mb-6">

        <h2 class="text-3xl font-bold text-gray-800">
            Related Products
        </h2>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        @forelse($relatedProducts as $item)

            <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">

                <!-- IMAGE -->
                @if($item->image)

                    <img src="{{ asset('storage/'.$item->image) }}"
                         class="w-full h-52 object-cover">

                @else

                    <div class="w-full h-52 bg-gray-200 flex items-center justify-center">

                        <span class="text-gray-500">
                            No Image
                        </span>

                    </div>

                @endif

                <!-- CONTENT -->
                <div class="p-4">

                    <h3 class="text-lg font-bold mb-2">

                        {{ $item->name }}

                    </h3>

                    <p class="text-indigo-600 font-bold text-xl mb-4">

                        ${{ $item->price }}

                    </p>

                    <!-- DETAILS BUTTON -->
                    <a href="{{ route('product.details', $item->slug) }}"
                       class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">

                        View Details

                    </a>

                </div>

            </div>

        @empty

            <div class="col-span-4 text-center py-10">

                <h2 class="text-2xl text-gray-500">
                    No Related Products
                </h2>

            </div>

        @endforelse

    </div>

</section>

</body>
</html>