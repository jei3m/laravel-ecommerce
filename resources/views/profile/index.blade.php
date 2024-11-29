<x-app-layout>
    <x-header />
    
    <!-- Main container with dark background and rounded corners -->
    <div class="container mx-auto p-2 lg:p-12 bg-neutral-800 rounded-[30px] mb-10">
        <div class="w-auto mx-auto">
            
            <!-- Profile section -->
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

                    <div class="space-y-2 flex flex-col">
                        @if(auth()->user()->isAdmin())
                        <a href="{{ route('products.dashboard') }}" class="bg-spink text-white font-bold py-2 px-4 rounded-xl">
                            Products
                        </a>
                        <a href="{{ route('orders.dashboard') }}" class="bg-spink text-white text-center font-bold py-2 px-4 rounded-xl">
                            Orders
                        </a>
                        @endif
                    </div>

                </div>

                <!-- Personal Information Section -->
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

                    <!-- Address Information Section -->
                    <div class="border-b border-neutral-800 pb-4">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-semibold text-white">Address Information</h2>
                        </div>
                        <form id="address-form" action="{{ route('profile.update-address') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="street_address" class="block text-sm font-medium text-gray-400">House/Unit & Street</label>
                                    <input 
                                        type="text" 
                                        id="street_address" 
                                        name="street_address" 
                                        value="{{ $user->street_address }}"
                                        class="mt-1 w-full px-4 py-2 bg-neutral-900 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-spink transition-colors"
                                    >
                                </div>
                                <div>
                                    <label for="barangay" class="block text-sm font-medium text-gray-400">Barangay</label>
                                    <input 
                                        type="text" 
                                        id="barangay" 
                                        name="barangay" 
                                        value="{{ $user->barangay }}"
                                        class="mt-1 w-full px-4 py-2 bg-neutral-900 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-spink transition-colors"
                                    >
                                </div>
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-400">City</label>
                                    <input 
                                        type="text" 
                                        id="city" 
                                        name="city" 
                                        value="{{ $user->city }}"
                                        class="mt-1 w-full px-4 py-2 bg-neutral-900 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-spink transition-colors"
                                    >
                                </div>
                                <div>
                                    <label for="province" class="block text-sm font-medium text-gray-400">Province</label>
                                    <input 
                                        type="text" 
                                        id="province" 
                                        name="province" 
                                        value="{{ $user->province }}"
                                        class="mt-1 w-full px-4 py-2 bg-neutral-900 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-spink transition-colors"
                                    >
                                </div>
                            </div>
                            <div class="flex justify-end mt-4">
                                <button type="button" onclick="saveAddress()" class="bg-spink text-white font-bold py-2 px-4 rounded-xl">
                                    <i class="fas fa-save mr-2"></i>Update Address
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Shopping Information Section -->
                    <div class="border-b border-neutral-800 pb-4">
                        <h2 class="text-xl font-semibold text-white mb-4">Shopping Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Cart Items</label>
                                <a href="{{ route('cart.index') }}" class="flex items-center gap-2 hover:bg-neutral-700/50 p-2 rounded-xl transition-colors group">
                                    <div class="w-10 h-10 rounded-full bg-neutral-800 flex items-center justify-center group-hover:bg-neutral-800/80 transition-colors">
                                        <i class="fas fa-shopping-cart text-spink"></i>
                                    </div>
                                    <p class="text-white text-lg">{{ $cartItemCount }} {{ Str::plural('item', $cartItemCount) }} in cart</p>
                                </a>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Total Orders</label>
                                <div class="flex items-center gap-2 p-2">
                                    <div class="w-10 h-10 rounded-full bg-neutral-800 flex items-center justify-center">
                                        <i class="fas fa-box text-spink"></i>
                                    </div>
                                    <p class="text-white text-lg">{{$orderItemCount}} orders completed</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Recent Orders --}}
                    <x-recent-orders :recentOrders="$recentOrders" />

                    <!-- Button Section -->
                    <div class="pb-4">
                        <div class="flex flex-wrap gap-2 justify-between md:flex-nowrap">
                            <form method="POST" action="{{ route('profile.destroy') }}" class="inline-block w-full md:w-auto" id="deleteAccountForm">
                                @csrf
                                @method('DELETE')
                                <button onclick="confirmDelete()" type="button" class="w-full md:w-auto py-2 px-4 bg-red-500 text-white font-semibold rounded-lg">
                                    <i class="fas fa-trash-alt mr-2"></i>Delete Account
                                </button>
                            </form>
                            <form method="POST" action="{{ route('logout') }}" class="inline-block w-full md:w-auto" id="logoutForm">
                                @csrf
                                <button onclick="confirmLogout()" type="button" class="w-full md:w-auto py-2 px-4 bg-neutral-700 text-white font-semibold rounded-lg">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </button>   
                            </form>
                            <a href="{{ route('profile.edit') }}" class="text-center inline-block w-full md:w-auto py-2 px-4 bg-spink text-white font-semibold rounded-lg">
                                <i class="fas fa-user-edit mr-2"></i>Edit Profile
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function confirmDelete() {
                Swal.fire({
                    title: 'Delete Account',
                    text:'Please enter your password to confirm deletion',
                    input:'password',
                    inputAttributes: {
                        autocapitalize:'off',
                        required:'true',
                    },
                    showCancelButton:'true',
                    confirmButtonText:'Delete Account',
                    confirmButtonColor: '#Ff91a4',
                    cancelButtonColor: '#374151',
                    background:'#171717',
                    color:'#ffffff',
                    customClass: {
                        input: 'bg-neutral-800 border-neutral-700 text-white rounded-xl',
                        popup: 'rounded-[20px] border border-neutral-800',
                        confirmButton: 'rounded-xl',
                        cancelButton: 'rounded-xl'
                    },
                    preConfirm: (password) => {
                        const form = document.getElementById('deleteAccountForm');
                        const passwordInput = document.createElement('input');
                        passwordInput.type = 'hidden';
                        passwordInput.name = 'password';
                        passwordInput.value = password;
                        form.appendChild(passwordInput);
                        form.submit();
                    }
                })
            }

            function confirmLogout() {
                Swal.fire({
                    title: 'Logout',
                    text: 'Are you sure you want to logout?',
                    showCancelButton: true,
                    confirmButtonText: 'Logout',
                    confirmButtonColor: '#Ff91a4',
                    cancelButtonColor: '#374151',
                    background: '#171717',
                    color: '#ffffff',
                    customClass: {
                        popup: 'rounded-[20px] border border-neutral-800',
                        confirmButton: 'rounded-xl',
                        cancelButton: 'rounded-xl'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('logoutForm').submit();
                    }
                });
            }

            function saveAddress() {
                const form = document.getElementById('address-form');
                const formData = new FormData(form);

                // Show loading state
                Swal.fire({
                    title: 'Saving...',
                    text: 'Updating your address information',
                    background: '#171717',
                    color:'#fff',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    },
                    didOpen: () => {
                        const loader = Swal.getHtmlContainer().querySelector('.swal2-loader');
                        if (loader) {
                            loader.style.borderLeftColor = '#ec4899';
                        }
                    }
                });

                // Convert FormData to JSON
                const jsonData = {};
                formData.forEach((value, key) => {
                    jsonData[key] = value;
                });
                
                fetch(form.action, {
                    method: 'PUT',
                    body: JSON.stringify(jsonData),
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'same-origin'
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    return response.text().then(text => {
                        try {
                            return text ? JSON.parse(text) : {}
                        } catch (e) {
                            console.error('Error parsing response:', text);
                            throw new Error('Invalid JSON response');
                        }
                    }).then(data => {
                        if (!response.ok) {
                            return Promise.reject(data);
                        }
                        return data;
                    });
                })
                .then(data => {
                    console.log('Success:', data);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message || 'Your address has been updated successfully',
                        iconColor: '#22c55e',
                        background: '#171717',
                        color:'#fff',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        buttonsStyling: true,
                        confirmButtonColor: '#Ff91a4',
                        customClass: {
                            popup: 'rounded-[20px] border border-neutral-800',
                            confirmButton: 'rounded-xl font-bold',
                            icon: 'border-green-500 text-green-500'
                        }
                    }).then(() => {
                        window.location.reload();
                    });
                })
                .catch(error => {
                    console.error('Error details:', error);
                    let errorMessage = 'Failed to update address.';
                    if (error.errors) {
                        errorMessage = Object.values(error.errors).flat().join('\n');
                    } else if (error.message) {
                        errorMessage = error.message;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage,
                        iconColor: '#ec4899',
                        background: '#171717',
                        color: '#fff',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#Ff91a4',
                        customClass: {
                            popup: 'rounded-[20px] border border-neutral-800',
                            confirmButton: 'rounded-xl font-bold'
                        }
                    });
                });

                return false;
            }

            function confirmOrderCancel(cancelUrl) {
                Swal.fire({
                    title: 'Cancel Order',
                    text: 'Are you sure you want to cancel this order? This action cannot be undone.',
                    icon: 'warning',
                    iconColor: '#dc2626',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, cancel order',
                    cancelButtonText: 'No, keep order',
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#374151',
                    background: '#171717',
                    color: '#ffffff',
                    customClass: {
                        popup: 'rounded-[20px] border border-neutral-800',
                        confirmButton: 'rounded-xl',
                        cancelButton: 'rounded-xl'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading state
                        Swal.fire({
                            title: 'Cancelling Order...',
                            text: 'Please wait while we process your request',
                            background: '#171717',
                            color: '#fff',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            willOpen: () => {
                                Swal.showLoading();
                            },
                            didOpen: () => {
                                const loader = Swal.getHtmlContainer().querySelector('.swal2-loader');
                                if (loader) {
                                    loader.style.borderLeftColor = '#dc2626';
                                }
                            }
                        });

                        // Redirect to cancel URL
                        window.location.href = cancelUrl;
                    }
                });
            }

            function toggleSubmitButton(select) {
                const submitButton = select.parentElement.querySelector('#submitRating');
                submitButton.style.display = select.value ? 'block' : 'none';
            }
        </script>
    @endpush
</x-app-layout>
