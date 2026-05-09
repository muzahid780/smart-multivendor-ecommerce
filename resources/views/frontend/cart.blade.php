<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="container mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-8">
        Shopping Cart
    </h1>

    @php
        $total = 0;
    @endphp

    <div class="bg-white rounded-2xl shadow p-6">

        @if(session('cart'))

            @foreach(session('cart') as $id => $item)

                @php
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                @endphp

                <div class="flex items-center justify-between border-b py-5">

                    <!-- PRODUCT -->
                    <div class="flex items-center gap-4">

                        <img src="{{ asset('storage/'.$item['image']) }}"
                             class="w-24 h-24 object-cover rounded-lg">

                        <div>

                            <h2 class="font-bold text-lg">
                                {{ $item['name'] }}
                            </h2>

                            <p class="text-indigo-600 font-semibold">
                                ${{ $item['price'] }}
                            </p>

                        </div>

                    </div>

                    <!-- QUANTITY -->
                    <div>

                        <form action="{{ route('cart.update', $id) }}"
                              method="POST"
                              class="flex items-center gap-2">

                            @csrf

                            <input type="number"
                                   name="quantity"
                                   value="{{ $item['quantity'] }}"
                                   min="1"
                                   class="w-20 border rounded px-2 py-1">

                            <button class="bg-indigo-600 text-white px-3 py-1 rounded">
                                Update
                            </button>

                        </form>

                    </div>

                    <!-- SUBTOTAL -->
                    <div class="font-bold text-lg">

                        ${{ $subtotal }}

                    </div>

                    <!-- REMOVE -->
                    <div>

                        <form action="{{ route('cart.remove', $id) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button class="bg-red-500 text-white px-4 py-2 rounded">

                                Remove

                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

            <!-- TOTAL -->
            <div class="mt-8 flex justify-between items-center">

                <h2 class="text-2xl font-bold">
                    Total:
                </h2>

                <h2 class="text-3xl font-bold text-green-600">
                    ${{ $total }}
                </h2>

            </div>

        @else

            <div class="text-center py-10">

                <h2 class="text-2xl text-gray-500">
                    Your cart is empty
                </h2>

            </div>

        @endif

    </div>

</div>

</body>
</html>