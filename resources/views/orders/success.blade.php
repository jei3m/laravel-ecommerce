<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-neutral-950 rounded-[30px] p-10 shadow-2xl">
                <div class="mb-8">
                    <div class="w-20 h-20 bg-green-500/10 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-green-500/10">
                        <i class="fas fa-check-circle text-4xl text-green-500"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-3">Order Placed Successfully!</h2>
                    <p class="text-gray-400 text-lg">We'll start processing it right away.</p>
                </div>

                <div class="max-w-2xl mx-auto mb-8">
                    <div class="text-left space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="bg-neutral-800 rounded-xl p-4 shadow-md">
                                <span class="text-gray-400 text-sm">Order Number</span>
                                <p class="text-white text-lg font-semibold">#{{ $order->id }}</p>
                            </div>
                            <div class="bg-neutral-800 rounded-xl p-4 shadow-md">
                                <span class="text-gray-400 text-sm">Total Amount</span>
                                <p class="text-white text-lg font-semibold">${{ number_format($order->total_amount, 2) }}</p>
                            </div>
                        </div>
                        
                        <div class="bg-neutral-800 rounded-xl p-4 shadow-md">
                            <span class="text-gray-400 text-sm">Payment Method</span>
                            <p class="text-white text-lg font-semibold">{{ strtoupper($order->payment_method) }}</p>
                        </div>

                        <div class="bg-neutral-800 rounded-xl p-6 shadow-md space-y-4">
                            <h3 class="text-white font-semibold mb-4">Delivery Address</h3>
                            <div class="space-y-3">
                                <div class="grid grid-cols-3 gap-2">
                                    <span class="text-gray-400">Region</span>
                                    <span class="col-span-2 text-white">{{ auth()->user()->region }}</span>
                                </div>

                                <div class="grid grid-cols-3 gap-2">
                                    <span class="text-gray-400">Province</span>
                                    <span class="col-span-2 text-white">{{ auth()->user()->province }}</span>
                                </div>

                                <div class="grid grid-cols-3 gap-2">
                                    <span class="text-gray-400">City</span>
                                    <span class="col-span-2 text-white">{{ auth()->user()->city }}</span>
                                </div>

                                <div class="grid grid-cols-3 gap-2">
                                    <span class="text-gray-400">Barangay</span>
                                    <span class="col-span-2 text-white">{{ auth()->user()->barangay }}</span>
                                </div>

                                <div class="grid grid-cols-3 gap-2">
                                    <span class="text-gray-400">Street Address</span>
                                    <span class="col-span-2 text-white">{{ auth()->user()->street_address }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($order->payment_method === 'cod')
                    <p class="text-gray-400 text-lg mb-8 text-center">We will contact you shortly to confirm your order.</p>
                @else
                    <p class="text-gray-400 text-lg mb-8 text-center">Thank you for ordering!</p>
                @endif

                <div class="flex justify-center">
                    <a href="{{ route('products.index') }}" 
                        class="inline-flex items-center px-6 py-3 bg-spink text-white rounded-xl hover:bg-neutral-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
