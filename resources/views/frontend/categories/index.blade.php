<section class="py-14 bg-gray-50">

    <div class="max-w-7xl mx-auto px-6">

        <!-- HEADER -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800">
                Shop By Categories
            </h1>
            <p class="text-gray-500 mt-2">
                Explore all product categories and find your favorite items
            </p>
        </div>

        <!-- CATEGORY GRID -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">

            @forelse($categories as $category)

                <a href="{{ route('categories.show', $category->slug) }}"
                   class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-5 text-center group">

                    <!-- IMAGE -->
                    <div class="w-20 h-20 mx-auto mb-4 overflow-hidden rounded-full border">
                        @if($category->image)
                            <img src="{{ asset('storage/'.$category->image) }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-3xl">
                                📦
                            </div>
                        @endif
                    </div>

                    <!-- NAME -->
                    <h3 class="font-semibold text-gray-800 group-hover:text-indigo-600">
                        {{ $category->name }}
                    </h3>

                    <!-- SMALL TEXT -->
                    <p class="text-xs text-gray-400 mt-1">
                        Browse products
                    </p>

                </a>

            @empty

                <div class="col-span-full text-center text-gray-500">
                    No categories found 
                </div>

            @endforelse

        </div>

    </div>

</section>