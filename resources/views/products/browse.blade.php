@extends('layouts.app')

@section('content')
<div class="container mx-auto p-2 lg:p-14 bg-neutral-800 rounded-[30px]">
    <div class="bg-neutral-900 rounded-[20px] p-7">
        <div class="flex justify-between items-center mb-6 bg-neutral-900 rounded">
            <h1 class="text-3xl font-bold text-white"><span class="underline decoration-white decoration-2">All</span> <span class="text-spink">Products</span></h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">No products found.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
