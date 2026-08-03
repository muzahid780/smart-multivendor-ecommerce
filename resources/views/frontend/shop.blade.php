@extends('frontend.master')
@section('content')
<div class="bg-gray-100 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">
                Shop Products
            </h1>
        </div>

        <!-- PRODUCTS GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="bg-white rounded-3xl overflow-hidden shadow hover:shadow-lg transition flex flex-col">
                    <div class="relative">
                        <a href="{{ route('product.details', $product->slug) }}">
                            @php
                                $images = $product->images;
                            @endphp
                            @if(!empty($images) && is_array($images) && isset($images[0]))
                                <img src="{{ asset('storage/' . $images[0]) }}"
                                     class="w-full h-44 object-cover">
                            @else
                                <img src="https://via.placeholder.com/400x400"
                                     class="w-full h-44 object-cover">
                            @endif
                        </a>

                        <!-- WISHLIST BUTTON-->
                    <button
                       type="button"
                        onclick="toggleWishlist({{ $product->id }}, this)"
                         class="absolute top-2 right-2 bg-white w-10 h-10 rounded-full shadow flex items-center justify-center text-xl hover:scale-110 transition">
                         ❤️
                    </button>
                    </div>

                    <!-- CONTENT -->
                    <div class="p-4 flex flex-col flex-1 justify-between">
                        <div>
                            <p class="text-sm text-indigo-600 font-semibold mb-1">
                                {{ $product->category->name ?? 'No Category' }}
                            </p>

                            <h2 class="text-lg font-bold text-gray-800 mb-2">
                                {{ $product->name }}
                            </h2>

                            <div class="text-sm text-yellow-500 mb-2">
                            ⭐ {{ number_format($product->reviews_avg_rating, 1) }}
                           <span class="text-gray-500">
                              ({{ $product->reviews_count }} Reviews)
                            </span>
                          </div>

                            <p class="text-gray-500 mb-3">
                                ৳ {{ number_format($product->price, 2) }}
                            </p>
                        </div>

                        <!-- BUTTONS -->
                        <div class="flex gap-2">
                            <a href="{{ route('product.details', $product->slug) }}"
                               class="flex-1 bg-indigo-600 text-white text-center py-2 rounded-xl">
                                View
                            </a>

                            <button type="button"
                                    onclick="addToCart({{ $product->id }})"
                                    class="flex-1 bg-orange-600 text-white py-2 rounded-xl">
                                Cart
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center text-gray-500">
                    No Products Found
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection