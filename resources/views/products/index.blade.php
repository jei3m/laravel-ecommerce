@extends('layouts.app')

@section('content')
<div class="container mx-auto p-2 lg:p-14 bg-neutral-800 rounded-[30px]">
    <x-hero />
    
    <div class="bg-neutral-900 rounded-[20px] p-7">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-white"><span class="underline decoration-white decoration-2">Most Popular</span> <span class="text-spink">Right Now</span></h1>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">No products found.</p>
                    <a href="{{ route('products.create') }}" class="inline-block mt-4 text-blue-500 hover:text-blue-600">
                        Add your first product
                    </a>
                </div>
            @endforelse
        </div>
    </div>

        <div class="flex justify-center mt-[-1rem]">
            <a href="{{ route('products.browse') }}" class="inline-block py-3 px-6 bg-spink transition-colors font-semibold text-white rounded-full">
                Discover All Products
            </a>
        </div>

</div>
@endsection
