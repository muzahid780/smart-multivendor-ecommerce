<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Orders - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<!--<body class="bg-gray-100">
<div class="container max-auto px-6 py-10">-->

   <body class="bg-gray-100">
<div class="flex min-h-screen">
     <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col">
        <div class="p-6 border-b border-gray-700">
            <a href="{{ route('admin.dashboard') }}"
               class="text-2xl font-bold text-indigo-400">
                ShopNest Admin
            </a>
        </div>

        <a href="{{ route('home') }}"
   class="inline-block mb-4 text-indigo-600 hover:underline">
    ← Back to Home
</a>
        <!-- MENU -->
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
                📊 Dashboard
            </a>

            <a href="{{ route('admin.products.index') }}"
               class="block px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.products.*') ? 'bg-gray-800' : '' }}">
                📦 Products
            </a>

            <a href="{{ route('admin.orders.index') }}"
               class="block px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.orders.*') ? 'bg-gray-800' : '' }}">
                🛒 Orders
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="block px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-800' : '' }}">
                🗂 Categories
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="block px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.users.*') ? 'bg-gray-800' : '' }}">
                👥 Users
            </a>

        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg">
                    Logout
                </button>
            </form>
        </div>
    </nav>
    </aside>
<!--main content-->
<div class="flex-1 flex flex-col">
    <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
        All Orders
    </h1>

    <a href="{{ route('admin.dashboard') }}"
       class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">
        ← Back to Dashboard
    </a>
</div>

    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">Order ID</th>
                    <th class="p-3 text-left">Customer</th>
                    <th class="p-3 text-left">Phone</th>
                    <th class="p-3 text-left">Total</th>
                    <th class="p-3 text-left">Payment</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Date</th>
                    <th class="p-3 text-left">Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($orders as $order)

                    <tr class="border-b">

                        <td class="p-3">
                            #{{ $order->id }}
                        </td>

                        <td class="p-3">
                            {{ $order->user->name ?? 'Guest' }}
                        </td>

                        <td class="p-3">
                            {{ $order->phone }}
                        </td>

                        <td class="p-3 font-semibold">
                            {{ $order->total_price }} ৳
                        </td>

                        <td class="p-3">
                            {{ ucfirst($order->payment_status) }}
                        </td>

                        <td class="p-3">

                            @if($order->order_status == 'pending')
                                <span class="text-yellow-600 font-semibold">Pending</span>
                            @elseif($order->order_status == 'processing')
                                <span class="text-blue-600 font-semibold">Processing</span>
                            @else
                                <span class="text-green-600 font-semibold">Completed</span>
                            @endif

                        </td>

                        <td class="p-3">
                            {{ $order->created_at->format('d M Y') }}
                        </td>

                        <td class="p-3 flex gap-2">

                            <a href="{{ route('admin.orders.show', $order->id) }}"
                               class="bg-orange-500 text-white px-3 py-1 rounded text-sm">
                                View
                            </a>

                            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <select name="status"
                                        class="border p-1 rounded text-sm"
                                        onchange="this.form.submit()">

                                    <option disabled selected>Update</option>
                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="completed">Completed</option>

                                </select>
                            </form>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

</body>
</html>