<x-app-layout>
    <x-header />
    
    <div class="container mx-auto p-2 lg:p-12 bg-neutral-800 rounded-[30px]">
        <div class="w-auto mx-auto">
            <div class="bg-neutral-900 rounded-[20px] p-5">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-20 h-20 rounded-full bg-neutral-800 flex items-center justify-center">
                            <i class="fas fa-user text-3xl text-spink"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">Your Profile</h1>
                            <p class="text-gray-400">Manage your account settings and preferences</p>
                        </div>
                    </div>
                    <a href="{{ route('products.dashboard') }}" class="bg-spink text-white font-bold py-2 px-4 rounded-xl transition-colors">
                        <i class="fas fa-chart-bar mr-2"></i>Dashboard
                    </a>
                </div>

                <div class="space-y-6">
                    <div class="border-b border-neutral-800 pb-4">
                        <h2 class="text-xl font-semibold text-white mb-4">Personal Information</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-400">Name</label>
                                <p class="mt-1 text-white">{{ $user->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400">Email</label>
                                <p class="mt-1 text-white">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-b border-neutral-800 pb-4">
                        <h2 class="text-xl font-semibold text-white mb-4">Home Address</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="street" class="block text-sm font-medium text-gray-400">House/Unit & Street</label>
                                <input 
                                    type="text" 
                                    id="street" 
                                    name="street" 
                                    value="Unit 1234, Palm Street"
                                    class="mt-1 w-full px-4 py-2 bg-neutral-900 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-spink transition-colors"
                                >
                            </div>
                            <div>
                                <label for="barangay" class="block text-sm font-medium text-gray-400">Barangay</label>
                                <input 
                                    type="text" 
                                    id="barangay" 
                                    name="barangay" 
                                    value="Brgy. San Antonio"
                                    class="mt-1 w-full px-4 py-2 bg-neutral-900 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-spink transition-colors"
                                >
                            </div>
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-400">City/Municipality</label>
                                <input 
                                    type="text" 
                                    id="city" 
                                    name="city" 
                                    value="Makati City"
                                    class="mt-1 w-full px-4 py-2 bg-neutral-900 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-spink transition-colors"
                                >
                            </div>
                            <div>
                                <label for="province" class="block text-sm font-medium text-gray-400">Province & ZIP</label>
                                <input 
                                    type="text" 
                                    id="province" 
                                    name="province" 
                                    value="Metro Manila, 1200"
                                    class="mt-1 w-full px-4 py-2 bg-neutral-900 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-spink transition-colors"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="border-b border-neutral-800 pb-4">
                        <h2 class="text-xl font-semibold text-white mb-4">Shopping Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Cart Items</label>
                                <a href="{{ route('cart.index') }}" class="flex items-center gap-2 hover:bg-neutral-700/50 p-2 rounded-xl transition-colors group">
                                    <div class="w-10 h-10 rounded-full bg-neutral-800 flex items-center justify-center group-hover:bg-neutral-800/80 transition-colors">
                                        <i class="fas fa-shopping-cart text-spink"></i>
                                    </div>
                                    @php
                                        $cartItems = session()->get('cart', []);
                                        $itemCount = collect($cartItems)->sum('quantity');
                                    @endphp
                                    <p class="text-white text-lg">{{ $itemCount }} {{ Str::plural('item', $itemCount) }} in cart</p>
                                </a>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Total Orders</label>
                                <div class="flex items-center gap-2 p-2">
                                    <div class="w-10 h-10 rounded-full bg-neutral-800 flex items-center justify-center">
                                        <i class="fas fa-box text-spink"></i>
                                    </div>
                                    <p class="text-white text-lg">12 orders completed</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-b border-neutral-800 pb-4">
                        <h2 class="text-xl font-semibold text-white mb-4">Recent Checkouts</h2>
                        <div class="bg-neutral-800 rounded-[15px] p-4">
                            <x-checkout-json />
                        </div>
                    </div>

                    <div class="pb-4">
                        <div class="flex justify-between">
                            <form method="POST" action="{{ route('profile.destroy') }}" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="py-2 px-4 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition-colors" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                                    Delete Account
                                </button>
                            </form>
                            <a href="{{ route('profile.edit') }}" class="inline-block py-2 px-4 bg-spink text-white font-semibold rounded-lg hover:bg-pink-600 transition-colors">
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
