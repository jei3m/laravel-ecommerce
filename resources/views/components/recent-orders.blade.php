@props(['recentOrders'])

<div class="border-b border-neutral-800 pb-4">
    <h2 class="text-xl font-semibold text-white mb-4">Recent Orders</h2>
    @if($recentOrders->isEmpty())
        <p class="text-gray-400">No orders yet.</p>
    @else
        <div class="space-y-4">
            @foreach($recentOrders as $order)
                <div class="bg-neutral-800 rounded-xl p-4">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <span class="text-md text-white">Order #{{ $order->id }}</span>
                            <p class="text-md font-bold text-white mb-2">${{ number_format($order->total_amount, 2) }}</p>
                            <p class="text-md">
                                @if($order->order_status === 'pending')
                                    <span class="text-yellow-500">Pending</span>
                                @elseif($order->order_status === 'completed')
                                    <span class="text-green-500">Completed</span>
                                @elseif($order->order_status === 'cancelled')
                                    <span class="text-red-500">Cancelled</span>
                                @endif
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="text-sm text-gray-400">{{ $order->created_at->format('M d, Y') }}</span>
                            <div class="flex flex-col items-end">
                                <p class="text-sm text-gray-400">
                                    {{ strtoupper($order->payment_method) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="text-sm text-gray-400 mb-2">Items:</div>
                        <div class="space-y-3">
                            @foreach($order->items as $item)
                                <div class="flex items-center space-x-3">
                                    @if(str_starts_with($item->product->image, 'http'))
                                        <img src="{{ $item->product->getImageUrl() }}" 
                                            alt="{{ $item->product->name }}" 
                                            class="w-12 h-12 object-cover rounded-lg">
                                    @else
                                        <img src="{{ asset('storage/' . $item->product->image) }}" 
                                            alt="{{ $item->product->name }}" 
                                            class="w-12 h-12 object-cover rounded-lg">
                                    @endif
                                    <div class="flex-1">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <h3 class="text-white font-medium">{{ $item->product->name }}</h3>
                                                <span class="text-sm text-gray-400">Qty: {{ $item->quantity }}</span>
                                                @if($order->order_status === 'completed')
                                                    @php
                                                        $userRating = $item->product->ratings()
                                                            ->where('user_id', auth()->id())
                                                            ->where('order_id', $order->id)
                                                            ->first();
                                                    @endphp
                                                    @if(!$userRating)
                                                        <form action="{{ route('ratings.store') }}" method="POST" class="mt-2">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                            <div class="flex items-center gap-2">
                                                                <select name="rating" onchange="toggleSubmitButton(this)" class="bg-neutral-700 text-white text-sm rounded-lg px-2 py-1">
                                                                    <option value="">Rate</option>
                                                                    @for($i = 1; $i <= 5; $i++)
                                                                        <option value="{{ $i }}">{{ $i }} ★</option>
                                                                    @endfor
                                                                </select>
                                                                <button type="submit" id="submitRating" style="display: none;" class="bg-spink text-white text-sm px-3 py-1 rounded-lg">
                                                                    Submit
                                                                </button>
                                                            </div>
                                                        </form>
                                                    @else
                                                        <div class="mt-2 flex items-center gap-2">
                                                            <span class="text-gray-400 text-sm">Your rating:</span>
                                                            <span class="text-yellow-500 text-sm font-medium">{{ $userRating->rating }} ★</span>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="text-right">
                                                <span class="text-md text-white font-bold"> $ {{ $item->price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="border-t border-neutral-700">
                                @if($order->payment_method === 'online' && $order->payment_status === 'pending')
                                <div class="flex gap-2 justify-end mt-4">
                                    <button type="button" 
                                        onclick="confirmOrderCancel('{{ route('orders.cancel', $order) }}')"
                                        class="inline-block bg-red-700 text-white text-sm font-bold py-1.5 px-4 rounded-xl">
                                        <i class="fas fa-times mr-1"></i>Cancel
                                    </button>
                                    <a href="{{ route('payment.process', $order) }}"
                                        class="inline-block bg-[#0070BA] hover:bg-[#003087] text-white text-sm font-bold py-1.5 px-4 rounded-xl transition-colors">
                                        <i class="fab fa-paypal mr-1"></i>Pay Now
                                    </a>
                                </div>
                                @elseif($order->payment_method === 'cod' && $order->payment_status === 'pending')
                                    <div class="mt-4">
                                        <button type="button" 
                                            onclick="confirmOrderCancel('{{ route('orders.cancel', $order) }}')"
                                            class="bg-red-700 text-white text-sm font-bold py-1.5 px-4 rounded-xl">
                                            <i class="fas fa-times mr-1"></i>Cancel
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
