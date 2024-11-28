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
                            
                            <!-- Shipping Address -->
                            <div class="mb-6">
                                <h3 class="text-lg text-white mb-3">Shipping Address</h3>
                                @if(auth()->user()->street_address)
                                    <div class="bg-neutral-800 rounded-xl p-4 text-gray-300 space-y-2">
                                        <div class="grid grid-cols-3 gap-1">
                                            <span class="text-gray-400">Street Address:</span>
                                            <span class="col-span-2">{{ auth()->user()->street_address }}</span>
                                        </div>
                                        <div class="grid grid-cols-3 gap-1">
                                            <span class="text-gray-400">Barangay:</span>
                                            <span class="col-span-2">{{ auth()->user()->barangay }}</span>
                                        </div>
                                        <div class="grid grid-cols-3 gap-1">
                                            <span class="text-gray-400">City:</span>
                                            <span class="col-span-2">{{ auth()->user()->city }}</span>
                                        </div>
                                        <div class="grid grid-cols-3 gap-1">
                                            <span class="text-gray-400">Province:</span>
                                            <span class="col-span-2">{{ auth()->user()->province }}</span>
                                        </div>
                                        <div class="pt-2">
                                            <a href="/profile" class="text-spink hover:text-spink/80 transition-colors text-sm">
                                                Edit address →
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="bg-neutral-800 rounded-xl p-4 text-gray-400">
                                        <p class="mb-2">No shipping address set</p>
                                        <a href="{{ route('profile.edit') }}" class="text-spink hover:text-spink/80 transition-colors">
                                            Add shipping address →
                                        </a>
                                    </div>
                                @endif
                            </div>

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
                        
                        <!-- Payment Method Selection -->
                        <div class="mt-6">
                            <h3 class="text-lg text-white mb-3">Payment Method</h3>
                            <form action="{{ route('orders.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <div class="space-y-3">
                                    <label class="flex items-center bg-neutral-800 rounded-xl p-4 cursor-pointer hover:bg-neutral-800/80 transition-colors">
                                        <input type="radio" name="payment_method" value="cod" class="mr-3 text-spink focus:ring-spink" checked>
                                        <div>
                                            <p class="text-white font-medium">Cash on Delivery</p>
                                            <p class="text-gray-400 text-sm">Pay when you receive your order</p>
                                        </div>
                                    </label>
                                    
                                    <label class="flex items-center bg-neutral-800 rounded-xl p-4 cursor-pointer hover:bg-neutral-800/80 transition-colors">
                                        <input type="radio" name="payment_method" value="online" class="mr-3 text-spink focus:ring-spink">
                                        <div>
                                            <p class="text-white font-medium">Online Payment</p>
                                            <p class="text-gray-400 text-sm">Pay securely with your credit/debit card</p>
                                        </div>
                                    </label>
                                </div>

                                <button type="submit" 
                                    @if(!auth()->user()->street_address) disabled @endif
                                    class="w-full bg-spink hover:bg-spink/80 text-white font-medium py-3 px-4 rounded-xl transition-colors disabled:opacity-50 disabled:cursor-not-allowed mt-6">
                                    @if(!auth()->user()->street_address)
                                        Please Add Shipping Address
                                    @else
                                        Place Order
                                    @endif
                                </button>
                            </form>
                        </div>
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
            Swal.fire({
                title: 'Remove Item',
                text: 'Are you sure you want to remove this item from your cart?',
                icon: 'warning',
                iconColor: '#Ff91a4',
                showCancelButton: true,
                confirmButtonText: 'Remove',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#374151',
                background: '#171717',
                color: '#ffffff',
                customClass: {
                    popup: 'rounded-[20px] border border-neutral-800',
                    confirmButton: 'rounded-xl',
                    cancelButton: 'rounded-xl'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    Swal.fire({
                        title: 'Removing...',
                        text: 'Removing item from cart',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        background: '#171717',
                        color: '#ffffff',
                        customClass: {
                            popup: 'rounded-[20px] border border-neutral-800'
                        },
                        willOpen: () => {
                            Swal.showLoading();
                        },
                        didOpen: () => {
                            const loader = Swal.getHtmlContainer().querySelector('.swal2-loader');
                            if (loader) {
                                loader.style.borderLeftColor = '#Ff91a4';
                            }
                        }
                    });

                    fetch(`/cart/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Item removed from cart',
                                iconColor: '#22c55e',
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                                background: '#171717',
                                color: '#ffffff',
                                customClass: {
                                    popup: 'rounded-[20px] border border-neutral-800'
                                }
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    });
                }
            });
        }
    </script>
    @endpush
</x-app-layout>
