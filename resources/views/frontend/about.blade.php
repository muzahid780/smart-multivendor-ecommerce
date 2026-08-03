@extends('frontend.master')

@section('content')

<div class="bg-gray-50 py-16">

    <div class="max-w-7xl mx-auto px-6">

        <!-- PAGE HEADER -->
        <div class="text-center mb-12">

            <h1 class="text-5xl font-bold text-gray-800">
                About ShopNest
            </h1>

        </div>

        <!-- ABOUT SECTION -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- LEFT IMAGE -->
<div>
    <img src="{{ asset('images/about.jpg') }}"
         alt="E-commerce Shopping"
         class="rounded-3xl shadow-xl w-full max-h-[450px] object-cover object-center">
</div>

            <!-- RIGHT CONTENT -->
            <div>

                <h2 class="text-2xl font-bold text-gray-600 mb-4">
                    Welcome to ShopNest
                </h2>

                <p class="text-gray-600 leading-relaxed mb-5">
                    ShopNest is a modern e-Commerce platform
                    designed to connect buyers and sellers through a secure,
                    convenient and user-friendly online marketplace.
                </p>

                <p class="text-gray-600 leading-relaxed mb-5">
                    Our mission is to make online shopping simple, reliable,
                    and enjoyable by providing access to quality products and a seamless checkout experience.
                </p>

                <div class="grid grid-cols-3 gap-6">

    <div class="text-center p-4 bg-orange-400 rounded-2xl shadow-sm
                transition-all duration-300 ease-in-out
                hover:shadow-xl hover:-translate-y-2 hover:scale-105 cursor-pointer">
        <h3 class="text-2xl font-bold text-white">
            100+
        </h3>
        <p class="text-white text-sm">
            Products
        </p>
    </div>

    <div class="text-center p-4 bg-orange-400 rounded-2xl shadow-sm
                transition-all duration-300 ease-in-out
                hover:shadow-xl hover:-translate-y-2 hover:scale-105 cursor-pointer">
        <h3 class="text-2xl font-bold text-white">
             🎧 24/7
        </h3>
        <p class="text-white text-sm">
          Support
        </p>
    </div>

    <div class="text-center p-4 bg-orange-400 rounded-2xl shadow-sm
                transition-all duration-300 ease-in-out
                hover:shadow-xl hover:-translate-y-2 hover:scale-105 cursor-pointer">
        <h3 class="text-2xl font-bold text-white">
            100%
        </h3>
        <p class="text-white text-sm">
            Secure
        </p>
    </div>

</div>

            </div>

        </div>

    </div>

</div>

@endsection