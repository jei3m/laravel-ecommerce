@extends('layouts.app')

@section('content')
<div class="container mx-auto p-2 lg:p-12 bg-neutral-800 rounded-[30px]">
    <div class="w-auto mx-auto">
        <div class="bg-neutral-900 rounded-[20px] p-5">
            <div class="flex items-center space-x-4 mb-6">
                <div class="w-20 h-20 rounded-full bg-neutral-800 flex items-center justify-center">
                    <i class="fas fa-user text-3xl text-spink"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white">Your Profile</h1>
                    <p class="text-gray-400">Manage your account settings and preferences</p>
                </div>
            </div>

            <div class="space-y-6">
                <div class="border-b border-neutral-800 pb-4">
                    <h2 class="text-xl font-semibold text-white mb-4">Personal Information</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-400">Name</label>
                            <p class="mt-1 text-white">John Doe</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400">Email</label>
                            <p class="mt-1 text-white">john@example.com</p>
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
                            <label class="block text-sm font-medium text-gray-400">Cart Items</label>
                            <div class="mt-2 flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-neutral-800 flex items-center justify-center">
                                    <i class="fas fa-shopping-cart text-spink"></i>
                                </div>
                                <p class="text-white text-lg">3 items in cart</p>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400">Total Orders</label>
                            <div class="mt-2 flex items-center gap-2">
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

                <div class="flex justify-end">
                    <button class="bg-spink text-white px-6 py-3 rounded-full">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
