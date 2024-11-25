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
                        <div class="max-h-[300px] overflow-y-auto pr-2 space-y-4 custom-scrollbar">
                            <x-checkout-card 
                                orderNumber="1234"
                                itemCount="2"
                                total="299.98"
                                time="Just now"
                                items="Gaming Laptop, Smartphone"
                            />

                            <x-checkout-card 
                                orderNumber="1233"
                                itemCount="1"
                                total="149.99"
                                time="2 hours ago"
                                items="Wireless Headphones"
                            />

                            <x-checkout-card 
                                orderNumber="1232"
                                itemCount="3"
                                total="599.97"
                                time="1 day ago"
                                items="Smart Watch, Keyboard, Mouse"
                            />

                            <x-checkout-card 
                                orderNumber="1231"
                                itemCount="1"
                                total="899.99"
                                time="3 days ago"
                                items="4K Monitor"
                            />
                        </div>
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
