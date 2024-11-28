<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-neutral-900 rounded-[20px] p-8 text-center">
                <div class="mb-6">
                    <div class="w-16 h-16 bg-green-500/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle text-3xl text-green-500"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">Order Placed Successfully!</h2>
                    <p class="text-gray-400">Thank you for your order. We'll start processing it right away.</p>
                </div>

                <div class="bg-neutral-800 rounded-xl p-6 max-w-md mx-auto mb-6">
                    <div class="text-left space-y-4">
                        <div>
                            <span class="text-gray-400">Order Number:</span>
                            <span class="text-white ml-2">#{{ $order->id }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Total Amount:</span>
                            <span class="text-white ml-2">${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Payment Method:</span>
                            <span class="text-white ml-2">{{ ucfirst($order->payment_method) }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Shipping Address:</span>
                            <p class="text-white mt-1">{{ $order->shipping_address }}</p>
                        </div>
                    </div>
                </div>

                @if($order->payment_method === 'cod')
                    <p class="text-gray-400 mb-6">We will contact you shortly to confirm your order.</p>
                @else
                    <p class="text-gray-400 mb-6">Please complete your payment to process your order.</p>
                @endif

                <div class="flex justify-center gap-4">
                    <a href="{{ route('products.index') }}" 
                        class="inline-flex items-center px-4 py-2 bg-neutral-800 text-white rounded-xl hover:bg-neutral-700 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
