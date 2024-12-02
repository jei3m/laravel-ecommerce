<x-app-layout>
    <x-header />

    <div class="container mx-auto p-2 lg:p-14 bg-neutral-800 rounded-[30px] mb-10">
        <div class="bg-neutral-900 rounded-[20px] p-7">
            <div class="flex flex-col space-y-6">
                <div class="flex justify-between items-center bg-neutral-900 rounded">
                    <h1 class="text-3xl font-bold text-white">
                        @if(isset($query))
                            Search Results for "<span class="text-spink">{{ $query }}</span>"
                        @elseif($selectedCategory)
                            <span class="text-spink underline decoration-white decoration-2">{{ $selectedCategory }}</span> <span class="text-white">Products</span>
                        @else
                            <span class="text-spink underline decoration-white decoration-2">All</span> <span class="text-white">Products</span>
                        @endif
                    </h1>
                </div>

                <!-- Filters -->
                <div class="flex flex-col md:flex-row gap-4 pb-6">
                    <div class="flex flex-col md:flex-row gap-4 w-full">
                        
                        <!-- Category Filter -->
                        <div class="relative w-full md:w-1/3">
                            <select id="categoryFilter" onchange="applyFilter('category', this.value)" class="w-full px-4 py-2.5 bg-neutral-800 text-white rounded-lg focus:outline-none appearance-none cursor-pointer">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ $selectedCategory == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                            @if($selectedCategory)
                                <button onclick="clearFilter('category')" class="absolute right-10 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white">
                                    <i class="fas fa-times"></i>
                                </button>
                            @endif
                        </div>

                        <!-- Sort Filter -->
                        <div class="relative w-full md:w-1/3">
                            <select id="sortFilter" onchange="applyFilter('sort', this.value)" class="w-full px-4 py-2.5 bg-neutral-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-spink appearance-none cursor-pointer">
                                <option value="price_low" {{ $selectedSort == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_high" {{ $selectedSort == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse($products as $product)
                        <x-product-card :product="$product" />
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-500 text-lg">No products found.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $products->links('pagination::custom') }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function applyFilter(type, value) {
            let url = new URL(window.location.href);
            
            // Preserve search query if it exists
            const searchQuery = url.searchParams.get('query');
            
            if (value) {
                url.searchParams.set(type, value);
            } else {
                url.searchParams.delete(type);
            }
            
            // Re-add search query if it existed
            if (searchQuery) {
                url.searchParams.set('query', searchQuery);
            }
            
            window.location.href = url.toString();
        }

        function clearFilter(type) {
            let url = new URL(window.location.href);
            url.searchParams.delete(type);
            
            // Preserve search query if it exists
            const searchQuery = url.searchParams.get('query');
            
            // Preserve sort parameter when clearing other filters
            if (type !== 'sort') {
                let sort = document.getElementById('sortFilter').value;
                if (sort) {
                    url.searchParams.set('sort', sort);
                }
            }
            
            // Re-add search query if it existed
            if (searchQuery) {
                url.searchParams.set('query', searchQuery);
            }
            
            window.location.href = url.toString();
        }
    </script>
    @endpush
</x-app-layout>
