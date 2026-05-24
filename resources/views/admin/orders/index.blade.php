<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="container mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-6">All Orders</h1>

    <div class="bg-white shadow rounded overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">Order ID</th>
                    <th class="p-3 text-left">Customer</th>
                    <th class="p-3 text-left">Phone</th>
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

                        <td class="p-3">
                            {{ $order->user->name ?? 'Guest' }}
                        </td>

                        <td class="p-3">
                            {{ $order->phone }}
                        </td>

                        <td class="p-3 font-semibold">
                            {{ $order->total_price }} ৳
                        </td>

                        <td class="p-3">
                            {{ ucfirst($order->payment_status) }}
                        </td>

                        <td class="p-3">

                            @if($order->order_status == 'pending')
                                <span class="text-yellow-600 font-semibold">Pending</span>
                            @elseif($order->order_status == 'processing')
                                <span class="text-blue-600 font-semibold">Processing</span>
                            @else
                                <span class="text-green-600 font-semibold">Completed</span>
                            @endif

                        </td>

                        <td class="p-3">
                            {{ $order->created_at->format('d M Y') }}
                        </td>

                        <td class="p-3 flex gap-2">

                            <a href="{{ route('admin.orders.show', $order->id) }}"
                               class="bg-gray-800 text-white px-3 py-1 rounded text-sm">
                                View
                            </a>

                            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <select name="status"
                                        class="border p-1 rounded text-sm"
                                        onchange="this.form.submit()">

                                    <option disabled selected>Update</option>
                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="completed">Completed</option>

                                </select>
                            </form>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

</body>
</html>