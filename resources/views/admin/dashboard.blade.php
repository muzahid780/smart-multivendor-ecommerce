@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-title', 'Analytics Dashboard')

@section('content')

<!-- KPI CARDS -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

    <!-- TOTAL ORDERS -->
    <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-gray-500 text-sm">Total Orders</p>
                <h2 class="text-3xl font-bold mt-2 text-gray-800">
                    {{ $totalOrders }}
                </h2>
            </div>

            <div class="bg-blue-100 p-4 rounded-xl text-2xl">
                📦
            </div>

        </div>
    </div>

    <!-- TOTAL REVENUE -->
    <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-gray-500 text-sm">Total Revenue</p>
                <h2 class="text-3xl font-bold mt-2 text-green-600">
                    {{ $totalRevenue }} ৳
                </h2>
            </div>

            <div class="bg-green-100 p-4 rounded-xl text-2xl">
                💰
            </div>

        </div>
    </div>

    <!-- TOTAL PRODUCTS -->
    <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-gray-500 text-sm">Total Products</p>
                <h2 class="text-3xl font-bold mt-2 text-indigo-600">
                    {{ $totalProducts }}
                </h2>
            </div>

            <div class="bg-indigo-100 p-4 rounded-xl text-2xl">
                🛍️
            </div>

        </div>
    </div>

    <!-- TOTAL USERS -->
    <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-gray-500 text-sm">Total Users</p>
                <h2 class="text-3xl font-bold mt-2 text-purple-600">
                    {{ $totalUsers }}
                </h2>
            </div>

            <div class="bg-purple-100 p-4 rounded-xl text-2xl">
                👥
            </div>

        </div>
    </div>

</div>

<!--CHART SECTION -->
<div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

    <!-- MONTHLY ORDERS -->
    <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">

        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800">Monthly Orders</h2>
            <span class="text-sm text-gray-500">This Year</span>
        </div>

        <canvas id="ordersChart"></canvas>
    </div>

    <!-- MONTHLY REVENUE -->
    <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">

        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800">Monthly Revenue</h2>
            <span class="text-sm text-gray-500">This Year</span>
        </div>

        <canvas id="revenueChart"></canvas>
    </div>

</div>

<!--RECENT ACTIVITY -->
<div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 mt-8">

    <div class="flex items-center justify-between mb-6">

        <h2 class="text-xl font-bold text-gray-800">Recent Activity</h2>

        <a href="{{ route('admin.orders.index') }}"
           class="text-indigo-600 text-sm font-medium hover:underline">
            View Orders
        </a>

    </div>

    <div class="space-y-4">

        <div class="flex items-center justify-between border-b pb-3">
            <div>
                <p class="font-medium text-gray-800">New order received</p>
                <p class="text-sm text-gray-500">Customer placed a new order.</p>
            </div>
            <span class="text-sm text-gray-400">Just now</span>
        </div>

        <div class="flex items-center justify-between border-b pb-3">
            <div>
                <p class="font-medium text-gray-800">Product added</p>
                <p class="text-sm text-gray-500">A new product was added to the store.</p>
            </div>
            <span class="text-sm text-gray-400">Today</span>
        </div>

    </div>

</div>

@endsection

<!-- SCRIPTS -->
@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    const months = [
        "Jan","Feb","Mar","Apr","May","Jun",
        "Jul","Aug","Sep","Oct","Nov","Dec"
    ];

    // ORDERS
    const orderData = @json($monthlyOrders ?? []);
    const orderValues = months.map((m, i) => orderData[i + 1] ?? 0);

    new Chart(document.getElementById('ordersChart'), {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Orders',
                data: orderValues,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });

    // REVENUE
    const revenueData = @json($monthlyRevenue ?? []);
    const revenueValues = months.map((m, i) => revenueData[i + 1] ?? 0);

    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Revenue (৳)',
                data: revenueValues,
                borderWidth: 2,
                tension: 0.4
            }]
        },
        options: {
            responsive: true
        }
    });

</script>

@endpush