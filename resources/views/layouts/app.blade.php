<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopNest - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-white shadow">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
              <!-- LOGO -->
<a href="/" class="flex items-center gap-2">
    <img src="{{ asset('images/logo.png') }}" alt="ShopNest Logo" class="h-10 w-auto">
    <span class="text-2xl font-bold text-indigo-600">ShopNest</span>
</a>
        <!-- MENU -->
        <div class="space-x-6 hidden md:flex">
            <a href="/" class="text-gray-700 hover:text-indigo-600">
                Home
            </a>
            <a href="/about" class="text-gray-700 hover:text-indigo-600">
                About
            </a>
            <a href="/contact" class="text-gray-700 hover:text-indigo-600">
                Contact
            </a>
            <a href="/shop" class="text-gray-700 hover:text-indigo-600">
                Products
            </a>
            <a href="/cart" class="text-gray-700 hover:text-indigo-600">
                Cart
            </a>

            <!-- ADMIN LINK -->
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="/admin/dashboard" class="text-red-600 font-semibold hover:text-red-800">
                        Admin
                    </a>
                @endif
            @endauth
        </div>

        <!-- AUTH SECTION -->
        <div class="space-x-3 flex items-center">
            @guest
                <a href="/login" class="text-indigo-600">
                    Login
                </a>
                <a href="/register"
                   class="bg-indigo-600 text-white px-4 py-2 rounded">
                    Register
                </a>
            @else
                <!-- USER NAME -->
                <span class="text-gray-700 font-medium">
                    {{ Auth::user()->name }}
                </span>

                <!-- MY ORDERS -->
                <a href="/my-orders"
                   class="text-sm text-blue-600 hover:underline">
                    My Orders
                </a>

                <!-- LOGOUT -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-500 text-sm">
                        Logout
                    </button>
                </form>
            @endguest
        </div>
    </div>
</nav>

<!-- CONTENT -->
<main class="min-h-screen container mx-auto px-6 py-8">
    @yield('content')
</main>
</body>
</html>