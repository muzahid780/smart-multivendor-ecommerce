<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Panel - @yield('title', 'Dashboard')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    @stack('styles')
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col">

        <!-- LOGO -->
        <div class="p-6 border-b border-gray-700">
            <a href="{{ route('admin.dashboard') }}"
               class="text-3xl font-bold text-indigo-400">
                ShopNest
            </a>
        </div>

        <!-- MENU -->
        <nav class="flex-1 p-4 space-y-2">

            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
                📊 Dashboard
            </a>

            <a href="{{ route('admin.products.index') }}"
               class="block px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.products.*') ? 'bg-gray-800' : '' }}">
                📦 Products
            </a>

            <a href="{{ route('admin.orders.index') }}"
               class="block px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.orders.*') ? 'bg-gray-800' : '' }}">
                🛒 Orders
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="block px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-800' : '' }}">
                🗂 Categories
            </a>

            <!-- USERS -->
            <a href="{{ route('admin.users.index') }}"
               class="block px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.users.*') ? 'bg-gray-800' : '' }}">
                👥 Users
            </a>

            <!-- 🔥 FIXED: PENDING PRODUCTS -->
            <a href="{{ route('admin.products.pending') }}"
               class="block px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.products.pending') ? 'bg-gray-800' : '' }}">
                ⏳ Pending Products
            </a>

        </nav>

        <!-- LOGOUT -->
        <div class="p-4 border-t border-gray-700">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg">
                    Logout
                </button>
            </form>

        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col">

        <!-- HEADER -->
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">

            <h1 class="text-2xl font-bold text-gray-800">
                @yield('page-title', 'Dashboard')
            </h1>

            <span class="font-medium text-gray-700">
                {{ auth()->user()->name }}
            </span>

        </header>

        <!-- CONTENT -->
        <main class="p-6 flex-1">
            @yield('content')
        </main>

    </div>

</div>

@stack('scripts')

</body>
</html>