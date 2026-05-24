<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100">

<div class="container mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-6">Analytics Dashboard</h1>

    <!-- KPI CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

        <div class="bg-white p-6 rounded shadow text-center">
            <h2 class="text-gray-500">Total Orders</h2>
            <p class="text-3xl font-bold">{{ $totalOrders }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow text-center">
            <h2 class="text-gray-500">Total Revenue</h2>
            <p class="text-3xl font-bold">{{ $totalRevenue }} ৳</p>
        </div>

    </div>

    <!-- CHARTS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- ORDERS CHART -->
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Monthly Orders</h2>
            <canvas id="ordersChart"></canvas>
        </div>

        <!-- REVENUE CHART -->
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Monthly Revenue</h2>
            <canvas id="revenueChart"></canvas>
        </div>

    </div>

</div>

<script>
    const months = [
        "Jan","Feb","Mar","Apr","May","Jun",
        "Jul","Aug","Sep","Oct","Nov","Dec"
    ];

    // ================= ORDERS DATA =================
    const orderData = @json($monthlyOrders);

    const orderValues = months.map((m, i) => orderData[i+1] ?? 0);

    new Chart(document.getElementById('ordersChart'), {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Orders',
                data: orderValues,
                borderWidth: 1
            }]
        }
    });

    // ================= REVENUE DATA =================
    const revenueData = @json($monthlyRevenue);

    const revenueValues = months.map((m, i) => revenueData[i+1] ?? 0);

    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Revenue (৳)',
                data: revenueValues,
                borderWidth: 2
            }]
        }
    });

</script>

</body>
</html>