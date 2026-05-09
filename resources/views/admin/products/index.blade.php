<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-sky-200">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white p-5">
        <h1 class="text-2xl font-bold mb-6">Admin Panel</h1>

        <nav class="space-y-2">
            <a href="/admin/dashboard" class="block p-2 rounded hover:bg-gray-800">Dashboard</a>
            <a href="/admin/products" class="block p-2 rounded bg-gray-800">Products</a>
            <a href="#" class="block p-2 rounded hover:bg-gray-800">Users</a>
            <a href="#" class="block p-2 rounded hover:bg-gray-800">Orders</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold">Products</h2>

            <a href="/admin/products/create"
               class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                + Add Product
            </a>
        </div>

        <!-- Product Table -->
        <div class="bg-white shadow rounded-xl overflow-hidden">
            <table class="w-full text-left">

                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3">ID</th>
                        <th class="p-3">Name</th>
                        <th class="p-3">Price</th>
                        <th class="p-3">Image</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>

                <tbody>
@forelse($products as $product)
<tr class="border-b">

    <td class="p-3">{{ $product->id }}</td>

    <td class="p-3">{{ $product->name }}</td>

    <td class="p-3">${{ $product->price }}</td>

    <td class="p-3">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}"
                 class="w-12 h-12 rounded object-cover">
        @else
            <span>No Image</span>
        @endif
    </td>

    <td class="p-3 space-x-2">

   <a href="{{ route('products.edit', $product->id) }}"
   class="bg-yellow-500 text-white px-3 py-1 rounded">
    Edit
</a>

    <form action="{{ route('products.destroy', $product->id) }}"
          method="POST"
          style="display:inline;"
          onsubmit="return confirm('Are you sure?')">

        @csrf
        @method('DELETE')

        <button class="bg-red-500 text-white px-3 py-1 rounded">
            Delete
        </button>

    </form>

</td>

</tr>
@empty
<tr>
    <td colspan="5" class="p-5 text-center text-gray-500">
        No products found
    </td>
</tr>
@endforelse
</tbody>

            </table>
        </div>

    </main>

</div>

</body>
</html>
