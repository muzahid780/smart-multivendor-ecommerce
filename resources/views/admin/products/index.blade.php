<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Products- @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

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
    <!-- MAIN CONTENT -->
<div class="flex-1 flex flex-col">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold">Products</h2>
            <a href="{{ route('admin.products.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                + Add Product
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- TABLE WRAPPER -->
        <div class="bg-white shadow rounded-xl">
            <div class="overflow-x-auto overflow-y-auto max-h-[70vh]">
                <table class="w-full text-left">
                    <thead class="bg-gray-200 sticky top-0 z-10">
                        <tr>
                            <th class="p-4">ID</th>
                            <th class="p-4">Image</th>
                            <th class="p-4">Name</th>
                            <th class="p-4">Price</th>
                            <th class="p-4">Stock</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($products as $product)
                        @php
                            $images = $product->images ?? [];
                        @endphp
                        <tr class="border-b hover:bg-gray-50 transition">
                            <!-- ID -->
                            <td class="p-4">
                                {{ $product->id }}
                            </td>
                            
                            <td class="p-4">
                                @if(is_array($images) && count($images) > 0)
                                    <img src="{{ asset('storage/' . $images[0]) }}"
                                         class="w-16 h-16 object-cover rounded-lg border shadow">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 text-xs">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            
                            <td class="p-4 font-semibold text-gray-800">
                                {{ $product->name }}
                            </td>

                            <td class="p-4 font-medium text-gray-700">
                                ৳{{ number_format($product->price, 2) }}
                            </td>
                            
                            <td class="p-4">
                                @if($product->stock > 0)
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                        {{ $product->stock }} In Stock
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                        Out of Stock
                                    </span>
                                @endif
                            </td>
                            
                            <td class="p-4">
                                @if($product->status == 1)
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                        Active
                                    </span>
                                @else
                                    <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            
                            <td class="p-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this product?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-10 text-center text-gray-500">
                                No products found
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
</body>
</html>