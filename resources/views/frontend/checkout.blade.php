<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="container mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-6">Checkout</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- LEFT: SHIPPING FORM -->
        <div class="md:col-span-2 bg-white p-6 rounded shadow">

            <h2 class="text-xl font-semibold mb-4">Shipping Information</h2>

            <form action="{{ route('place.order') }}" method="POST">
                @csrf

                <!-- PHONE -->
                <div class="mb-4">
                    <label class="block mb-1">Phone</label>
                    <input type="text" name="phone"
                           class="w-full border p-2 rounded"
                           placeholder="Enter phone number" required>
                </div>

                <!-- ADDRESS -->
                <div class="mb-4">
                    <label class="block mb-1">Shipping Address</label>
                    <textarea name="shipping_address"
                              class="w-full border p-2 rounded"
                              rows="4"
                              placeholder="Enter full address"
                              required></textarea>
                </div>

                <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                    Place Order
                </button>

            </form>

        </div>

        <!-- RIGHT: ORDER SUMMARY -->
        <div class="bg-white p-6 rounded shadow">

            <h2 class="text-xl font-semibold mb-4">Order Summary</h2>

            @php $total = 0; @endphp

            @foreach($cart as $item)
                @php
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                @endphp

                <div class="flex justify-between border-b py-2">
                    <div>
                        <p class="font-medium">{{ $item['name'] }}</p>
                        <p class="text-sm text-gray-500">
                            {{ $item['quantity'] }} × {{ $item['price'] }}
                        </p>
                    </div>

                    <div>
                        <p class="font-semibold">{{ $subtotal }}</p>
                    </div>
                </div>
            @endforeach

            <!-- TOTAL -->
            <div class="flex justify-between mt-4 text-lg font-bold">
                <span>Total:</span>
                <span>{{ $total }}</span>
            </div>

        </div>

    </div>

</div>

</body>
</html>