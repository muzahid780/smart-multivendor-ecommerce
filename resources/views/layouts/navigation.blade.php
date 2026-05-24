<nav class="bg-white shadow-md border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-center h-20">

            <!-- LEFT SIDE -->
            <div class="flex items-center gap-10">

                <!-- LOGO -->
                <a href="{{ url('/') }}" class="text-3xl font-extrabold text-indigo-600">
                    ShopNest
                </a>

                <!-- UNIVERSAL SEARCH (FIXED + SAFE) -->
                <div class="relative hidden md:block w-[420px]">

                    <input type="text"
                           id="searchInput"
                           autocomplete="off"
                           placeholder="Search products, brands, categories..."
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                    <!-- DROPDOWN -->
                    <div id="searchResults"
                         class="absolute left-0 right-0 bg-white shadow-lg rounded-xl mt-2 hidden max-h-96 overflow-y-auto z-50">
                    </div>

                </div>

            </div>

            <!-- DESKTOP MENU -->
            <div class="hidden md:flex items-center gap-8">

                <a href="{{ url('/') }}" class="hover:text-indigo-600 font-medium">Home</a>

                <a href="{{ route('products.index') }}" class="hover:text-indigo-600 font-medium">Products</a>

                <!-- CART -->
                @php
                    $cartCount = count(session('cart', []));
                @endphp

                <a href="{{ route('cart.page') }}" class="relative hover:text-indigo-600 font-medium">
                    Cart

                    @if($cartCount > 0)
                        <span class="absolute -top-3 -right-4 bg-red-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                <!-- AUTH -->
                @auth
                    <div class="relative group">

                        <button class="bg-indigo-600 text-white px-5 py-2 rounded-xl">
                            {{ Auth::user()->name }}
                        </button>

                        <div class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-xl hidden group-hover:block">

                            <a href="{{ url('/dashboard') }}" class="block px-4 py-3 hover:bg-gray-100 rounded-t-xl">
                                Dashboard
                            </a>

                            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 hover:bg-gray-100">
                                Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left px-4 py-3 hover:bg-gray-100 rounded-b-xl">
                                    Logout
                                </button>
                            </form>

                        </div>

                    </div>

                @else
                    <div class="flex items-center gap-3">

                        <a href="{{ route('login') }}" class="hover:text-indigo-600 font-medium">
                            Login
                        </a>

                        <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-xl">
                            Register
                        </a>

                    </div>
                @endauth

            </div>

            <!-- MOBILE -->
            <div class="md:hidden">
                <button class="text-gray-700 text-2xl">☰</button>
            </div>

        </div>

    </div>

</nav>

<!-- ================= SAFE AJAX SEARCH SCRIPT ================= -->
<script>
const searchInput = document.getElementById("searchInput");
const searchResults = document.getElementById("searchResults");

let timer;

if (searchInput) {

    searchInput.addEventListener("keyup", function () {

        clearTimeout(timer);

        let query = this.value.trim();

        if (query.length < 2) {
            searchResults.classList.add("hidden");
            searchResults.innerHTML = "";
            return;
        }

        timer = setTimeout(() => {

            fetch(`/live-search?query=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {

                    searchResults.innerHTML = "";

                    if (!data || data.length === 0) {
                        searchResults.innerHTML = `
                            <div class="p-3 text-gray-500 text-sm">
                                No products found
                            </div>`;
                    } else {

                        data.forEach(item => {

                            searchResults.innerHTML += `
                                <a href="/product/${item.id}"
                                   class="block px-4 py-3 hover:bg-gray-100 border-b">

                                    <div class="font-medium">${item.name}</div>
                                    <div class="text-xs text-gray-500">
                                        ${item.category ?? ''} ${item.brand ?? ''}
                                    </div>

                                </a>
                            `;
                        });
                    }

                    searchResults.classList.remove("hidden");
                })
                .catch(err => {
                    console.error("Search error:", err);
                });

        }, 300);

    });

    // click outside close
    document.addEventListener("click", function (e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.classList.add("hidden");
        }
    });
}
</script>