<x-app-layout>
    <x-header />
    
    <div class="container mx-auto p-2 lg:p-14 bg-neutral-800 rounded-[30px] mb-10">
        <x-hero />
        
        <div class="bg-neutral-900 rounded-[20px] p-7">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-spink"><span class="underline decoration-white decoration-2">Most Popular</span> <span class="text-white">Right Now</span></h1>
            </div>

            @if(session('success'))
                @push('scripts')
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: "{{ session('success') }}",
                        position: 'center',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        background: '#171717',
                        color: '#fff',
                        customClass: {
                            popup: 'rounded-[20px] border border-neutral-700',
                        }
                    });
                </script>
                @endpush
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <x-product-card :product="$product" />
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">No products found.</p>
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
</x-app-layout>
