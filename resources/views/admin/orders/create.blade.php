<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Order</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-sky-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white p-5">
        <h1 class="text-2xl font-bold mb-6">ShopNest Admin</h1>

        <nav class="space-y-2">
            <a href="/admin/dashboard" class="block p-2 rounded hover:bg-gray-800">Dashboard</a>
            <a href="/admin/products" class="block p-2 rounded hover:bg-gray-800">Products</a>
            <a href="/admin/orders" class="block p-2 rounded bg-gray-800">Orders</a>
        </nav>
    </aside>

    <main class="flex-1 p-8">

        <h2 class="text-3xl font-bold mb-6">Create Order</h2>

        <div class="bg-white p-6 rounded shadow max-w-2xl">

            <form action="{{ route('orders.store') }}" method="POST">

                @csrf

                <input type="text"
                       name="customer_name"
                       placeholder="Customer Name"
                       class="w-full border p-2 mb-3 rounded">

                <input type="email"
                       name="customer_email"
                       placeholder="Customer Email"
                       class="w-full border p-2 mb-3 rounded">

                <select name="product_id"
                        class="w-full border p-2 mb-3 rounded">

                    <option value="">Select Product</option>

                    @foreach($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }} - ${{ $product->price }}
                        </option>
                    @endforeach

                </select>

                <input type="number"
                       name="quantity"
                       value="1"
                       class="w-full border p-2 mb-3 rounded">

                <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                    Create Order
                </button>

            </form>

        </div>

    </main>

</div>

</body>
</html>