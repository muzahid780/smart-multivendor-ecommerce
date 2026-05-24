<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="container mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-6">My Orders</h1>

    @if($orders->count() == 0)

        <div class="bg-white p-6 rounded shadow text-center">
            <p class="text-gray-600">You have no orders yet.</p>
            <a href="{{ route('shop') }}"
               class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded">
                Start Shopping
            </a>
        </div>

    @else

        <div class="bg-white shadow rounded overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3 text-left">Order ID</th>
                        <th class="p-3 text-left">Total</th>
                        <th class="p-3 text-left">Payment</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Date</th>
                        <th class="p-3 text-left">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($orders as $order)

                        <tr class="border-b">

                            <td class="p-3">
                                #{{ $order->id }}
                            </td>

                            <td class="p-3 font-semibold">
                                {{ $order->total_price }} ৳
                            </td>

                            <td class="p-3">
                                {{ ucfirst($order->payment_status) }}
                            </td>

                            <td class="p-3">
                                @if($order->order_status == 'pending')
                                    <span class="text-yellow-600">Pending</span>
                                @elseif($order->order_status == 'processing')
                                    <span class="text-blue-600">Processing</span>
                                @else
                                    <span class="text-green-600">Completed</span>
                                @endif
                            </td>

                            <td class="p-3">
                                {{ $order->created_at->format('d M Y') }}
                            </td>

                            <td class="p-3">
                                <a href="{{ route('order.show', $order->id) }}"
                                   class="bg-gray-800 text-white px-3 py-1 rounded text-sm">
                                    View
                                </a>
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @endif

</div>

</body>
</html>