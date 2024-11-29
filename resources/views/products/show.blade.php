@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col">
    <x-header/>
    <div class="flex-1 flex items-center justify-center mt-0 md:mt-[-6rem]">
        <div class="container max-w-6xl mx-auto">
            <div class="flex justify-end mb-4">
                <a href="{{ url()->previous() }}" class="bg-red-500 text-white p-3 px-5 rounded-full transition-all">
                    <i class="fas fa-times text-xl"></i>
                </a>
            </div>
            @if(session('success'))
                @push('scripts')
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: "{{ session('success') }}",
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        background: '#171717',
                        color: '#fff',
                        customClass: {
                            popup: 'rounded-[15px] border border-neutral-700',
                            title: 'text-spink font-bold',
                            timerProgressBar: 'bg-spink',
                        }
                    });
                </script>
                @endpush
            @endif

            <div class="bg-neutral-800 rounded-[30px] p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Product Image Section -->
                    <div class="relative rounded-[24px] overflow-hidden aspect-square">
                        @if(str_starts_with($product->image, 'http'))
                            <img src="{{ $product->getImageUrl() }}" alt="{{ $product->name }}" class="absolute inset-0 w-full h-full object-cover">
                        @else
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="absolute inset-0 w-full h-full object-cover">
                        @endif
                    </div>

                    <!-- Product Details Section -->
                    <div class="flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-4">
                                <h1 class="text-4xl font-bold text-white">{{ $product->name }}</h1>
                                <div class="flex items-center bg-neutral-700 px-4 py-2 rounded-full">
                                    <i class="fas fa-star text-yellow-400 mr-2"></i>
                                    <span class="text-white mr-1">{{ number_format($product->average_rating, 1) }}</span>
                                </div>
                            </div>

                            <div class="mb-6 flex justify-between">
                                <span class="inline-flex items-center bg-opacity-20 bg-spink px-3 py-1 rounded-lg">
                                   <p class="text-sm font-medium text-spink"> {{ $product->category }} </p>
                                </span>
                            </div>

                            
                            <div class="flex items-center justify-between mb-4">
                                <div class="text-2xl text-white font-bold">
                                    ${{ number_format($product->price, 2) }}
                                </div>
                            </div>

                            <div class="bg-neutral-700 rounded-[20px] p-6 mb-6">
                                <h2 class="text-xl font-semibold text-white mb-4">Product Description</h2>
                                <p class="text-gray-300">{{ $product->description }}</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="bg-neutral-700 rounded-[20px] p-4">
                                    <div class="text-gray-400 mb-1">Total Sold</div>
                                    <div class="text-white font-semibold text-lg">
                                        {{ number_format($product->sold) }}
                                    </div>
                                </div>
                                <div class="bg-neutral-700 rounded-[20px] p-4">
                                    <div class="text-gray-400 mb-1">Stock</div>
                                    <div class="text-white font-semibold text-lg">
                                        {{ $product->stock ?? 'Out of stock' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-4">
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="w-full" id="addToCartForm" onsubmit="return false;">
                                @csrf
                                <div class="flex gap-4 mb-4">
                                    <div class="flex items-center bg-neutral-700 rounded-2xl px-4">
                                        <button type="button" onclick="decrementQuantity()" class="text-white py-2">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}"
                                            class="w-16 text-center bg-transparent text-white focus:ring-0 border-none"
                                            onchange="validateQuantity(this)"
                                            onkeypress="return event.keyCode != 13;">
                                        <button type="button" onclick="incrementQuantity()" class="text-white py-2">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="button" onclick="addToCart()" class="w-full bg-spink text-white font-bold py-4 px-6 rounded-full hover:bg-opacity-90 transition-colors">
                                    <i class="fas fa-shopping-cart mr-2"></i>Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('success') }}",
        position: 'center',
        showConfirmButton: true,
        confirmButtonColor: '#Ff91a4',
        background: '#171717',
        color: '#fff',
        customClass: {
            popup: 'rounded-[15px] border border-neutral-700',
            title: 'text-spink font-bold',
            timerProgressBar: 'bg-spink',
        }
    });
</script>
@endif

<script>
    function confirmDelete() {
        Swal.fire({
            title: 'Delete Product',
            text: "This action cannot be undone",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Delete',
            reverseButtons: true,
            background: '#171717', 
            color: '#fff',
            customClass: {
                popup: 'rounded-[20px] border border-neutral-700',
                title: 'text-spink font-bold',
                htmlContainer: 'text-gray-300',
                icon: 'border-spink',
                confirmButton: 'bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-full font-semibold transition-colors',
                cancelButton: 'bg-neutral-700 hover:bg-neutral-600 text-white px-6 py-2 rounded-full font-semibold transition-colors',
                actions: 'space-x-3',
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm').submit();
            }
        });
    }
</script>

<script>
    // Prevent form submission on Enter key
    document.getElementById('addToCartForm').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            return false;
        }
    });

    function validateQuantity(input) {
        const max = {{ $product->stock }};
        if (input.value > max) {
            input.value = max;
        }
        if (input.value < 1) {
            input.value = 1;
        }
    }

    function incrementQuantity() {
        const input = document.getElementById('quantity');
        const currentValue = parseInt(input.value);
        const max = {{ $product->stock }};
        if (currentValue < max) {
            input.value = currentValue + 1;
        }
    }

    function decrementQuantity() {
        const input = document.getElementById('quantity');
        const currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
        }
    }

    function addToCart() {
        const form = document.getElementById('addToCartForm');
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            Swal.fire({
                icon: 'success',
                title: 'Added to Cart!',
                text: `${formData.get('quantity')}x {{ $product->name }} has been added to your cart`,
                position: 'center',
                showConfirmButton: true,
                timerProgressBar: true,
                confirmButtonColor: '#Ff91a4',
                background: '#171717',
                color: '#fff',
                customClass: {
                    popup: 'rounded-[15px] border border-neutral-700',
                    title: 'text-spink font-bold',
                    timerProgressBar: 'bg-spink',
                }
            });
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong! Please try again.',
                background: '#171717',
                color: '#fff',
                customClass: {
                    popup: 'rounded-[15px] border border-neutral-700',
                    title: 'text-red-500 font-bold'
                }
            });
        });
    }
</script>
@endpush
