<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white p-5">
        <h1 class="text-2xl font-bold mb-6">Admin Panel</h1>

        <nav class="space-y-2">
            <a href="/admin/dashboard" class="block p-2 rounded hover:bg-gray-800">Dashboard</a>
            <a href="/admin/products" class="block p-2 rounded hover:bg-gray-800">Products</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">

        <h2 class="text-3xl font-bold mb-6">Create Product</h2>

        <div class="bg-white p-6 rounded-xl shadow max-w-2xl">

            <form action="/admin/products" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Product Name</label>
                    <input type="text" name="name" class="w-full border p-2 rounded" required>
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Price</label>
                    <input type="number" name="price" class="w-full border p-2 rounded" required>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Description</label>
                    <textarea name="description" class="w-full border p-2 rounded"></textarea>
                </div>

                <!-- Image -->
                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Image</label>
                    <input type="file" name="image" class="w-full border p-2 rounded">
                </div>

                <!-- Submit -->
                <button class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                    Save Product
                </button>

            </form>

        </div>

    </main>

</div>

</body>
</html>
