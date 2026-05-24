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

                            @if($item['image'])

                                <img src="{{ asset('storage/' . $item['image']) }}"
                                     class="w-32 h-32 object-cover rounded-xl">

                            @else

                                <img src="https://via.placeholder.com/150"
                                     class="w-32 h-32 object-cover rounded-xl">

                            @endif

                        </div>

                        <!-- DETAILS -->
                        <div class="flex-1">

                            <a href="{{ route('product.details', $item['slug']) }}"
                               class="text-2xl font-bold text-gray-800 hover:text-indigo-600 transition">

                                {{ $item['name'] }}

                            </a>

                            <p class="text-gray-500 mt-2">
                                Price:
                                <span class="font-semibold text-indigo-600">
                                    ৳ {{ number_format($item['price'], 2) }}
                                </span>
                            </p>

                            <p class="text-gray-500 mt-1">
                                Available Stock:
                                {{ $item['stock'] }}
                            </p>

                        </div>

                        <!-- QUANTITY -->
                        <div>

                            <form action="{{ route('cart.update', $id) }}"
                                  method="POST"
                                  class="flex items-center gap-2">

                                @csrf

                                <input type="number"
                                       name="quantity"
                                       value="{{ $item['quantity'] }}"
                                       min="1"
                                       max="{{ $item['stock'] }}"
                                       class="w-20 border border-gray-300 rounded-lg px-3 py-2 text-center">

                                <button type="submit"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">

                                    Update

                                </button>

                            </form>

                        </div>

                        <!-- SUBTOTAL -->
                        <div class="text-right">

                            <h3 class="text-xl font-bold text-gray-800">
                                ৳ {{ number_format($item['price'] * $item['quantity'], 2) }}
                            </h3>

                            <!-- REMOVE -->
                            <form action="{{ route('cart.remove', $id) }}"
                                  method="POST"
                                  class="mt-3">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="text-red-500 hover:text-red-700 font-medium">

                                    Remove

                                </button>

                            </form>

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

                    <!-- SUBTOTAL -->
                    <div class="flex justify-between mb-4">

                        <span class="text-gray-600">
                            Subtotal
                        </span>

                        <span class="font-semibold">
                            ৳ {{ number_format($subtotal, 2) }}
                        </span>

                    </div>

                    <!-- SHIPPING -->
                    <div class="flex justify-between mb-4">

                        <span class="text-gray-600">
                            Shipping
                        </span>

                        <span class="font-semibold">
                            ৳ {{ number_format($shipping, 2) }}
                        </span>

                    </div>

                    <!-- TOTAL -->
                    <div class="flex justify-between border-t pt-4 mb-6">

                        <span class="text-xl font-bold text-gray-800">
                            Total
                        </span>

                        <span class="text-2xl font-bold text-indigo-600">
                            ৳ {{ number_format($total, 2) }}
                        </span>

                    </div>

                    <!-- BUTTONS -->
                    <div class="space-y-4">

                        <a href="{{ route('checkout') }}"
                           class="block w-full bg-green-600 hover:bg-green-700 text-white text-center py-4 rounded-xl font-semibold transition">

                            Proceed To Checkout

                        </a>

                        <a href="{{ route('shop') }}"
                           class="block w-full bg-gray-900 hover:bg-black text-white text-center py-4 rounded-xl font-semibold transition">

                            Continue Shopping

                        </a>

                    </div>

                </div>

            </div>

        </div>

        @else

        <!-- EMPTY CART -->
        <div class="bg-white rounded-3xl shadow-md py-24 text-center">

            <div class="text-7xl mb-6">
                🛒
            </div>

            <h2 class="text-4xl font-bold text-gray-800 mb-4">
                Your Cart Is Empty
            </h2>

            <p class="text-gray-500 mb-10 text-lg">
                Looks like you haven’t added anything yet.
            </p>

            <a href="{{ route('shop') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-10 py-4 rounded-xl text-lg font-semibold transition">

                Start Shopping

            </a>

        </div>

        @endif

    </div>

</div>

@endsection