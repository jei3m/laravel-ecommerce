<x-app-layout>
    <x-header />

    <div class="container mx-auto pt-10 p-2 lg:p-0">
        <div class="bg-neutral-800 rounded-[30px] p-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items Section -->
                <div class="lg:w-2/3">
                    <div class="bg-neutral-900 rounded-[20px] p-6 h-[600px] flex flex-col">
                        <h1 class="text-2xl font-bold text-white mb-6">Shopping Cart</h1>
                        
                        <!-- Cart Items Container -->
                        <div class="flex-1 overflow-y-auto pr-2 custom-scrollbar">
                            @if(isset($cartItems) && $cartItems->count() > 0)
                                <!-- Cart Items -->
                                <div class="space-y-4">
                                    @foreach($cartItems as $item)
                                        <div class="flex items-center justify-between p-4 border-b border-neutral-700 last:border-b-0">
                                            <div class="flex items-center gap-4">
                                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-lg">
                                                <div>
                                                    <h3 class="text-white font-semibold">{{ $item->product->name }}</h3>
                                                    <p class="text-gray-400">${{ number_format($item->product->price, 2) }}</p>
                                                </div>
                                            </div>
                                            
                                            <div class="flex items-center gap-4">
                                                <div class="flex items-center bg-neutral-800 rounded-lg">
                                                    <button onclick="updateQuantity({{ $item->id }}, 'decrease')" class="px-3 py-1 text-white hover:text-spink transition-colors">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <span class="px-3 text-white">{{ $item->quantity }}</span>
                                                    <button onclick="updateQuantity({{ $item->id }}, 'increase')" class="px-3 py-1 text-white hover:text-spink transition-colors">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                
                                                <button onclick="removeFromCart({{ $item->id }})" class="text-red-500 hover:text-red-600 transition-colors">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center h-full text-center">
                                    <div class="w-16 h-16 bg-neutral-800 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-shopping-cart text-2xl text-spink"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold text-white mb-2">Your cart is empty</h3>
                                    <p class="text-gray-400 mb-6">Add some items to your cart to see them here</p>
                                    <a href="{{ route('products.browse') }}" class="inline-block py-2 px-6 bg-spink text-white font-semibold rounded-lg hover:bg-pink-600 transition-colors">
                                        Browse Products
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Order Summary Section -->
                <div class="lg:w-1/3">
                    <div class="bg-neutral-900 rounded-[20px] p-6 h-full flex flex-col">
                        <div class="flex-grow">
                            <h2 class="text-xl font-bold text-white mb-6">Order Summary</h2>
                            <div class="space-y-4">
                                <div class="flex justify-between text-white">
                                    <span>Subtotal</span>
                                    <span>${{ number_format($subtotal ?? 0, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-white">
                                    <span>Shipping</span>
                                    <span>${{ number_format($shipping ?? 0, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-white">
                                    <span>Tax</span>
                                    <span>${{ number_format($tax ?? 0, 2) }}</span>
                                </div>
                                <div class="border-t border-neutral-700 pt-4">
                                    <div class="flex justify-between text-white font-bold text-lg">
                                        <span>Total</span>
                                        <span>${{ number_format($total ?? 0, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="w-full py-3 bg-spink text-white font-semibold rounded-lg hover:bg-pink-600 transition-colors mt-6">
                            Proceed to Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function updateQuantity(id, action) {
            fetch(`/cart/update`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    id: id,
                    action: action
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            });
        }

        function removeFromCart(id) {
            if (confirm('Are you sure you want to remove this item?')) {
                fetch(`/cart/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    }
                });
            }
        }
    </script>
    @endpush
</x-app-layout>
