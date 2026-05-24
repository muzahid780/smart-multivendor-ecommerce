@extends('frontend.master')

@section('content')

<div class="bg-gray-100 min-h-screen py-12">

    <div class="max-w-7xl mx-auto px-6">

        <!-- PRODUCT SECTION -->
        <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

            <div class="grid md:grid-cols-2 gap-10 p-8 md:p-12">

                <!-- PRODUCT IMAGE -->
                <div>

                    @if($product->images && count($product->images) > 0)

                        <img
                            src="{{ asset('storage/' . $product->images[0]) }}"
                            alt="{{ $product->name }}"
                            class="w-full h-[500px] object-cover rounded-2xl shadow-md">

                    @else

                        <img
                            src="https://via.placeholder.com/600x600"
                            alt="No Image"
                            class="w-full h-[500px] object-cover rounded-2xl shadow-md">

                    @endif

                </div>

                <!-- PRODUCT DETAILS -->
                <div class="flex flex-col justify-center">

                    <!-- CATEGORY -->
                    <span class="inline-block bg-indigo-100 text-indigo-600 text-sm font-semibold px-4 py-2 rounded-full mb-5 w-fit">
                        {{ $product->category->name ?? 'No Category' }}
                    </span>

                    <!-- NAME -->
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6 leading-tight">
                        {{ $product->name }}
                    </h1>

                    <!-- PRICE -->
                    <div class="mb-6">

                        <span class="text-4xl font-bold text-indigo-600">
                            ${{ $product->price }}
                        </span>

                    </div>

                    <!-- STOCK -->
                    <div class="mb-6">

                        @if($product->stock > 0)

                            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                                In Stock ({{ $product->stock }})
                            </span>

                        @else

                            <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold">
                                Out Of Stock
                            </span>

                        @endif

                    </div>

                    <!-- DESCRIPTION -->
                    <p class="text-gray-600 leading-8 text-lg mb-10">
                        {{ $product->description }}
                    </p>

                    <!-- ACTION BUTTONS -->
                    <div class="flex flex-col sm:flex-row gap-4">

                        <!-- ADD TO CART -->
                        <form action="{{ route('cart.add', $product->id) }}"
                              method="POST">

                            @csrf

                            <button
                                type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-10 py-4 rounded-xl font-semibold transition duration-300">

                                Add To Cart

                            </button>

                        </form>

                        <!-- BACK BUTTON -->
                        <a href="{{ route('shop') }}"
                           class="bg-gray-900 hover:bg-black text-white px-10 py-4 rounded-xl font-semibold transition duration-300 text-center">

                            Back To Shop

                        </a>

                    </div>

                </div>

            </div>

        </div>

        <!-- RELATED PRODUCTS -->
        <div class="mt-20">

            <div class="flex items-center justify-between mb-10">

                <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
                    Related Products
                </h2>

                <a href="{{ route('shop') }}"
                   class="text-indigo-600 font-semibold hover:underline">

                    View All

                </a>

            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

                @forelse($relatedProducts as $item)

                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-2xl transition duration-300">

                    <!-- IMAGE -->
                    <a href="{{ route('product.details', $item->slug) }}">

                        @if($item->images && count($item->images) > 0)

                            <img
                                src="{{ asset('storage/' . $item->images[0]) }}"
                                alt="{{ $item->name }}"
                                class="w-full h-56 object-cover">

                        @else

                            <img
                                src="https://via.placeholder.com/400x400"
                                alt="No Image"
                                class="w-full h-56 object-cover">

                        @endif

                    </a>

                    <!-- CONTENT -->
                    <div class="p-5">

                        <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-1">
                            {{ $item->name }}
                        </h3>

                        <div class="flex justify-between items-center">

                            <span class="text-indigo-600 text-xl font-bold">
                                ${{ $item->price }}
                            </span>

                            <a href="{{ route('product.details', $item->slug) }}"
                               class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">

                                View

                            </a>

                        </div>

                    </div>

                </div>

                @empty

                <div class="col-span-4 text-center py-10">

                    <h2 class="text-gray-500 text-2xl font-bold">
                        No Related Products
                    </h2>

                </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection