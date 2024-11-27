<header class="relative">
    <div class="container mx-auto mt-[0.5rem] py-4 px-4 lg:px-0">
        <nav class="flex items-center justify-between">
            {{-- Icon and Text --}}
            <a href="{{ route('products.index') }}" class="text-xl md:text-2xl lg:text-3xl font-bold text-spink flex items-center gap-2">
                <i class="fas fa-shopping-bag text-3xl lg:text-5xl mt-[-0.5rem]"></i>
                <span>E-COMMERCE</span>
            </a>

            {{-- Search Bar --}}
            <div class="relative hidden md:block max-w-xs">
                <div class="relative flex items-center px-2 py-1 rounded-full">
                    <i class="fas fa-search absolute left-5 text-gray-400"></i>
                    <input type="text" placeholder="Search products..." class="w-full py-2 pl-9 pr-4 bg-transparent text-white rounded-full focus:outline-none">
                </div>
            </div>

            <div class="hidden md:flex items-center space-x-4 lg:space-x-8">
                <a href="{{ route('products.index') }}" class="block py-2 text-sm lg:text-base text-spink font-semibold transition-colors">Home</a>
                <a href="{{ route('products.browse') }}" class="block py-2 text-sm lg:text-base text-spink font-semibold transition-colors">Browse</a>
                <a href="{{ route('profile') }}" class="block py-2 px-4 text-sm lg:text-base text-white font-semibold bg-neutral-800 rounded-full flex items-center gap-2">
                    <span>Profile</span>
                    <div class="w-6 h-6 lg:w-7 lg:h-7 rounded-full bg-neutral-900 flex items-center justify-center">
                        <i class="fas fa-user text-xs lg:text-sm"></i>
                    </div>
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden" x-data="{ open: false }">
                <button @click="open = !open" type="button" class="text-spink focus:outline-none p-2">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Mobile menu -->
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute top-full right-0 w-48 mt-2 bg-neutral-800 shadow-lg rounded-xl overflow-hidden z-50">
                    <div class="p-2 space-y-1">
                        <a href="{{ route('products.index') }}" class="block px-4 py-2 text-white hover:bg-neutral-700 rounded-lg transition-colors">Home</a>
                        <a href="{{ route('products.browse') }}" class="block px-4 py-2 text-white hover:bg-neutral-700 rounded-lg transition-colors">Browse</a>
                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-white hover:bg-neutral-700 rounded-lg transition-colors">Profile</a>
                        
                        <!-- Mobile Search -->
                        <div class="relative px-4 py-2">
                            <div class="relative flex items-center px-2 py-1 bg-neutral-900 rounded-lg">
                                <i class="fas fa-search absolute left-3 text-gray-400 text-sm"></i>
                                <input type="text" placeholder="Search..." class="w-full py-1.5 pl-8 pr-4 bg-transparent text-white text-sm rounded-lg focus:outline-none">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
