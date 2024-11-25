<header>
    <div class="container mx-auto mt-[0.5rem] py-4 px-2 lg:px-0">
        <nav class="flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="{{ route('products.index') }}" class="text-3xl font-bold text-spink flex items-center gap-2 mr-6">
                    <i class="fas fa-shopping-bag text-5xl mt-[-0.5rem]"></i>
                    E-COMMERCE
                </a>
                <div class="relative hidden md:flex items-center px-2 py-1 bg-neutral-800 rounded-full">
                    <i class="fas fa-search absolute left-5 text-gray-400"></i>
                    <input type="text" placeholder="Search products..." class="w-auto py-2 pl-9 pr-4 bg-transparent text-white rounded-full focus:outline-none">
                </div>
            </div>  
            
            <div class="hidden md:flex items-center space-x-8">
                <a class="block py-2 text-spink font-semibold">Home</a>
                <a class="block py-2 text-spink font-semibold">Browse</a>
                <a class="block py-2 px-4 text-white font-semibold bg-neutral-800 rounded-full flex items-center gap-2">
                    Profile
                    <div class="w-7 h-7 rounded-full bg-neutral-900 flex items-center justify-center">
                        <i class="fas fa-user text-sm"></i>
                    </div>
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden" x-data="{ open: false }">
                <button @click="open = !open" type="button" class="text-spink focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <!-- Mobile menu -->
                <div x-show="open" class="absolute top-16 left-0 right-0 bg-neutral-900 shadow-lg p-4 md:hidden z-50 rounded-xl p-2">
                    <a class="block py-2 text-spink font-semibold">Home</a>
                    <a class="block py-2 text-spink font-semibold">Browse</a>
                    <a class="block py-2 text-spink font-semibold">Profile</a>
                </div>
            </div>
        </nav>
    </div>
</header>
