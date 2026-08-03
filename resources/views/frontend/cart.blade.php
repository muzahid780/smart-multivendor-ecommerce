@extends('frontend.master')

@section('content')
<div class="bg-gray-100 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-6">

        <!-- PAGE TITLE -->
        <div class="mb-10">
            <h1 class="text-4xl font-bold text-gray-800">
                Shopping Cart
            </h1>

            <p class="text-gray-500 mt-2">
                Review your selected products
            </p>
        </div>

        @if(count($cart) > 0)

        <div class="grid lg:grid-cols-3 gap-8">

            <!-- CART ITEMS -->
            <div class="lg:col-span-2 space-y-6">

                @foreach($cart as $id => $item)

                <div class="bg-white rounded-2xl shadow-md p-5">

                    <div class="flex flex-col md:flex-row md:items-center gap-6">

                        <!-- IMAGE -->
                        <div class="w-full md:w-32">
                            <img src="{{ asset('storage/' . ($item['image'] ?? 'default.png')) }}"
                                 class="w-32 h-32 object-cover rounded-xl">
                        </div>

                        <!-- DETAILS -->
                        <div class="flex-1">
                            <a href="{{ route('product.details', $item['slug']) }}"
                               class="text-2xl font-bold text-gray-800 hover:text-indigo-600">
                                {{ $item['name'] }}
                            </a>

                            <p class="text-gray-500 mt-2">
                                Price:
                                <span class="font-semibold text-indigo-600">
                                    ৳ {{ number_format($item['price'], 2) }}
                                </span>
                            </p>

                            <p class="text-gray-500 mt-1">
                                Available Stock: {{ $item['stock'] }}
                            </p>
                        </div>

                        <!-- QUANTITY (NO UPDATE BUTTON) -->
                        <div class="flex items-center gap-2">

                            <input type="number"
                                   id="qty-{{ $id }}"
                                   value="{{ $item['quantity'] }}"
                                   min="1"
                                   max="{{ $item['stock'] }}"
                                   class="w-20 border border-gray-300 rounded-lg px-3 py-2 text-center"
                                   onchange="updateCart({{ $id }})">

                        </div>

                        <!-- SUBTOTAL + REMOVE -->
                        <div class="text-right">

                            <h3 class="text-xl font-bold text-gray-800">
                                ৳ {{ number_format($item['price'] * $item['quantity'], 2) }}
                            </h3>

                            <button
    type="button"
    onclick="removeCart({{ $id }})"
    class="mt-3 text-red-500 hover:text-red-700 font-medium">
    Remove
</button>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

            <!-- ORDER SUMMARY -->
            <div>
                <div class="bg-white rounded-2xl shadow-md p-6 sticky top-10">

                    <h2 class="text-2xl font-bold text-gray-800 mb-6">
                        Order Summary
                    </h2>

                    <div class="flex justify-between mb-4">
                        <span>Subtotal</span>
                        <span>৳ {{ number_format($subtotal, 2) }}</span>
                    </div>

                    <div class="flex justify-between mb-4">
                        <span>Shipping</span>
                        <span>৳ {{ number_format($shipping, 2) }}</span>
                    </div>

                    <div class="flex justify-between border-t pt-4 mb-6">
                        <span class="text-xl font-bold">Total</span>
                        <span class="text-xl font-bold text-indigo-600">
                            ৳ {{ number_format($total, 2) }}
                        </span>
                    </div>

                    <a href="{{ route('checkout') }}"
                       class="block w-full bg-green-600 text-white text-center py-4 rounded-xl mb-3">
                        Proceed To Checkout
                    </a>

                    <a href="{{ route('shop') }}"
                       class="block w-full bg-gray-900 text-white text-center py-4 rounded-xl">
                        Continue Shopping
                    </a>

                </div>
            </div>

        </div>

        @else

        <!-- EMPTY CART -->
        <div class="bg-white rounded-3xl shadow-md py-24 text-center">
            <h2 class="text-4xl font-bold">Your Cart Is Empty</h2>

            <a href="{{ route('shop') }}"
               class="mt-6 inline-block bg-indigo-600 text-white px-10 py-4 rounded-xl">
                Start Shopping
            </a>
        </div>

        @endif

    </div>
</div>
@endsection


@push('scripts')
<script>
function removeCart(id) {

    $.ajax({
        url: "/cart/remove/" + id,
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            _method: "DELETE"
        },

        success: function(res) {

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: res.message,
                toast: true,
                showConfirmButton: false,
                timer: 1500
            });

            setTimeout(function () {
                location.reload();
            }, 1500);
        },

        error: function(xhr) {

            Swal.fire({
                icon: 'error',
                title: xhr.responseJSON?.message || 'Something went wrong!'
            });

        }
    });
}
</script>
@endpush