<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Panel</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-900 text-white hidden md:flex flex-col">

        <div class="p-6 text-2xl font-bold border-b border-gray-800">
            Vendor Panel
        </div>

        <nav class="flex-1 p-4 space-y-2">

            <a href="{{ route('vendor.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-800 transition">

                <i data-lucide="layout-dashboard"></i>
                Dashboard
            </a>

            <a href="{{ route('vendor.products.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-800 transition">

                <i data-lucide="package"></i>
                Products
            </a>

            <a href="{{ route('vendor.orders.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-800 transition">

                <i data-lucide="shopping-cart"></i>
                Orders
            </a>

            <a href="{{ route('home') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-800 transition">

                <i data-lucide="store"></i>
                Visit Store
            </a>

        </nav>

    </aside>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col">

        <!-- TOPBAR -->
        <header class="bg-white border-b px-6 py-4 flex justify-between items-center">

            <div>

                <h1 class="text-xl font-bold text-gray-800">
                    Vendor Dashboard
                </h1>

            </div>

            <div class="flex items-center gap-4">

                <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">

                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                </div>

            </div>

        </header>

        <!-- PAGE CONTENT -->
        <main class="p-6">

            @yield('content')

        </main>

    </div>

</div>

<script>
    lucide.createIcons();
</script>

</body>
</html>