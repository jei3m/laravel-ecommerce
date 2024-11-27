@extends('layouts.app')

@section('content')
<div class="container mx-auto pt-10 p-2 lg:p-0">
    <div class="bg-neutral-800 rounded-[30px] p-8">
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Product Image Section -->
                <div>
                    <div class="relative rounded-[24px] overflow-hidden aspect-square mb-4">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="absolute inset-0 w-full h-full object-cover">
                    </div>
                    <div class="relative">
                        <p class="mt-2 text-sm text-gray-400 mb-2">Replace the current image (optional)</p>
                        <input type="file" name="image" id="image" class="w-full bg-neutral-900 border border-neutral-700 text-white rounded-xl p-3 focus:outline-none">
                    </div>
                </div>

                <!-- Product Details Section -->
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1 w-full">
                                <label for="name" class="block text-sm font-medium text-gray-400 mb-1">Product Name</label>
                                <input type="text" id="name" name="name" value="{{ $product->name }}" 
                                    class="w-full bg-neutral-900 border border-neutral-700 text-white rounded-xl p-3 focus:outline-none focus:border-spink">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="category" class="block text-sm font-medium text-gray-400 mb-1">Category</label>
                            <input type="text" id="category" name="category" value="{{ $product->category }}"
                                class="w-full bg-neutral-900 border border-neutral-700 text-white rounded-xl p-3 focus:outline-none focus:border-spink">
                        </div>

                        <div class="mb-6">
                            <label for="price" class="block text-sm font-medium text-gray-400 mb-1">Price</label>
                            <div class="relative">
                                <span class="absolute left-3 top-3 text-gray-400">$</span>
                                <input type="number" id="price" name="price" value="{{ $product->price }}" step="10"
                                    class="w-full bg-neutral-900 border border-neutral-700 text-white rounded-xl p-3 pl-7 focus:outline-none focus:border-spink">
                            </div>
                        </div>

                        <div class="bg-neutral-700 rounded-[20px] p-6 mb-6">
                            <label for="description" class="block text-xl font-semibold text-white mb-4">Product Description</label>
                            <textarea id="description" name="description" rows="4"
                                class="w-full bg-neutral-800 border border-neutral-600 text-white rounded-xl p-4 focus:outline-none focus:border-spink">{{ $product->description }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-neutral-700 rounded-[20px] p-4">
                                <div class="text-gray-400 mb-1">Total Sold</div>
                                <div class="text-white font-semibold text-lg">
                                    {{ number_format($product->sold) }}
                                </div>
                            </div>
                            <div class="bg-neutral-700 rounded-[20px] p-4">
                                <label for="stock" class="block text-gray-400 mb-1">Stock</label>
                                <input type="number" id="stock" name="stock" value="{{ $product->stock }}" step="1"
                                    class="w-full bg-neutral-800 border border-neutral-600 text-white rounded-xl p-2 focus:outline-none focus:border-spink">
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <a href="{{ route('products.dashboard') }}" class="flex-none bg-neutral-700 text-white font-bold py-4 px-6 rounded-full">
                            Cancel
                        </a>
                        <button type="submit" class="flex-1 bg-spink text-white font-bold py-4 px-6 rounded-full">
                            <i class="fas fa-save mr-2"></i> Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
