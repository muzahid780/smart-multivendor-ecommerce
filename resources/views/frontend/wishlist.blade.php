@extends('frontend.master')

@section('content')
<div class="bg-gray-100 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- PAGE HEADER -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    My Wishlist
                </h1>
                <p class="text-gray-500 mt-1">
                    Your favorite saved products
                </p>
            </div>

            <a href="{{ route('shop') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg transition">
                ← Continue Shopping
            </a>
        </div>

        @if($wishlists->count() > 0)

        <!-- WISHLIST GRID -->
        <div id="wishlist-grid"
             class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @foreach($wishlists as $item)

                @php
                    $product = $item->product;
                @endphp

                @if($product)

                <div class="wishlist-card bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">

                    <!-- IMAGE -->
                    <a href="{{ route('product.details', $product->slug) }}">
                        @php
                            $images = $product->images;
                        @endphp

                        @if(!empty($images) && is_array($images) && isset($images[0]))
                            <img
                                src="{{ asset('storage/' . $images[0]) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-52 object-cover">
                        @else
                            <img
                                src="https://via.placeholder.com/400x300?text=No+Image"
                                alt="No Image"
                                class="w-full h-52 object-cover">
                        @endif
                    </a>

                    <!-- CONTENT -->
                    <div class="p-4 flex flex-col flex-1">

                        <div class="flex-1">
                            <h2 class="text-lg font-bold text-gray-800 line-clamp-2">
                                {{ $product->name }}
                            </h2>

                            <p class="text-2xl font-bold text-indigo-600 mt-3">
                                ৳ {{ number_format($product->price, 2) }}
                            </p>
                        </div>

                        <!-- ACTION BUTTONS -->
                        <div class="mt-5 flex gap-2">

                            <a href="{{ route('product.details', $product->slug) }}"
                               class="flex-1 text-center bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg transition">
                                View
                            </a>

                            <button
                                type="button"
                                onclick="addToCart({{ $product->id }})"
                                class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg transition">
                                Cart
                            </button>

                        </div>

                        <!-- REMOVE -->
                        <button
                            type="button"
                            onclick="toggleWishlist({{ $product->id }}, this)"
                            class="mt-3 w-full border border-red-500 text-red-500 hover:bg-red-500 hover:text-white py-2 rounded-lg transition">
                            Remove ❤️
                        </button>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        <!-- EMPTY STATE-->
        <div id="empty-wishlist"
             class="hidden bg-white rounded-2xl shadow p-12 text-center">
            <div class="text-6xl mb-4">❤️</div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                Your Wishlist is Empty
            </h2>

            <p class="text-gray-500 mb-6">
                Save products you like and they'll appear here.
            </p>

            <a href="{{ route('shop') }}"
               class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-lg transition">
                Browse Products
            </a>
        </div>
        @else

        <!-- EMPTY -->
        <div class="bg-white rounded-2xl shadow p-12 text-center">
            <div class="text-6xl mb-4">❤️</div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                Your Wishlist is Empty
            </h2>

            <p class="text-gray-500 mb-6">
                Save products you like and they'll appear here.
            </p>

            <a href="{{ route('shop') }}"
               class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-lg transition">
                Browse Products
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleWishlist(productId, button = null) {

    $.ajax({
        url: "/wishlist/" + productId,
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}"
        },

        success: function(res) {

            Swal.fire({
                icon: "success",
                title: res.message,
                toast: true,
                position: "top-end",
                timer: 1000,
                showConfirmButton: false
            });

            let countEl = $("#wishlist-count");
            let count = parseInt(countEl.text()) || 0;

            // ❤️ REMOVE CASE
            if (res.status === "removed") {

                if (button) {
                    let card = button.closest(".wishlist-card");
                    if (card) card.remove();
                }

                countEl.text(Math.max(0, count - 1));
            }

            // ❤️ ADD CASE (optional safe sync)
            if (res.status === "added") {
                countEl.text(count + 1);
            }

        },

        error: function() {
            Swal.fire({
                icon: "error",
                title: "Login required"
            });
        }
    });
}
</script>
@endpush