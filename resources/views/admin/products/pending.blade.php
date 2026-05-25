@extends('layouts.admin')

@section('title', 'Pending Products')

@section('page-title', 'Pending Product Approval')

@section('content')

<div class="bg-white p-6 rounded-xl shadow">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Pending Products</h2>

        <span class="text-sm text-gray-500">
            Total: {{ $products->count() }}
        </span>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- EMPTY STATE --}}
    @if($products->isEmpty())
        <div class="text-center py-10 text-gray-500">
            No pending products found
        </div>
    @else

    <div class="overflow-x-auto">

        <table class="w-full border border-gray-200 rounded-lg">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 border text-left">ID</th>
                    <th class="p-3 border text-left">Product</th>
                    <th class="p-3 border text-left">Vendor</th>
                    <th class="p-3 border text-left">Price</th>
                    <th class="p-3 border text-left">Status</th>
                    <th class="p-3 border text-left">Action</th>
                </tr>
            </thead>

            <tbody>

            @foreach($products as $product)

                <tr class="hover:bg-gray-50">

                    <td class="p-3 border">{{ $product->id }}</td>

                    <td class="p-3 border font-medium">
                        {{ $product->name }}
                    </td>

                    <td class="p-3 border">
                        {{ $product->vendor->name ?? 'Unknown Vendor' }}
                    </td>

                    <td class="p-3 border">
                        ${{ number_format($product->price, 2) }}
                    </td>

                    <td class="p-3 border">
                        <span class="px-2 py-1 rounded text-xs font-semibold
                            @if($product->approval_status == 'pending')
                                bg-yellow-200 text-yellow-800
                            @elseif($product->approval_status == 'approved')
                                bg-green-200 text-green-800
                            @else
                                bg-red-200 text-red-800
                            @endif
                        ">
                            {{ ucfirst($product->approval_status ?? 'pending') }}
                        </span>
                    </td>

                    <td class="p-3 border">

                        <div class="flex gap-2">

                            {{-- APPROVE --}}
                            <form method="POST"
                                  action="{{ route('admin.products.approve', $product->id) }}">
                                @csrf
                                @method('PATCH')

                                <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                                    Approve
                                </button>
                            </form>

                            {{-- REJECT --}}
                            <form method="POST"
                                  action="{{ route('admin.products.reject', $product->id) }}">
                                @csrf
                                @method('PATCH')

                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                    Reject
                                </button>
                            </form>

                        </div>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

    @endif

</div>

@endsection