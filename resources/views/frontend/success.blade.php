<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Success</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-lg rounded-lg p-10 text-center max-w-md w-full">

        <!-- SUCCESS ICON -->
        <div class="text-green-500 text-6xl mb-4">
            ✔
        </div>

        <!-- TITLE -->
        <h1 class="text-2xl font-bold text-gray-800 mb-2">
            Order Placed Successfully!
        </h1>

        <p class="text-gray-500 mb-6">
            Thank you for your order. We will contact you soon.
        </p>

        <!-- ORDER INFO (OPTIONAL) -->
        <div class="bg-gray-50 p-4 rounded mb-6 text-left">

            <p class="text-sm text-gray-600">
                Your order has been received and is now being processed.
            </p>

        </div>

        <!-- BUTTONS -->
        <div class="space-y-3">

            <a href="{{ route('home') }}"
               class="block bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Continue Shopping
            </a>

            <a href="{{ route('my.orders') }}"
               class="block bg-gray-800 text-white py-2 rounded hover:bg-gray-900">
                View My Orders
            </a>

        </div>

    </div>

</div>

</body>
</html>