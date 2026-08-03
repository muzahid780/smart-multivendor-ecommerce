@extends('frontend.master')

@section('content')

<div class="bg-gray-100 py-16">

    <div class="max-w-6xl mx-auto px-6">

        <!-- HEADING -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800">
                Contact Us
            </h1>
            <p class="text-gray-500 mt-2">
                We are here to help you anytime
            </p>
        </div>

        <!-- CARDS -->
        <div class="grid grid-cols-3 gap-6">

            <div class="bg-green-300 rounded-2xl p-8 text-center shadow-sm hover:shadow-xl transition">
                <div class="text-4xl mb-4">📞</div>
                <h3 class="font-semibold text-gray-800">Phone</h3>
                <p class="text-gray-500 mt-2">+880 1942429531</p>
                <p class="text-gray-500 mt-2">SAT - THU: 9:00 AM - 8:00 PM</p>
            </div>

            <div class="bg-green-300 rounded-2xl p-8 text-center shadow-sm hover:shadow-xl transition">
                <div class="text-4xl mb-4">📧</div>
                <h3 class="font-semibold text-gray-800">Email</h3>
                <p class="text-gray-500 mt-2">support@shopnest.com</p>
                <p class="text-gray-500 mt-2">We'll respond within 24 hours</p>
            </div>

            <div class="bg-green-300 rounded-2xl p-8 text-center shadow-sm hover:shadow-xl transition">
                <div class="text-4xl mb-4">📍</div>
                <h3 class="font-semibold text-gray-800">Address</h3>
                <p class="text-gray-500 mt-2">Khulna-9000, Bangladesh</p>
            </div>

        </div>

    </div>

</div>

@endsection