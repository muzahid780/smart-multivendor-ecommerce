<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="container mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-6">
        Order #{{ $order->id }}
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- LEFT: ORDER ITEMS -->
        <div class="md:col-span-2 bg-white p-6 rounded shadow">

            <h2 class="text-xl font-semibold mb-4">
                Order Items
            </h2>

            @foreach($order->items as $item)

                <div class="flex justify-between border-b py-3">

                    <div>
                        <p class="font-semibold">
                            {{ $item->product->name ?? 'Product removed' }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $item->quantity }} × ৳{{ number_format($item->price, 2) }}
                        </p>
                    </div>

                    <div class="font-bold">
                        ৳{{ number_format($item->quantity * $item->price, 2) }}
                    </div>

                </div>

            @endforeach

            <!-- TOTAL INSIDE LEFT SIDE -->
            <div class="flex justify-between mt-6 text-lg font-bold">
                <span>Total</span>
                <span>৳{{ number_format($order->total_price, 2) }}</span>
            </div>

        </div>

        <!-- RIGHT: ORDER INFO -->
        <div class="bg-white p-6 rounded shadow">

            <h2 class="text-xl font-semibold mb-4">
                Order Info
            </h2>

            <p class="mb-3">
                <span class="font-semibold">Phone:</span><br>
                {{ $order->phone }}
            </p>

            <p class="mb-3">
                <span class="font-semibold">Shipping Address:</span><br>
                {{ $order->shipping_address }}
            </p>

            <p class="mb-3">
                <span class="font-semibold">Payment Method:</span><br>
                {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
            </p>

            <p class="mb-3">
                <span class="font-semibold">Payment Status:</span><br>

                @if($order->payment_status === 'paid')
                    <span class="text-green-600 font-semibold">Paid</span>
                @else
                    <span class="text-red-600 font-semibold">Pending</span>
                @endif

            </p>

            <p class="mb-3">
                <span class="font-semibold">Order Status:</span><br>

                @if($order->order_status === 'pending')
                    <span class="text-yellow-600 font-semibold">Pending</span>

                @elseif($order->order_status === 'processing')
                    <span class="text-blue-600 font-semibold">Processing</span>

                @elseif($order->order_status === 'completed')
                    <span class="text-green-600 font-semibold">Completed</span>

                @elseif($order->order_status === 'cancelled')
                    <span class="text-red-600 font-semibold">Cancelled</span>
                @endif

            </p>

            <hr class="my-4">

            <!-- SSLCOMMERZ PAY NOW BUTTON -->
            @if($order->payment_method === 'sslcommerz' && $order->payment_status === 'pending')

                <form action="{{ route('sslcommerz.pay') }}"
                      method="POST"
                      class="mt-5">

                    @csrf

                    <input type="hidden" name="order_id" value="{{ $order->id }}">

                    <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition">
                        Pay Now
                    </button>

                </form>

            @else

                @if($order->payment_method === 'sslcommerz')
                    <p class="text-green-600 font-semibold mt-4">
                        Payment already completed
                    </p>
                @endif

            @endif

        </div>

    </div>

    <!-- BACK BUTTON -->
    <div class="mt-6">
        <a href="{{ route('my.orders') }}"
           class="bg-gray-800 hover:bg-gray-900 text-white px-5 py-2 rounded">
            ← Back to Orders
        </a>
    </div>

</div>

</body>
</html>