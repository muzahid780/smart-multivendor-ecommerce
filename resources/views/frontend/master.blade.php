
<DOCTYPE html>
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
            <div class="hidden lg:flex justify-center px-4 flex-shrink-0">
                <form action="{{ route('product.search') }}" method="GET" class="w-64 max-w-md">
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
<!-- RIGHT SIDE -->
<div class="hidden lg:flex items-center ml-auto gap-3">
    <div class="flex items-center gap-3 text-sm font-medium whitespace-nowrap">
        <a href="{{ route('home') }}" class="hover:text-indigo-600 transition">Home</a>
        <a href="{{ route('about') }}" class="hover:text-indigo-600 transition">About</a>
        <a href="{{ route('contact') }}" class="hover:text-indigo-600 transition">Contact</a>

<!-- PRODUCTS DROPDOWN -->
<div class="relative group">
    <a href="{{ route('shop') }}"
       class="hover:text-indigo-600 transition flex items-center gap-1">
        Products
        <span class="text-xs">▼</span>
    </a>

    <div class="absolute left-0 mt-2 w-52 bg-white rounded-xl shadow-lg border
                opacity-0 invisible group-hover:opacity-100
                group-hover:visible transition duration-400 z-50">

        @php
            $categories = \App\Models\Category::orderBy('name')->get();
        @endphp

        <a href="{{ route('shop') }}"
           class="block px-4 py-3 hover:bg-indigo-50 hover:text-indigo-600 border-b">
            🛍️ All Categories
        </a>

        @foreach($categories as $category)
            <a href="{{ route('shop', ['category' => $category->id]) }}"
               class="block px-4 py-3 hover:bg-indigo-50 hover:text-indigo-600 border-b last:border-b-0">
                {{ $category->name }}
            </a>
        @endforeach

    </div>
</div>
        <a href="{{ route('cart.page') }}" class="hover:text-indigo-600 transition">Cart</a>
       <a href="{{ route('wishlist.page') }}">
    ❤️ Wishlist (
    <span id="wishlist-count">
        {{ auth()->check() ? \App\Models\Wishlist::where('user_id', auth()->id())->count() : 0 }}
    </span>
    )
</a>

@auth
@php
    $notifications = auth()->user()
        ->notifications()
        ->latest()
        ->take(5)
        ->get();

    $unreadCount = auth()->user()
        ->unreadNotifications()
        ->count();
@endphp

<div class="relative group cursor-pointer ml-2">
    <span class="text-xl">🔔</span>

    @if($unreadCount > 0)
        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 rounded-full">
            {{ $unreadCount }}
        </span>
    @endif

    <!-- DROPDOWN -->
    <div class="absolute right-0 mt-2 w-52 bg-white shadow-lg rounded-xl border
                opacity-0 invisible group-hover:opacity-100 group-hover:visible transition z-50">

        <div class="p-3 border-b font-semibold">
            Notifications
        </div>

        @forelse($notifications as $notification)
            <div class="p-3 text-sm border-b hover:bg-gray-50">
                {{ $notification->data['message'] ?? 'New notification' }}
            </div>
        @empty
            <div class="p-3 text-sm text-gray-500">
                No notifications
            </div>
        @endforelse

        <a href="{{ url('/notifications/read') }}"
           class="block text-center p-2 text-indigo-600 hover:bg-gray-100 text-sm">
            Mark all as read
        </a>
    </div>
</div>
@endauth

        @auth
            <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 transition">
                Dashboard
            </a>
        @endauth
    </div>

    <div class="flex items-center gap-3 flex-shrink-0">
        @guest
            <a href="{{ route('login') }}"
               class="bg-indigo-600 text-white px-2 py-2 rounded-full hover:bg-indigo-700 transition">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="bg-indigo-600 text-white px-2 py-2 rounded-full hover:bg-indigo-700 transition">
                Signup
            </a>
        @else

<div class="relative group">

    <!-- User Name -->
    <button class="flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-indigo-600">

        <span>{{ auth()->user()->name }}</span>

        <span class="text-xs">▼</span>

    </button>

    <!-- Dropdown -->
    <div class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-lg border
                opacity-0 invisible group-hover:opacity-100
                group-hover:visible transition duration-200 z-50">

        <a href="{{ route('profile.edit') }}"
           class="block px-4 py-3 hover:bg-indigo-50">
            👤 Edit Profile
        </a>

        <a href="{{ route('my.orders') }}"
           class="block px-4 py-3 hover:bg-indigo-50">
            📦 My Orders
        </a>

        <a href="{{ route('wishlist.page') }}"
           class="block px-4 py-3 hover:bg-indigo-50">
            ❤️ Wishlist
        </a>

        <hr>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50">
                🚪 Logout
            </button>
        </form>

    </div>

</div>

@endguest
    </div>
</div>

<!-- Mobile Menu Button -->
<button class="lg:hidden text-2xl">
    ☰
</button>
        </div>
    </div>
</nav>

<!-- MAIN -->
<main class="flex-1 min-h-screen">
    @yield('content')
</main>

<!-- TOAST POPUP -->
<div id="toast"
     class="fixed top-5 right-5 hidden bg-green-600 text-white px-6 py-3 rounded-xl shadow-lg z-50">
</div>

@if(session('success'))
<script>
    let toast = document.getElementById('toast');
    toast.innerText = "{{ session('success') }}";
    toast.classList.remove('hidden');

    setTimeout(() => {
        toast.classList.add('hidden');
    }, 3000);
</script>
@endif

@if(session('error'))
<script>
    let toast = document.getElementById('toast');
    toast.innerText = "{{ session('error') }}";
    toast.classList.remove('hidden');

    setTimeout(() => {
        toast.classList.add('hidden');
    }, 3000);
</script>
@endif

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
                <a href="{{ route('about') }}"
                   class="transition hover:text-indigo-400 hover:translate-x-1 inline-block">
                    About
                </a>
            </li>
            <li>
                <a href="{{ route('contact') }}"
                   class="transition hover:text-indigo-400 hover:translate-x-1 inline-block">
                    Contact
                </a>
            </li>
            <li>
                <a href="{{ route('shop') }}"
                   class="transition hover:text-indigo-400 hover:translate-x-1 inline-block">
                    Products
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function addToCart(productId) {
    $.ajax({
        url: "/cart/add/" + productId,
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function (res) {
            Swal.fire({
                icon: 'success',
                title: 'Added!',
                text: res.message
            });
        },
        error: function (xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: xhr.responseJSON?.message || 'Failed'
            });
        }
    });
}

function toggleWishlist(productId) {

    $.ajax({
        url: "/wishlist/" + productId,
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}"
        },

        success: function(res) {

            Swal.fire({
                icon: 'success',
                title: res.message,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1200
            });

            // LIVE COUNT UPDATE 
            let count = parseInt($("#wishlist-count").text()) || 0;

            if (res.status === "added") {
                $("#wishlist-count").text(count + 1);
            }

            if (res.status === "removed") {
                $("#wishlist-count").text(Math.max(0, count - 1));
            }
        },

        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: xhr.responseJSON?.message ?? 'Please login first!'
            });
        }
    });
}
</script>
@stack('scripts')
</body>
</html>