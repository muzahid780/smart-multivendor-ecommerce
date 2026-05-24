<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="container mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-6">
        Order #{{ $order->id }} Details
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- LEFT: ITEMS -->
        <div class="md:col-span-2 bg-white p-6 rounded shadow">

            <h2 class="text-xl font-semibold mb-4">Order Items</h2>

            @foreach($order->items as $item)

                <div class="flex justify-between border-b py-3">

                    <div>
                        <p class="font-semibold">
                            {{ $item->product->name ?? 'Product deleted' }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $item->quantity }} × {{ $item->price }}
                        </p>
                    </div>

                    <div class="font-bold">
                        {{ $item->quantity * $item->price }} ৳
                    </div>

                </div>

            @endforeach

        </div>

        <!-- RIGHT: ORDER INFO -->
        <div class="bg-white p-6 rounded shadow">

            <h2 class="text-xl font-semibold mb-4">Customer Info</h2>

            <p class="mb-2">
                <span class="font-semibold">Name:</span><br>
                {{ $order->user->name ?? 'Guest' }}
            </p>

            <p class="mb-2">
                <span class="font-semibold">Email:</span><br>
                {{ $order->user->email ?? 'N/A' }}
            </p>

            <p class="mb-2">
                <span class="font-semibold">Phone:</span><br>
                {{ $order->phone }}
            </p>

            <p class="mb-2">
                <span class="font-semibold">Shipping Address:</span><br>
                {{ $order->shipping_address }}
            </p>

            <hr class="my-4">

            <p class="mb-2">
                <span class="font-semibold">Payment Method:</span><br>
                {{ ucfirst($order->payment_method) }}
            </p>

            <p class="mb-2">
                <span class="font-semibold">Payment Status:</span><br>
                {{ ucfirst($order->payment_status) }}
            </p>

            <p class="mb-2">
                <span class="font-semibold">Order Status:</span><br>

                @if($order->order_status == 'pending')
                    <span class="text-yellow-600 font-semibold">Pending</span>
                @elseif($order->order_status == 'processing')
                    <span class="text-blue-600 font-semibold">Processing</span>
                @else
                    <span class="text-green-600 font-semibold">Completed</span>
                @endif

            </p>

            <hr class="my-4">

            <p class="text-lg font-bold">
                Total: {{ $order->total_price }} ৳
            </p>

        </div>

    </div>

    <div class="mt-6 flex gap-3">

        <a href="{{ route('admin.orders.index') }}"
           class="bg-gray-800 text-white px-4 py-2 rounded">
            ← Back
        </a>

        <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="flex gap-2">
            @csrf
            @method('PATCH')

            <select name="status" class="border p-2 rounded">
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="completed">Completed</option>
            </select>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>

        </form>

    </div>

</div>

</body>
</html>