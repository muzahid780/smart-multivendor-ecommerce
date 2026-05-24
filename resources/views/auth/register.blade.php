<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register -ShopNest</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex">

    <!-- LEFT SIDE -->
    <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-green-600 to-emerald-500 items-center justify-center p-10">

        <div class="text-white max-w-md">

            <h1 class="text-5xl font-bold mb-6">
                Join ShopNest
            </h1>

            <p class="text-lg mb-6">
                Create your account and start shopping or selling products instantly.
            </p>

            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f"
                 class="rounded-2xl shadow-2xl h-[350px] w-full object-cover">

        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-6">

        <div class="bg-white w-full max-w-md p-10 rounded-2xl shadow-2xl">

            <h2 class="text-3xl font-bold text-center text-green-600 mb-2">
                Register
            </h2>

            <p class="text-center text-gray-500 mb-8">
                Create your account
            </p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label class="block mb-1">Name</label>
                    <input type="text" name="name"
                           class="w-full border rounded-lg p-3 focus:ring focus:ring-green-300"
                           required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block mb-1">Email</label>
                    <input type="email" name="email"
                           class="w-full border rounded-lg p-3 focus:ring focus:ring-green-300"
                           required>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label class="block mb-1">Password</label>
                    <input type="password" name="password"
                           class="w-full border rounded-lg p-3 focus:ring focus:ring-green-300"
                           required>
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label class="block mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full border rounded-lg p-3 focus:ring focus:ring-green-300"
                           required>
                </div>

                <!-- Button -->
                <button class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg">
                    Register
                </button>

            </form>

            <p class="text-center text-sm mt-6 text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-green-600 font-semibold">
                    Login
                </a>
            </p>

        </div>

    </div>

</div>

</body>
</html>