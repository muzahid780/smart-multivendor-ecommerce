@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Welcome back, {{ auth()->user()->name }}
        </h1>

        <p class="text-gray-500 mt-2">
            Here is your activity overview
        </p>
    </div>

    <!-- CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <!-- MY ORDERS -->
        <a href="{{ route('my.orders') }}"
           class="block bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition duration-300">

            <div class="text-3xl mb-3">
                🛒
            </div>

            <h2 class="text-xl font-bold text-gray-800">
                My Orders
            </h2>

            <p class="text-gray-500 mt-2">
                View and track your orders
            </p>

        </a>

        <!-- CART -->
        <a href="{{ route('cart.page') }}"
           class="block bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition duration-300">

            <div class="text-3xl mb-3">
                🛍️
            </div>

            <h2 class="text-xl font-bold text-gray-800">
                Cart
            </h2>

            <p class="text-gray-500 mt-2">
                Items waiting for checkout
            </p>

        </a>

        <!-- PROFILE -->
        <a href="{{ route('profile.edit') }}"
           class="block bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition duration-300">

            <div class="text-3xl mb-3">
                👤
            </div>

            <h2 class="text-xl font-bold text-gray-800">
                Profile
            </h2>

            <p class="text-gray-500 mt-2">
                Update your account info
            </p>

        </a>

    </div>

    <!-- QUICK ACTION -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">

        <h2 class="text-xl font-bold mb-4 text-gray-800">
            Quick Actions
        </h2>

        <div class="flex flex-wrap gap-4">

            <a href="/shop"
               class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition">
                🛍️ Continue Shopping
            </a>

            <a href="{{ route('my.orders') }}"
               class="bg-gray-800 text-white px-5 py-2 rounded-lg hover:bg-black transition">
                📦 My Orders
            </a>

            <a href="{{ route('cart.page') }}"
               class="bg-orange-500 text-white px-5 py-2 rounded-lg hover:bg-orange-600 transition">
                🛒 View Cart
            </a>

        </div>

    </div>

</div>

@endsection