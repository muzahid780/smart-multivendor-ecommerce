<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopNest</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
</head>

<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

<!-- NAVBAR -->
<nav class="bg-white shadow-md sticky top-0 z-50 border-b">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between h-16">

            <!-- LOGO -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 flex-shrink-0">

                <img src="{{ asset('images/logo.png') }}"
                     class="h-10 w-10 object-contain"
                     alt="ShopNest">

                <span class="text-2xl font-bold text-indigo-600">
                    ShopNest
                </span>

            </a>

            <!-- SEARCH -->
            <div class="hidden md:flex flex-1 justify-center px-6">

                <form action="{{ route('product.search') }}" method="GET" class="w-80 max-w-xl">

                    <div class="flex items-center border border-gray-300 rounded-full overflow-hidden bg-white shadow-sm">

                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search products..."
                               class="w-full px-4 py-2 text-sm outline-none bg-transparent">

                        <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2">
                            Search
                        </button>

                    </div>

                </form>

            </div>

          <!-- RIGHT SIDE (MENU + AUTH COMBINED) -->
<div class="hidden lg:flex items-center ml-auto">

    <!-- MENU -->
    <div class="flex items-center gap-6 text-sm font-medium">

        <a href="{{ route('home') }}" class="hover:text-indigo-600 transition">Home</a>
        <a href="{{ route('shop') }}" class="hover:text-indigo-600 transition">Shop</a>
        <a href="{{ route('cart.page') }}" class="hover:text-indigo-600 transition">Cart</a>

        @auth
            <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 transition">Dashboard</a>

            @if(auth()->user()->role === 'vendor')
                <a href="{{ route('vendor.dashboard') }}" class="hover:text-indigo-600 transition">Vendor</a>
            @endif
        @endauth

    </div>
    <div class="w-6"></div>
    <div class="flex items-center gap-3">

        @guest
            <a href="{{ route('login') }}"
               class="px-4 py-2 rounded-full border border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white transition">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition">
                Register
            </a>
        @endguest

    </div>

</div>

            <button class="lg:hidden text-2xl">☰</button>

        </div>

    </div>

</nav>

<!-- MAIN -->
<main class="flex-1 min-h-screen">
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="bg-gray-900 text-white pt-14 pb-8 mt-10">
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-8 items-start">

    <!-- ABOUT -->
    <div class="lg:col-span-2 pr-4">

        <div class="flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}"
                 class="h-10 w-10 rounded-full"
                 alt="ShopNest">

            <span class="text-2xl font-bold text-indigo-400">
                ShopNest
            </span>
        </div>

        <p class="text-gray-400 mt-4 text-sm leading-relaxed max-w-md">
            Discover a smarter way to shop. ShopNest connects trusted sellers with buyers,
            delivering quality products and seamless shopping experience.
        </p>

    </div>

    <!-- QUICK LINKS -->
    <div>

        <h3 class="font-bold mb-4 text-lg text-white">
            Quick Links
        </h3>

        <ul class="space-y-3 text-gray-400 text-sm">

            <li>
                <a href="{{ route('home') }}"
                   class="transition hover:text-indigo-400 hover:translate-x-1 inline-block">
                    Home
                </a>
            </li>

            <li>
                <a href="{{ route('shop') }}"
                   class="transition hover:text-indigo-400 hover:translate-x-1 inline-block">
                    Shop
                </a>
            </li>

            <li>
                <a href="{{ route('cart.page') }}"
                   class="transition hover:text-indigo-400 hover:translate-x-1 inline-block">
                    Cart
                </a>
            </li>

        </ul>

    </div>

    <!-- HELP -->
    <div>

        <h3 class="font-bold mb-4 text-lg text-white">
            Help
        </h3>

        <ul class="space-y-3 text-gray-400 text-sm">

            <li>
                <a href="#"
                   class="transition hover:text-pink-400 hover:translate-x-1 inline-block">
                    Support
                </a>
            </li>

            <li>
                <a href="#"
                   class="transition hover:text-pink-400 hover:translate-x-1 inline-block">
                    FAQ
                </a>
            </li>

            <li>
                <a href="#"
                   class="transition hover:text-pink-400 hover:translate-x-1 inline-block">
                    Shipping Info
                </a>
            </li>

        </ul>

    </div>

    <!-- CONTACT -->
    <div>

        <h3 class="font-bold mb-4 text-lg text-white">
            Contact
        </h3>

        <ul class="space-y-3 text-gray-400 text-sm">

            <li>📞+880 1942429531</li>
            <li>📞+880 1783717212</li>
            <li>📍 Khulna, Bangladesh</li>
            <li>✉️support@shopnest.com</li>

        </ul>

    </div>

    <!-- NEWSLETTER -->
    <div>

        <h3 class="font-bold mb-4 text-lg text-white">
            Newsletter
        </h3>

        <p class="text-gray-400 text-sm mb-4">
            Subscribe for updates & offers.
        </p>

        <form class="space-y-3">

            <input type="email"
                   placeholder="Enter email"
                   class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white outline-none focus:ring-2 focus:ring-indigo-500">

            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 transition py-3 rounded-xl font-semibold">
                Subscribe
            </button>

        </form>

    </div>

</div>

    <div class="text-center border-t border-gray-800 mt-10 pt-6 text-gray-400 text-sm">
        © {{ date('Y') }} <span class="text-indigo-400 font-semibold">ShopNest</span>. All rights reserved.
    </div>

</footer>

</body>
</html>