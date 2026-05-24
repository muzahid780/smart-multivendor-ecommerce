@extends('frontend.master')

@section('content')

<!-- ================= HERO ================= -->
<section class="bg-gradient-to-br from-indigo-900 via-purple-800 to-pink-600 text-white py-20">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 gap-10 items-center">

        <div>

            <h1 class="text-3xl sm:text-5xl font-bold leading-tight">
                Discover Premium <span class="text-yellow-300">Products</span>
            </h1>

            <p class="mt-4 text-gray-200 text-base sm:text-lg">
                Experience smart shopping with a modern multivendor marketplace
                built for speed, trust, and style.
            </p>

            <div class="mt-8 flex gap-4">

                <a href="#products"
                   class="bg-white text-indigo-700 px-6 py-3 rounded-xl font-bold hover:scale-105 transition">
                    Shop Now
                </a>

                <a href="#categories"
                   class="border border-white px-6 py-3 rounded-xl hover:bg-white hover:text-indigo-700 transition">
                    Browse
                </a>

            </div>

        </div>

        <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30"
             class="rounded-3xl shadow-2xl w-full object-cover"
             alt="Hero Image">

    </div>

</section>

<!-- ================= PRODUCTS ================= -->
<section id="products" class="py-16 bg-white">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12">

            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-800">
                Trending Products
            </h2>

            <p class="text-gray-500 mt-2">
                Explore premium products from trusted vendors
            </p>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @forelse($products as $product)

                @php
                    $images = $product->images;

                    if (is_string($images)) {
                        $images = json_decode($images, true);
                    }

                    $images = is_array($images) ? $images : [];
                    $firstImage = $images[0] ?? null;
                @endphp

                <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl hover:-translate-y-2 transition group">

                    <div class="h-52 overflow-hidden">

                        @if($firstImage)
                            <img src="{{ asset('storage/' . $firstImage) }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                 alt="{{ $product->name }}">
                        @else
                            <img src="https://via.placeholder.com/400x300"
                                 class="w-full h-full object-cover"
                                 alt="No Image">
                        @endif

                    </div>

                    <div class="p-4">

                        <h3 class="font-semibold line-clamp-1">
                            {{ $product->name }}
                        </h3>

                        <p class="text-indigo-600 font-bold mt-2">
                            ৳ {{ number_format($product->price, 2) }}
                        </p>

                        <a href="{{ route('product.details', $product->slug) }}"
                           class="inline-block mt-3 text-sm font-semibold text-indigo-600 hover:text-pink-500 transition">
                            View Details →
                        </a>

                    </div>

                </div>

            @empty
                <p class="col-span-full text-center text-gray-500">
                    No products found
                </p>
            @endforelse

        </div>

    </div>

</section>

<!-- ================= CATEGORIES ================= -->
<section id="categories" class="py-20 bg-gray-50">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

        <h2 class="text-3xl sm:text-4xl font-extrabold">
            Shop By Categories
        </h2>

        <p class="text-gray-500 mt-2 mb-10">
            Browse unique collections by category
        </p>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

            @forelse($categories as $category)

                <div class="bg-sky-200 p-6 rounded-2xl shadow hover:shadow-2xl transition">

                    <div class="w-14 h-14 mx-auto rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold text-xl">
                        {{ strtoupper(substr($category->name, 0, 1)) }}
                    </div>

                    <h3 class="mt-4 font-bold">
                        {{ $category->name }}
                    </h3>

                    <p class="text-gray-500 text-sm">
                        Premium Collection
                    </p>

                </div>

            @empty
                <p class="col-span-full text-gray-500">
                    No categories available
                </p>
            @endforelse

        </div>

    </div>

</section>

@endsection