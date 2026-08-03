@extends('frontend.master')

@section('content')

<div class="min-h-[calc(100vh-64px)] flex">

    <!-- LEFT SIDE -->
    <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-indigo-600 to-blue-500 items-center justify-center p-10">

        <div class="text-white max-w-md">

            <h1 class="text-4xl font-bold mb-6">
                ShopNest E-Commerce
            </h1>

            <p class="text-lg mb-6">
                Discover quality products with secure shopping and fast delivery.
            </p>

            <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30"
                 alt="ShopNest"
                 class="rounded-2xl shadow-2xl h-[350px] w-full object-cover">

        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-10">

        <div class="bg-white w-full max-w-md p-10 rounded-2xl shadow-2xl">

            <h2 class="text-3xl font-bold text-center text-indigo-600 mb-2">
                Login
            </h2>

            <p class="text-center text-gray-500 mb-8">
                Welcome back! Please login to your account.
            </p>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 p-3 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-5">
                    <label class="block mb-2 font-medium">Email</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                        required
                    >
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label class="block mb-2 font-medium">Password</label>

                    <input
                        type="password"
                        name="password"
                        class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                        required
                    >
                </div>

                <!-- Remember -->
                <div class="flex justify-between items-center mb-6">

                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-indigo-600 hover:underline text-sm">
                            Forgot Password?
                        </a>
                    @endif

                </div>

                <!-- Login Button -->
                <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg transition">
                    Login
                </button>

            </form>

            <p class="text-center text-sm mt-6 text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}"
                   class="text-indigo-600 font-semibold hover:underline">
                    Create Account
                </a>
            </p>

        </div>

    </div>

</div>

@endsection