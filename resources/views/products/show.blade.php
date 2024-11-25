@extends('layouts.app')

@section('content')
<div class="container mx-auto pt-10 p-2 lg:p-0">
    <div class="bg-neutral-800 rounded-[30px] p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Product Image Section -->
            <div class="relative rounded-[24px] overflow-hidden aspect-square">
                <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="absolute inset-0 w-full h-full object-cover">
            </div>

            <!-- Product Details Section -->
            <div class="flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <h1 class="text-4xl font-bold text-white">{{ $product['name'] }}</h1>
                        <div class="flex items-center bg-neutral-700 px-4 py-2 rounded-full">
                            <i class="fas fa-star text-yellow-400 mr-2"></i>
                            <span class="text-white font-semibold">{{ number_format($product['rating'], 1) }}</span>
                        </div>
                    </div>

                    <div class="mb-6 flex justify-between">
                        <span class="inline-block bg-spink text-white px-4 py-2 rounded-full text-md font-semibold">
                            {{ $product['category'] }}
                        </span>
                        <span class="inline-block bg-neutral text-white px-4 py-2 rounded-full text-md font-semibold justify-end">
                            <i class="fas fa-user text-xs lg:text-sm"></i> Seller: John Doe
                        </span>
                    </div>

                    

                    <div class="text-2xl font-bold text-spink mb-6">
                        ${{ number_format($product['price'], 2) }}
                    </div>

                    <div class="bg-neutral-700 rounded-[20px] p-6 mb-6">
                        <h2 class="text-xl font-semibold text-white mb-4">Product Description</h2>
                        <p class="text-gray-300">{{ $product['description'] }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-neutral-700 rounded-[20px] p-4">
                            <div class="text-gray-400 mb-1">Total Sold</div>
                            <div class="text-white font-semibold text-lg">
                                {{ number_format($product['sold']) }}
                            </div>
                        </div>
                        <div class="bg-neutral-700 rounded-[20px] p-4">
                            <div class="text-gray-400 mb-1">Stock</div>
                            <div class="text-white font-semibold text-lg">
                                {{ $product['stock'] ?? 'Out of stock' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <button class="flex-1 bg-spink text-white font-bold py-4 px-6 rounded-full">
                        <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
