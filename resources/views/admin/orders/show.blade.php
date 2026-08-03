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

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Order #{{ $order->id }}
            </h1>
            <p class="text-gray-500 mt-1">
                Placed on {{ $order->created_at->format('d M Y, h:i A') }}
            </p>
        </div>

        <a href="{{ route('admin.orders.index') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg transition">
            ← Back to Orders
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- ORDER ITEMS -->
        <div class="md:col-span-2 bg-white p-6 rounded-xl shadow">

            <h2 class="text-xl font-semibold mb-5">
                Order Items
            </h2>

            @foreach($order->items as $item)

                <div class="flex justify-between items-center border-b py-4">

                    <div>
                        <p class="font-semibold text-gray-800">
                            {{ $item->product->name ?? 'Product deleted' }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $item->quantity }} × ৳{{ number_format($item->price, 2) }}
                        </p>
                    </div>

                    <div class="font-bold text-indigo-600">
                        ৳{{ number_format($item->quantity * $item->price, 2) }}
                    </div>

                </div>

            @endforeach

        </div>

        <!-- CUSTOMER INFO -->
        <div class="bg-white p-6 rounded-xl shadow">

            <h2 class="text-xl font-semibold mb-5">
                Customer Info
            </h2>

            <p class="mb-3">
                <span class="font-semibold">Name:</span><br>
                {{ $order->user->name ?? 'Guest' }}
            </p>

            <p class="mb-3">
                <span class="font-semibold">Email:</span><br>
                {{ $order->user->email ?? 'N/A' }}
            </p>

            <p class="mb-3">
                <span class="font-semibold">Phone:</span><br>
                {{ $order->phone }}
            </p>

            <p class="mb-3">
                <span class="font-semibold">Shipping Address:</span><br>
                {{ $order->shipping_address }}
            </p>

            <hr class="my-5">

            <p class="mb-3">
                <span class="font-semibold">Payment Method:</span><br>
                {{ ucfirst($order->payment_method) }}
            </p>

            <p class="mb-3">
                <span class="font-semibold">Payment Status:</span><br>

                @if($order->payment_status == 'paid')
                    <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                        Paid
                    </span>
                @else
                    <span class="inline-block bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">
                        Pending
                    </span>
                @endif
            </p>

            <p class="mb-3">
                <span class="font-semibold">Order Status:</span><br>

                @if($order->order_status == 'pending')
                    <span class="inline-block bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">
                        Pending
                    </span>
                @elseif($order->order_status == 'processing')
                    <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                        Processing
                    </span>
                @else
                    <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                        Completed
                    </span>
                @endif
            </p>

            <hr class="my-5">

            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-lg font-bold text-gray-800">
                    Total: <span class="text-indigo-600">৳{{ number_format($order->total_price, 2) }}</span>
                </p>
            </div>

        </div>

    </div>

    <!-- UPDATE STATUS -->
    <div class="mt-8 bg-white p-6 rounded-xl shadow">

        <h2 class="text-lg font-semibold mb-4">
            Update Order Status
        </h2>

        <form action="{{ route('admin.orders.status', $order->id) }}"
              method="POST"
              class="flex flex-wrap gap-3 items-center">

            @csrf
            @method('PATCH')

            <select name="status"
                    class="border rounded-lg px-4 py-2">

                <option value="pending"
                    {{ $order->order_status == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="processing"
                    {{ $order->order_status == 'processing' ? 'selected' : '' }}>
                    Processing
                </option>

                <option value="completed"
                    {{ $order->order_status == 'completed' ? 'selected' : '' }}>
                    Completed
                </option>

            </select>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">
                Update Status
            </button>

        </form>

    </div>

</div>

</body>
</html>