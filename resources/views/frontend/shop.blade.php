@extends('frontend.master')

@section('content')

<div class="bg-gray-100 min-h-screen py-12">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- PAGE TITLE -->
        <div class="text-center mb-10">

            <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">
                Shop Products
            </h1>

            <p class="text-gray-500 mt-2 text-sm sm:text-base">
                Explore our latest collections
            </p>

        </div>

        <!-- CATEGORY FILTER -->
        <div class="flex flex-wrap justify-center gap-3 mb-10">

            <a href="{{ route('shop') }}"
               class="px-5 py-2 rounded-full border transition duration-300
               {{ !request('category') ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-white hover:bg-gray-100 border-gray-200' }}">
                All
            </a>

            @foreach($categories as $cat)

                <a href="{{ route('shop', ['category' => $cat->id]) }}"
                   class="px-5 py-2 rounded-full border transition duration-300
                   {{ request('category') == $cat->id ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-white hover:bg-gray-100 border-gray-200' }}">
                    {{ $cat->name }}
                </a>

            @endforeach

        </div>

        <!-- PRODUCTS GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            @forelse($products as $product)

                <div class="bg-white rounded-3xl overflow-hidden border border-gray-100 group transition-all duration-300 ease-out hover:-translate-y-2 hover:shadow-lg flex flex-col">

                    <!-- IMAGE -->
                    <a href="{{ route('product.details', $product->slug) }}">

                        @php
                            $images = $product->images;
                        @endphp

                        <div class="overflow-hidden bg-gray-100">

                            @if(!empty($images) && is_array($images) && isset($images[0]))

                                <img src="{{ asset('storage/' . $images[0]) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-52 sm:h-56 lg:h-60 object-cover transition duration-300 ease-out group-hover:scale-105">

                            @else

                                <img src="https://via.placeholder.com/400x400?text=No+Image"
                                     alt="No Image"
                                     class="w-full h-52 sm:h-56 lg:h-60 object-cover transition duration-300 ease-out group-hover:scale-105">

                            @endif

                        </div>

                    </a>

                    <!-- CONTENT -->
                    <div class="p-4 sm:p-5 flex flex-col flex-1 justify-between">

                        <!-- TOP CONTENT -->
                        <div>

                            <!-- CATEGORY -->
                            <p class="text-sm text-indigo-600 font-semibold mb-2">
                                {{ $product->category->name ?? 'No Category' }}
                            </p>

                            <!-- NAME -->
                            <h2 class="text-base sm:text-lg font-bold text-gray-800 leading-7 mb-3 min-h-[50px] group-hover:text-indigo-600 transition">
                                {{ $product->name }}
                            </h2>

                        </div>

                        <!-- PRICE + STOCK -->
                        <div class="flex justify-between items-center mb-4">

                            <span class="text-xl sm:text-2xl font-bold text-gray-900">
                                ৳ {{ number_format($product->price, 2) }}
                            </span>

                            @if($product->stock > 0)
                                <span class="text-green-600 text-sm font-semibold">
                                    In Stock
                                </span>
                            @else
                                <span class="text-red-500 text-sm font-semibold">
                                    Out of Stock
                                </span>
                            @endif

                        </div>

                        <!-- BUTTONS -->
                        <div class="flex gap-3">

                            <a href="{{ route('product.details', $product->slug) }}"
                               class="flex-1 bg-indigo-600 text-white text-center py-3 rounded-xl font-medium hover:bg-indigo-700 transition duration-300">
                                View
                            </a>

                            <button onclick="addToCart({{ $product->id }})"
                                    class="flex-1 bg-gray-900 text-white py-3 rounded-xl font-medium hover:bg-black transition duration-300">
                                Cart
                            </button>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-span-full text-center py-20">

                    <h2 class="text-2xl font-bold text-gray-500">
                        No Products Found
                    </h2>

                </div>

            @endforelse

        </div>

        <!-- PAGINATION -->
        <div class="mt-12">
            {{ $products->links() }}
        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
function addToCart(productId) {

    $.ajax({
        url: "/cart/add/" + productId,
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function () {
            alert("Product added to cart!");
        },
        error: function () {
            alert("Something went wrong!");
        }
    });

}
</script>

@endsection