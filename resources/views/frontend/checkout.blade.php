<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="container mx-auto px-4 py-10">

    <h1 class="text-3xl font-bold mb-6 text-gray-800">
        Checkout
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- SHIPPING FORM -->
        <div class="lg:col-span-2">

            <div class="bg-white rounded-lg shadow p-6">

                <h2 class="text-xl font-semibold mb-6">
                    Shipping Information
                </h2>

                @if(session('error'))
                    <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('place.order') }}" method="POST">
                    @csrf

                    <!-- PHONE -->
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Phone Number</label>
                        <input type="text"
                               name="phone"
                               value="{{ old('phone') }}"
                               class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                               placeholder="01XXXXXXXXX"
                               required>
                    </div>

                    <!-- ADDRESS -->
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Shipping Address</label>
                        <textarea name="shipping_address"
                                  rows="4"
                                  class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                                  placeholder="Enter full address"
                                  required>{{ old('shipping_address') }}</textarea>
                    </div>

                    <!-- PAYMENT METHOD -->
                    <div class="mb-6">

                        <label class="block mb-3 font-medium">
                            Payment Method
                        </label>

                        <div class="space-y-3">

                            <label class="flex items-center gap-3 border rounded-lg p-3 cursor-pointer hover:bg-gray-50">

                                <input type="radio"
                                       name="payment_method"
                                       value="cash_on_delivery"
                                       checked>

                                <div>
                                    <p class="font-medium">Cash On Delivery</p>
                                    <p class="text-sm text-gray-500">Pay when product arrives</p>
                                </div>

                            </label>

                            <label class="flex items-center gap-3 border rounded-lg p-3 cursor-pointer hover:bg-gray-50">

                                <input type="radio"
                                       name="payment_method"
                                       value="sslcommerz">

                                <div>
                                    <p class="font-medium">Online Payment</p>
                                    <p class="text-sm text-gray-500">
                                        bKash, Nagad, Rocket
                                    </p>
                                </div>

                            </label>

                        </div>

                    </div>

                    <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition">
                        Place Order
                    </button>

                </form>

            </div>

        </div>

        <!-- ORDER SUMMARY -->
        <div>

            <div class="bg-white rounded-lg shadow p-6">

                <h2 class="text-xl font-semibold mb-4">
                    Order Summary
                </h2>

                @php $total = 0; @endphp

                @foreach($cart as $item)

                    @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    @endphp

                    <div class="flex justify-between border-b py-3">

                        <div>
                            <p class="font-medium">{{ $item['name'] }}</p>

                            <p class="text-sm text-gray-500">
                                {{ $item['quantity'] }} × ৳{{ number_format($item['price'], 2) }}
                            </p>
                        </div>

                        <div class="font-semibold">
                            ৳{{ number_format($subtotal, 2) }}
                        </div>

                    </div>

                @endforeach

                <div class="flex justify-between mt-6 text-xl font-bold">

                    <span>Total</span>

                    <span>৳{{ number_format($total, 2) }}</span>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>