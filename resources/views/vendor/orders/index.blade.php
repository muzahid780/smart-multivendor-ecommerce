@extends('vendor.layout')

@section('content')

<!-- PAGE HEADER -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            Orders
        </h1>

        <p class="text-gray-500 mt-1">
            Manage your customer orders
        </p>

    </div>

</div>

<!-- ORDER TABLE -->
<div class="bg-white rounded-2xl shadow-sm border overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="text-left px-6 py-4 text-gray-600 font-semibold">
                        Order ID
                    </th>

                    <th class="text-left px-6 py-4 text-gray-600 font-semibold">
                        Customer
                    </th>

                    <th class="text-left px-6 py-4 text-gray-600 font-semibold">
                        Total
                    </th>

                    <th class="text-left px-6 py-4 text-gray-600 font-semibold">
                        Status
                    </th>

                    <th class="text-left px-6 py-4 text-gray-600 font-semibold">
                        Date
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($orders as $order)

                    <tr class="border-t hover:bg-gray-50 transition">

                        <!-- ORDER ID -->
                        <td class="px-6 py-4 font-semibold text-gray-800">

                            #{{ $order->id }}

                        </td>

                        <!-- CUSTOMER -->
                        <td class="px-6 py-4">

                            <div>

                                <h2 class="font-semibold text-gray-800">

                                    {{ $order->name ?? 'Customer' }}

                                </h2>

                                <p class="text-sm text-gray-500">

                                    {{ $order->email ?? 'No Email' }}

                                </p>

                            </div>

                        </td>

                        <!-- TOTAL -->
                        <td class="px-6 py-4 font-bold text-blue-600">

                            ৳ {{ number_format($order->total, 2) }}

                        </td>

                        <!-- STATUS -->
                        <td class="px-6 py-4">

                            @if($order->status == 'pending')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">

                                    Pending

                                </span>

                            @elseif($order->status == 'completed')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">

                                    Completed

                                </span>

                            @elseif($order->status == 'cancelled')

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">

                                    Cancelled

                                </span>

                            @else

                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">

                                    {{ ucfirst($order->status) }}

                                </span>

                            @endif

                        </td>

                        <!-- DATE -->
                        <td class="px-6 py-4 text-gray-500">

                            {{ $order->created_at->format('d M Y') }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="text-center py-16 text-gray-500">

                            No Orders Found

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection