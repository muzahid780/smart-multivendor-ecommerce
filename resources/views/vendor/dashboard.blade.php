@extends('vendor.layout')

@section('content')

@php
    // 🔥 SAFE FALLBACKS (prevent crash)
    $totalProducts   = $totalProducts ?? 0;
    $totalStock      = $totalStock ?? 0;
    $activeProducts  = $activeProducts ?? ($approvedProducts ?? 0);
    $outOfStock      = $outOfStock ?? 0;

    $totalOrders     = $totalOrders ?? 0;
    $pendingOrders   = $pendingOrders ?? 0;
    $completedOrders = $completedOrders ?? 0;
    $totalEarnings   = $totalEarnings ?? 0;
@endphp

<!-- HEADER -->
<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-4xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-500 mt-2">Welcome back, manage your store easily.</p>
    </div>

    <a href="{{ route('vendor.products.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition">
        + Add Product
    </a>

</div>

<!-- STATS -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    <!-- TOTAL PRODUCTS -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border">
        <p class="text-gray-500 text-sm">Total Products</p>
        <h2 class="text-4xl font-bold text-gray-800 mt-3">{{ $totalProducts }}</h2>
    </div>

    <!-- TOTAL STOCK -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border">
        <p class="text-gray-500 text-sm">Total Stock</p>
        <h2 class="text-4xl font-bold text-gray-800 mt-3">{{ $totalStock }}</h2>
    </div>

    <!-- ACTIVE PRODUCTS -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border">
        <p class="text-gray-500 text-sm">Active Products</p>
        <h2 class="text-4xl font-bold text-gray-800 mt-3">{{ $activeProducts }}</h2>
    </div>

    <!-- OUT OF STOCK -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border">
        <p class="text-gray-500 text-sm">Out Of Stock</p>
        <h2 class="text-4xl font-bold text-gray-800 mt-3">{{ $outOfStock }}</h2>
    </div>

</div>

<!-- CHART + QUICK STATS -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mt-8">

    <!-- CHART -->
    <div class="xl:col-span-2 bg-white rounded-2xl p-6 shadow-sm border">
        <h2 class="text-xl font-bold mb-4">Sales Analytics</h2>
        <canvas id="salesChart"></canvas>
    </div>

    <!-- QUICK STATS -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border">

        <h2 class="text-xl font-bold mb-6">Quick Stats</h2>

        <div class="space-y-4">

            <div class="flex justify-between">
                <span>Revenue</span>
                <span class="font-bold text-green-600">৳ {{ $totalEarnings }}</span>
            </div>

            <div class="flex justify-between">
                <span>Orders</span>
                <span class="font-bold">{{ $totalOrders }}</span>
            </div>

            <div class="flex justify-between">
                <span>Pending</span>
                <span class="font-bold text-yellow-500">{{ $pendingOrders }}</span>
            </div>

            <div class="flex justify-between">
                <span>Completed</span>
                <span class="font-bold text-blue-600">{{ $completedOrders }}</span>
            </div>

        </div>
    </div>

</div>

<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('salesChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            data: [12, 19, 8, 15, 10, 22],
            borderColor: '#2563eb',
            backgroundColor: 'rgba(37,99,235,0.1)',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});
</script>

@endsection