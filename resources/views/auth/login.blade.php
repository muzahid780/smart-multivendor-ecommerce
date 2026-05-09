<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SmartShop</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex">

    <!-- LEFT SIDE -->
    <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-indigo-600 to-blue-500 items-center justify-center p-10">

        <div class="text-white max-w-md">

            <h1 class="text-5xl font-bold mb-6">
                SmartShop Ecommerce
            </h1>

            <p class="text-lg mb-6">
                Professional multi-vendor platform like Daraz & Amazon
            </p>

            <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30"
                 class="rounded-2xl shadow-2xl h-[350px] w-full object-cover">

        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-6">

        <div class="bg-white w-full max-w-md p-10 rounded-2xl shadow-2xl">

            <h2 class="text-3xl font-bold text-center text-indigo-600 mb-2">
                Login
            </h2>

            <p class="text-center text-gray-500 mb-8">
                Welcome back! Please login
            </p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-5">
                    <label class="block mb-1">Email</label>
                    <input type="email" name="email"
                           class="w-full border rounded-lg p-3 focus:ring focus:ring-indigo-300"
                           required>
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label class="block mb-1">Password</label>
                    <input type="password" name="password"
                           class="w-full border rounded-lg p-3 focus:ring focus:ring-indigo-300"
                           required>
                </div>

                <!-- Remember -->
                <div class="flex justify-between items-center mb-6">

                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        Remember me
                    </label>

                    <a href="#" class="text-indigo-600 text-sm">
                        Forgot?
                    </a>

                </div>

                <!-- Button -->
                <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg">
                    Login
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>