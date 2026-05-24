<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-900 text-white p-5">

        <h1 class="text-2xl font-bold mb-6">
            Admin Panel
        </h1>

        <nav class="space-y-2">

            <a href="/admin/dashboard"
               class="block p-3 rounded hover:bg-gray-800">
                Dashboard
            </a>

            <a href="/admin/categories"
               class="block p-3 rounded bg-gray-800">
                Categories
            </a>

            <a href="/admin/products"
               class="block p-3 rounded hover:bg-gray-800">
                Products
            </a>

        </nav>

    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-10">

        <div class="mb-8">

            <h2 class="text-4xl font-bold text-gray-800">
                Create Category
            </h2>

            <p class="text-gray-500 mt-2">
                Add a new product category
            </p>

        </div>

        @if(session('success'))

            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>

        @endif

        @if($errors->any())

            <div class="bg-red-100 text-red-700 px-4 py-3 rounded-xl mb-6">

                <ul class="list-disc pl-5">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <div class="bg-white rounded-2xl shadow-lg p-8 max-w-3xl">

            <form action="{{ route('categories.store') }}"
                  method="POST">

                @csrf

                <div class="mb-6">

                    <label class="block mb-2 font-semibold text-gray-700">
                        Category Name
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Enter category name"
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           required>

                </div>

                <!-- STATUS -->
                <div class="mb-8">

                    <label class="block mb-2 font-semibold text-gray-700">
                        Status
                    </label>

                    <select name="status"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3">

                        <option value="1">
                            Active
                        </option>

                        <option value="0">
                            Inactive
                        </option>

                    </select>

                </div>

                <!-- BUTTON -->
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-semibold transition">

                    Save Category

                </button>

            </form>

        </div>

    </main>

</div>

</body>
</html>