<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartShop - @yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- ================= NAVBAR ================= -->
<nav class="bg-white shadow">

    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

        <a href="/" class="text-2xl font-bold text-indigo-600">
            SmartShop
        </a>

        <div class="space-x-6 hidden md:flex">

            <a href="/" class="text-gray-700 hover:text-indigo-600">Home</a>
            <a href="/shop" class="text-gray-700 hover:text-indigo-600">Shop</a>
            <a href="/cart" class="text-gray-700 hover:text-indigo-600">Cart</a>

        </div>

        <div class="space-x-3">

            <a href="/login" class="text-indigo-600">Login</a>
            <a href="/register" class="bg-indigo-600 text-white px-4 py-2 rounded">
                Register
            </a>

        </div>

    </div>

</nav>

<!-- ================= CONTENT ================= -->
<main class="min