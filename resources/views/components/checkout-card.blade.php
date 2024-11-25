@props([
    'orderNumber',
    'itemCount',
    'total',
    'time',
    'items'
])

<div class="flex items-start gap-3 bg-neutral-900 rounded-xl p-3">
    <div class="w-10 h-10 rounded-full bg-neutral-800 flex-shrink-0 flex items-center justify-center">
        <i class="fas fa-box text-spink"></i>
    </div>
    <div class="flex-grow">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-white font-medium">Order #{{ $orderNumber }}</p>
                <p class="text-gray-400 text-sm">{{ $itemCount }} {{ Str::plural('item', $itemCount) }} • ${{ number_format($total, 2) }}</p>
            </div>
            <span class="text-spink text-sm">{{ $time }}</span>
        </div>
        <div class="mt-2 text-sm text-gray-400">
            {{ $items }}
        </div>
    </div>
</div>
