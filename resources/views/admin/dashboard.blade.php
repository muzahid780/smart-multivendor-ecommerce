<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-sky-100 text-gray-800">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white p-6">

        <h1 class="text-2xl font-bold mb-8">Admin Panel</h1>

        <nav class="space-y-3">

            <a href="/admin/dashboard"
               class="block p-2 rounded bg-gray-800 hover:bg-gray-700">
                Dashboard
            </a>

            <a href="/admin/products"
               class="block p-2 rounded hover:bg-gray-700">
                Products
            </a>

            <a href="/admin/orders"
               class="block p-2 rounded hover:bg-gray-700">
                Orders
            </a>

        </nav>

    </aside>

    <!-- Main -->
    <main class="flex-1 p-8">

        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-3xl font-bold">Dashboard</h2>
            <p class="text-gray-600">Welcome back, Admin 👋</p>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <div class="bg-white p-5 rounded-xl shadow">
                <h3 class="text-gray-500">Products</h3>
                <p class="text-3xl font-bold text-blue-600">
                    {{ $totalProducts }}
                </p>
            </div>

            <div class="bg-white p-5 rounded-xl shadow">
                <h3 class="text-gray-500">Orders</h3>
                <p class="text-3xl font-bold text-indigo-600">
                    {{ $totalOrders }}
                </p>
            </div>

            <div class="bg-white p-5 rounded-xl shadow">
                <h3 class="text-gray-500">Pending</h3>
                <p class="text-3xl font-bold text-yellow-500">
                    {{ $pendingOrders }}
                </p>
            </div>

            <div class="bg-white p-5 rounded-xl shadow">
                <h3 class="text-gray-500">Completed</h3>
                <p class="text-3xl font-bold text-green-600">
                    {{ $completedOrders }}
                </p>
            </div>

        </div>

        <!-- Chart -->
        <div class="mt-10 bg-white p-6 rounded-xl shadow">

            <h3 class="text-xl font-bold mb-4">Orders Overview</h3>

            <canvas id="ordersChart"></canvas>

        </div>

        <!-- Recent Orders -->
        <div class="mt-10 bg-white p-6 rounded-xl shadow">

            <h3 class="text-xl font-bold mb-4">Recent Orders</h3>

            <table class="w-full text-left">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3">Customer</th>
                        <th class="p-3">Product</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Status</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($recentOrders as $order)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-3">
                            <div class="font-semibold">{{ $order->customer_name }}</div>
                            <div class="text-sm text-gray-500">{{ $order->customer_email }}</div>
                        </td>

                        <td class="p-3">
                            {{ $order->product->name ?? 'Deleted Product' }}
                        </td>

                        <td class="p-3">
                            ${{ $order->total_price }}
                        </td>

                        <td class="p-3">

                            <span class="px-3 py-1 rounded-full text-white text-sm
                                {{ $order->status == 'pending' ? 'bg-yellow-500' : 'bg-green-600' }}">

                                {{ ucfirst($order->status) }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">
                            No recent orders
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </main>

</div>

<!-- Chart Script -->
<script>
const ctx = document.getElementById('ordersChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Pending', 'Completed'],
        datasets: [{
            label: 'Orders',
            data: [
                {{ $pendingOrders }},
                {{ $completedOrders }}
            ],
            backgroundColor: [
                '#facc15',
                '#22c55e'
            ]
        }]
    },
    options: {
        responsive: true
    }
});
</script>

</body>
</html>