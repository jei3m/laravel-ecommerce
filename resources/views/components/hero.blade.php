<div class="relative h-auto overflow-hidden bg-neutral-900 rounded-[20px] mb-10 py-4 px-6">
    {{-- Animated stars background --}}
    <div class="absolute inset-0 opacity-30">
        @for ($i = 0; $i < 50; $i++)
            <div class="absolute h-1 w-1 rounded-full bg-white animate-[twinkle_3s_ease-in-out_infinite]"
                style="top: {{ rand(0, 100) }}%; left: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 3) }}s; animation-duration: {{ rand(2, 5) }}s;">
            </div>
        @endfor
    </div>
    
    {{-- Content --}}
    <div class="container relative mx-auto px-4 py-12">
        <div class="max-w-3xl animate-[fadeInUp_0.6s_ease-out]">
            <h2 class="mb-2 text-2xl font-thin text-gray-400">
                Welcome To Shop
            </h2>
            <h1 class="mb-6 text-5xl font-bold tracking-tight text-white lg:text-6xl">
                <span class="text-spink">
                    BROWSE
                </span>
                OUR POPULAR ITEMS HERE
            </h1>
            <a href="{{ route('products.browse') }}" class="inline-block py-3 px-6 bg-spink font-semibold text-white rounded-full">
                Browse Now
            </a>
        </div>
    </div>
</div>

<style>
    @keyframes twinkle {
        0%, 100% { opacity: 0.2; }
        50% { opacity: 1; }
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
