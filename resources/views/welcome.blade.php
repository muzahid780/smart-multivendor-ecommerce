<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart MultiVendor E-commerce</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- ================= NAVBAR ================= -->
    <nav class="bg-white shadow-md">

        <div class="container mx-auto px-6 py-4 flex justify-between items-center">

            <!-- Logo -->
            <a href="/" class="text-2xl font-bold text-indigo-600">
                ShopNest
            </a>

            <!-- Search -->
            <div class="hidden md:flex w-1/3">
                <input type="text"
                       placeholder="Search products..."
                       class="w-full border rounded-l-lg px-4 py-2 focus:outline-none">

                <button class="bg-indigo-600 text-white px-5 rounded-r-lg">
                    Search
                </button>
            </div>

            <!-- Menu -->
            <div class="space-x-4">

                <a href="/"
                   class="text-gray-700 hover:text-indigo-600">
                    Home
                </a>

                <a href="#"
                   class="text-gray-700 hover:text-indigo-600">
                    Shop
                </a>

                <a href="#"
                   class="text-gray-700 hover:text-indigo-600">
                    Cart
                </a>

                <a href="/login"
                   class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                    Login
                </a>

            </div>

        </div>

    </nav>


    <!-- ================= HERO SECTION ================= -->
    <section class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white">

        <div class="container mx-auto px-6 py-20 grid md:grid-cols-2 gap-10 items-center">

            <!-- Left -->
            <div>

                <h1 class="text-5xl font-bold leading-tight mb-6">
                    Best MultiVendor E-commerce Platform
                </h1>

                <p class="text-lg mb-6">
                    Buy trendy products from multiple vendors with secure shopping experience.
                </p>

                <button class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200">
                    Shop Now
                </button>

            </div>

            <!-- Right -->
            <div>

                <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30"
                     class="rounded-2xl shadow-2xl w-full h-[400px] object-cover">

            </div>

        </div>

    </section>


    <!-- ================= CATEGORIES ================= -->
    <section class="py-16">

        <div class="container mx-auto px-6">

            <h2 class="text-3xl font-bold mb-10 text-center">
                Shop By Categories
            </h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
                    <h3 class="font-bold text-lg">Electronics</h3>
                </div>

                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
                    <h3 class="font-bold text-lg">Fashions</h3>
                </div>

                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
                    <h3 class="font-bold text-lg">Groceries</h3>
                </div>

                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
                    <h3 class="font-bold text-lg">Books</h3>
                </div>

            </div>

        </div>

    </section>


    <!-- ================= FEATURED PRODUCTS ================= -->
    <section class="py-16 bg-white">

        <div class="container mx-auto px-6">

            <div class="flex justify-between items-center mb-10">

                <h2 class="text-3xl font-bold">
                    Featured Products
                </h2>

                <a href="#"
                   class="text-indigo-600 font-semibold">
                    View All
                </a>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                <!-- Product Card -->
                <div class="bg-gray-100 rounded-xl overflow-hidden shadow hover:shadow-xl transition">

                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff"
                         class="w-full h-52 object-cover">

                    <div class="p-5">

                        <h3 class="font-bold text-lg mb-2">
                            Nike Shoes
                        </h3>

                        <p class="text-gray-600 mb-3">
                            Stylish running shoes for men.
                        </p>

                        <div class="flex justify-between items-center">

                            <span class="text-indigo-600 font-bold text-xl">
                                $120
                            </span>

                            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                                Add to Cart
                            </button>

                        </div>

                    </div>

                </div>

                <!-- Product Card -->
                <div class="bg-gray-100 rounded-xl overflow-hidden shadow hover:shadow-xl transition">

                    <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9"
                         class="w-full h-52 object-cover">

                    <div class="p-5">

                        <h3 class="font-bold text-lg mb-2">
                            iPhone
                        </h3>

                        <p class="text-gray-600 mb-3">
                            Premium smartphone experience.
                        </p>

                        <div class="flex justify-between items-center">

                            <span class="text-indigo-600 font-bold text-xl">
                                $999
                            </span>

                            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                                Add to Cart
                            </button>

                        </div>

                    </div>

                </div>

                <!-- Product Card -->
                <div class="bg-gray-100 rounded-xl overflow-hidden shadow hover:shadow-xl transition">

                    <img src="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f"
                         class="w-full h-52 object-cover">

                    <div class="p-5">

                        <h3 class="font-bold text-lg mb-2">
                            Camera
                        </h3>

                        <p class="text-gray-600 mb-3">
                            Professional DSLR camera.
                        </p>

                        <div class="flex justify-between items-center">

                            <span class="text-indigo-600 font-bold text-xl">
                                $650
                            </span>

                            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                                Add to Cart
                            </button>

                        </div>

                    </div>

                </div>

                <!-- Product Card -->
                <div class="bg-gray-100 rounded-xl overflow-hidden shadow hover:shadow-xl transition">

                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e"
                         class="w-full h-52 object-cover">

                    <div class="p-5">

                        <h3 class="font-bold text-lg mb-2">
                            Headphone
                        </h3>

                        <p class="text-gray-600 mb-3">
                            Noise cancelling headphone.
                        </p>

                        <div class="flex justify-between items-center">

                            <span class="text-indigo-600 font-bold text-xl">
                                $199
                            </span>

                            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                                Add to Cart
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- ================= WHY CHOOSE US ================= -->
    <section class="py-16">

        <div class="container mx-auto px-6">

            <h2 class="text-3xl font-bold text-center mb-10">
                Why Choose Us
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="bg-white p-8 rounded-xl shadow text-center">
                    <h3 class="font-bold text-xl mb-3">Fast Delivery</h3>
                    <p class="text-gray-600">
                        Quick and secure nationwide delivery service.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow text-center">
                    <h3 class="font-bold text-xl mb-3">Secure Payment</h3>
                    <p class="text-gray-600">
                        Safe online transactions with trusted payment gateways.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow text-center">
                    <h3 class="font-bold text-xl mb-3">24/7 Support</h3>
                    <p class="text-gray-600">
                        Dedicated support team for customer assistance.
                    </p>
                </div>

            </div>

        </div>

    </section>


    <!-- ================= FOOTER ================= -->
    <footer class="bg-gray-900 text-white py-10">

        <div class="container mx-auto px-6 grid md:grid-cols-4 gap-8">

            <div>
                <h3 class="text-xl font-bold mb-4">ShopNest</h3>
                <p class="text-gray-400">
                    Professional multi-vendor e-commerce platform.
                </p>
            </div>

            <div>
                <h4 class="font-bold mb-4">Quick Links</h4>

                <ul class="space-y-2 text-gray-400">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">Cart</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-4">Customer Service</h4>

                <ul class="space-y-2 text-gray-400">
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Support</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-4">Newsletter</h4>

                <input type="email"
                       placeholder="Your Email"
                       class="w-full p-3 rounded-lg text-black">

            </div>

        </div>

        <div class="text-center text-gray-500 mt-10">
            © 2026 ShopNest. All rights reserved.
        </div>

    </footer>

</body>
</html>