@extends('vendor.layout')

@section('content')

<div class="flex items-center justify-between mb-8">

    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            My Products
        </h1>

        <p class="text-gray-500 mt-1">
            Manage your products
        </p>
    </div>

    <a href="{{ route('vendor.products.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-semibold transition">
        + Add Product
    </a>

</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-6">
        {{ session('success') }}
    </div>
@endif


<div class="bg-white rounded-2xl shadow-sm border overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-100">
                <tr class="text-gray-700">
                    <th class="text-left px-6 py-4 font-semibold">Image</th>
                    <th class="text-left px-6 py-4 font-semibold">Product</th>
                    <th class="text-left px-6 py-4 font-semibold">Price</th>
                    <th class="text-left px-6 py-4 font-semibold">Stock</th>
                    <th class="text-left px-6 py-4 font-semibold">Status</th>
                    <th class="text-center px-6 py-4 font-semibold">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($products as $product)

                <!-- CLEAN PROFESSIONAL HOVER (STABLE) -->
                <tr class="group bg-white border-t transition duration-200 ease-in-out
                           hover:bg-gray-50 hover:shadow-md">

                    <!-- IMAGE -->
                    <td class="px-6 py-4">
                        <div class="w-16 h-16 rounded-xl overflow-hidden border bg-white">
                            <img src="{{ $product->first_image ?? asset('images/no-image.png') }}"
                                 class="w-16 h-16 object-cover transition duration-200 group-hover:scale-105">
                        </div>
                    </td>

                    <!-- PRODUCT -->
                    <td class="px-6 py-4">
                        <h3 class="font-semibold text-gray-800 transition-colors duration-200
                                   group-hover:text-blue-600">
                            {{ $product->name }}
                        </h3>

                        <p class="text-sm text-gray-500">
                            {{ \Illuminate\Support\Str::limit($product->description, 45) }}
                        </p>
                    </td>

                    <!-- PRICE -->
                    <td class="px-6 py-4 font-bold text-blue-600 transition-colors duration-200
                               group-hover:text-indigo-600">
                        ৳{{ number_format($product->price, 2) }}
                    </td>

                    <!-- STOCK -->
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-sm font-medium
                            {{ $product->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $product->stock }}
                        </span>
                    </td>

                    <!-- STATUS -->
                    <td class="px-6 py-4">
                        @if($product->status)
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                                Active
                            </span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">
                                Inactive
                            </span>
                        @endif
                    </td>

                    <!-- ACTIONS -->
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">

                            <a href="{{ route('vendor.products.edit', $product->id) }}"
                               class="px-4 py-2 rounded-lg text-sm font-medium
                                      bg-yellow-400 hover:bg-yellow-500 text-white transition">
                                Edit
                            </a>

                            <form action="{{ route('vendor.products.destroy', $product->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this product?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="px-4 py-2 rounded-lg text-sm font-medium
                                               bg-red-500 hover:bg-red-600 text-white transition">
                                    Delete
                                </button>

                            </form>

                        </div>
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="text-center py-12 text-gray-500">
                        No products found
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection