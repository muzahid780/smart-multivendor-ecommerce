@extends('frontend.master')
@section('content')
<!-- HERO SECTION -->
<section class="bg-gradient-to-br from-indigo-900 via-purple-800 to-pink-600 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 gap-10 items-center">
        <div>
            <h1 class="text-3xl sm:text-5xl font-bold leading-tight">
                Discover Premium <span class="text-yellow-300">Products</span>
            </h1>

            <p class="mt-4 text-gray-200 text-base sm:text-lg">
                Experience smart shopping with a modern marketplace
                built for speed, trust and style.
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

        <img src="{{ asset('images/home.jpg') }}"
             class="rounded-3xl shadow-2xl w-full object-cover"
             alt="Hero Image">
    </div>
</section>

<!-- PRODUCTS -->
<section id="products" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-800">
                Trending Products
            </h2>
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
                    
                    <div class="text-sm text-yellow-500 mt-1">
                     ⭐ {{ number_format($product->reviews_avg_rating, 1) }}
                         <span class="text-gray-500">
                         ({{ $product->reviews_count }} Reviews)
                         </span>
                    </div>

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

<!-- WHY CHOOSE SHOPNEST -->
<section class="py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Heading -->
        <div class="text-center mb-14">
            <h2 class="text-3xl font-extrabold text-gray-900">
                Why Choose ShopNest?
            </h2>
            <p class="text-gray-500 mt-3">
                Experience shopping with quality, trust, and convenience.
            </p>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- Card 1 -->
            <div class="bg-white rounded-3xl p-8 shadow-md hover:shadow-2xl hover:-translate-y-2 transition duration-300 text-center border border-gray-100">
                <div class="w-16 h-16 mx-auto mb-5 rounded-full bg-indigo-100 flex items-center justify-center text-3xl">
                    🚚
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    Fast Delivery
                </h3>
                <span class="inline-block bg-indigo-100 text-indigo-600 text-xs font-semibold px-3 py-1 rounded-full">
                    Quick Shipping
                </span>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-3xl p-8 shadow-md hover:shadow-2xl hover:-translate-y-2 transition duration-300 text-center border border-gray-100">
                <div class="w-16 h-16 mx-auto mb-5 rounded-full bg-green-100 flex items-center justify-center text-3xl">
                    🔒
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    100% Secure
                </h3>
                <span class="inline-block bg-green-100 text-green-600 text-xs font-semibold px-3 py-1 rounded-full">
                    Safe Checkout
                </span>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-3xl p-8 shadow-md hover:shadow-2xl hover:-translate-y-2 transition duration-300 text-center border border-gray-100">
                <div class="w-16 h-16 mx-auto mb-5 rounded-full bg-yellow-100 flex items-center justify-center text-3xl">
                    ⭐
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    Premium Quality
                </h3>
                <span class="inline-block bg-yellow-100 text-yellow-700 text-xs font-semibold px-3 py-1 rounded-full">
                    Trusted Products
                </span>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-3xl p-8 shadow-md hover:shadow-2xl hover:-translate-y-2 transition duration-300 text-center border border-gray-100">
                <div class="w-16 h-16 mx-auto mb-5 rounded-full bg-pink-100 flex items-center justify-center text-3xl">
                    💬
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    24/7 Support
                </h3>
                <span class="inline-block bg-pink-100 text-pink-600 text-xs font-semibold px-3 py-1 rounded-full">
                    Always Here
                </span>
            </div>

        </div>

    </div>
</section>
@endsection