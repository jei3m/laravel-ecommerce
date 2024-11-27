@props(['product'])

<a href="{{ route('products.show', $product->id) }}" class="block">
    <div class="bg-neutral-800 rounded-[24px] shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
        <div class="p-5">
            <div class="relative pb-[80%] rounded-[24px] overflow-hidden">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="absolute top-0 left-0 w-full h-full object-cover">
            </div>
            <div class="mt-4">
                <div class="flex justify-between items-center mb-1">
                    <h3 class="text-lg font-semibold text-white">{{ $product->name }}</h3>
                    <div class="flex items-center text-yellow-400">
                        <i class="fas fa-star mr-1"></i>
                        <span class="text-white">{{ number_format($product->rating, 1) }}</span>
                    </div>
                </div>
                <p class="text-md text-gray-300 mb-2">{{ $product->category }}</p>

                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold text-spink">${{ number_format($product->price, 2) }}</span>
                    <div class="flex items-center text-gray-400">
                        <i class="fas fa-shopping-cart mr-1"></i>
                        <span>{{ number_format($product->sold) }} sold</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>
