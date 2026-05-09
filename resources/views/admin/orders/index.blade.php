<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-sky-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white p-5">
        <h1 class="text-2xl font-bold mb-6">Admin Panel</h1>

        <nav class="space-y-2">
            <a href="/admin/dashboard" class="block p-2 rounded hover:bg-gray-800">Dashboard</a>
            <a href="/admin/products" class="block p-2 rounded hover:bg-gray-800">Products</a>
            <a href="/admin/orders" class="block p-2 rounded bg-gray-800">Orders</a>
        </nav>
    </aside>

    <!-- Main -->
    <main class="flex-1 p-8">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold">Orders</h2>

            <a href="/admin/orders/create"
               class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                + Create Order
            </a>
        </div>

        <div class="bg-white shadow rounded-xl overflow-hidden">

            <table class="w-full text-left">

                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3">ID</th>
                        <th class="p-3">Customer</th>
                        <th class="p-3">Product</th>
                        <th class="p-3">Qty</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Status</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($orders as $order)

                    <tr class="border-b">

                        <td class="p-3">{{ $order->id }}</td>

                        <td class="p-3">
                            <div>
                                <div class="font-semibold">{{ $order->customer_name }}</div>
                                <div class="text-sm text-gray-500">{{ $order->customer_email }}</div>
                            </div>
                        </td>

                        <td class="p-3">
                            {{ $order->product->name ?? 'Deleted Product' }}
                        </td>

                        <td class="p-3">
                            {{ $order->quantity }}
                        </td>

                        <td class="p-3">
                            ${{ $order->total_price }}
                        </td>

                        <td class="p-3">

                            <form action="{{ route('orders.status', $order->id) }}"
                                  method="POST">
                                @csrf
                                @method('PATCH')

                                <button class="px-3 py-1 rounded text-white
                                    {{ $order->status == 'pending' ? 'bg-yellow-500' : 'bg-green-600' }}">

                                    {{ ucfirst($order->status) }}

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="p-5 text-center text-gray-500">
                            No orders found
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </main>

</div>

</body>
</html>