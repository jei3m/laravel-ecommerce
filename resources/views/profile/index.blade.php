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
                        @if(auth()->user()->hasRole('admin'))
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
                                
                                <!-- Region Dropdown -->
                                <div>
                                    <label for="region" class="block text-sm font-medium text-gray-400 mb-1">Region</label>
                                    <select id="region" class="w-full px-4 py-2.5 bg-neutral-900 border border-neutral-700 text-white rounded-xl focus:outline-none focus:border-spink transition-colors appearance-none cursor-pointer" required>
                                        <option value="" disabled selected>Choose Region</option>
                                    </select>
                                    <input type="hidden" id="region-text" name="region" value="{{ $user->region }}" required>
                                </div>

                                <!-- Province Dropdown -->
                                <div>
                                    <label for="province" class="block text-sm font-medium text-gray-400 mb-1">Province</label>
                                    <select id="province" class="w-full px-4 py-2.5 bg-neutral-900 border border-neutral-700 text-white rounded-xl focus:outline-none focus:border-spink transition-colors appearance-none cursor-pointer" required>
                                        <option value="" disabled selected>Choose Province</option>
                                    </select>
                                    <input type="hidden" id="province-text" name="province" value="{{ $user->province }}" required>
                                </div>

                                <!-- City Dropdown -->
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-400 mb-1">City/Municipality</label>
                                    <select id="city" class="w-full px-4 py-2.5 bg-neutral-900 border border-neutral-700 text-white rounded-xl focus:outline-none focus:border-spink transition-colors appearance-none cursor-pointer" required>
                                        <option value="" disabled selected>Choose City</option>
                                    </select>
                                    <input type="hidden" id="city-text" name="city" value="{{ $user->city }}" required>
                                </div>

                                <!-- Barangay Dropdown -->
                                <div>
                                    <label for="barangay" class="block text-sm font-medium text-gray-400 mb-1">Barangay</label>
                                    <select id="barangay" class="w-full px-4 py-2.5 bg-neutral-900 border border-neutral-700 text-white rounded-xl focus:outline-none focus:border-spink transition-colors appearance-none cursor-pointer" required>
                                        <option value="" disabled selected>Choose Barangay</option>
                                    </select>
                                    <input type="hidden" id="barangay-text" name="barangay" value="{{ $user->barangay }}" required>
                                </div>

                                <div class="w-full">
                                    <label for="street_address" class="block text-sm font-medium text-gray-400 mb-1">House/Unit & Street</label>
                                    <input 
                                        type="text" 
                                        id="street_address" 
                                        name="street_address" 
                                        value="{{ $user->street_address }}"
                                        required
                                        class="w-full px-4 py-2.5 bg-neutral-900 border border-neutral-700 text-white rounded-xl focus:outline-none focus:border-spink transition-colors placeholder-gray-500"
                                        placeholder="Enter street address"
                                    >
                                </div>

                                <div class="flex justify-center md:justify-end py-2.5 mt-4">
                                    <button type="button" onclick="saveAddress()" class="bg-spink text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-spink/80 transition-colors flex items-center space-x-2">
                                        <i class="fas fa-save"></i>
                                        <span>Update Address</span>
                                    </button>
                                </div>

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
    @push('styles')
        <style>
            select.address-dropdown {
                @apply mt-1 w-full px-4 py-2 bg-neutral-900 border border-neutral-700 rounded-xl text-white focus:outline-none transition-colors;
            }
        </style>
    @endpush
    @push('scripts')
        
        <!-- Philippine Address Selector Script -->
        <script>
            var my_handlers = {
                fill_provinces: function() {
                    var region_code = $(this).val();
                    var region_text = $(this).find("option:selected").text();
                    $('#region-text').val(region_text);
                    
                    let dropdown = $('#province');
                    dropdown.empty();
                    dropdown.append('<option selected="true" disabled>Choose State/Province</option>');
                    dropdown.prop('selectedIndex', 0);

                    $.getJSON('ph-json/province.json', function(data) {
                        var provinces = data.filter(province => province.region_code === region_code);
                        provinces.sort((a, b) => a.province_name.localeCompare(b.province_name));

                        $.each(provinces, function(key, entry) {
                            dropdown.append($('<option></option>')
                                .attr('value', entry.province_code)
                                .text(entry.province_name));
                        });

                        // Set selected province if exists
                        var savedProvince = $('#province-text').val();
                        if (savedProvince) {
                            dropdown.find('option').each(function() {
                                if ($(this).text() === savedProvince) {
                                    dropdown.val($(this).val()).trigger('change');
                                    return false;
                                }
                            });
                        }
                    });
                },

                fill_cities: function() {
                    var province_code = $(this).val();
                    var province_text = $(this).find("option:selected").text();
                    $('#province-text').val(province_text);
                    
                    let dropdown = $('#city');
                    dropdown.empty();
                    dropdown.append('<option selected="true" disabled>Choose City/Municipality</option>');
                    dropdown.prop('selectedIndex', 0);

                    $.getJSON('ph-json/city.json', function(data) {
                        var cities = data.filter(city => city.province_code === province_code);
                        cities.sort((a, b) => a.city_name.localeCompare(b.city_name));

                        $.each(cities, function(key, entry) {
                            dropdown.append($('<option></option>')
                                .attr('value', entry.city_code)
                                .text(entry.city_name));
                        });

                        // Set selected city if exists
                        var savedCity = $('#city-text').val();
                        if (savedCity) {
                            dropdown.find('option').each(function() {
                                if ($(this).text() === savedCity) {
                                    dropdown.val($(this).val()).trigger('change');
                                    return false;
                                }
                            });
                        }
                    });
                },

                fill_barangays: function() {
                    var city_code = $(this).val();
                    var city_text = $(this).find("option:selected").text();
                    $('#city-text').val(city_text);
                    
                    let dropdown = $('#barangay');
                    dropdown.empty();
                    dropdown.append('<option selected="true" disabled>Choose Barangay</option>');
                    dropdown.prop('selectedIndex', 0);

                    $.getJSON('ph-json/barangay.json', function(data) {
                        var barangays = data.filter(barangay => barangay.city_code === city_code);
                        barangays.sort((a, b) => a.brgy_name.localeCompare(b.brgy_name));

                        $.each(barangays, function(key, entry) {
                            dropdown.append($('<option></option>')
                                .attr('value', entry.brgy_code)
                                .text(entry.brgy_name));
                        });

                        // Set selected barangay if exists
                        var savedBarangay = $('#barangay-text').val();
                        if (savedBarangay) {
                            dropdown.find('option').each(function() {
                                if ($(this).text() === savedBarangay) {
                                    dropdown.val($(this).val()).trigger('change');
                                    return false;
                                }
                            });
                        }
                    });
                },

                onchange_barangay: function() {
                    var barangay_text = $(this).find("option:selected").text();
                    $('#barangay-text').val(barangay_text);
                }
            };

            $(function() {
                // Event handlers for dropdowns
                $('#region').on('change', my_handlers.fill_provinces);
                $('#province').on('change', my_handlers.fill_cities);
                $('#city').on('change', my_handlers.fill_barangays);
                $('#barangay').on('change', my_handlers.onchange_barangay);

                // Initialize region dropdown
                let regionDropdown = $('#region');
                regionDropdown.empty();
                regionDropdown.append('<option selected="true" disabled>Choose Region</option>');
                regionDropdown.prop('selectedIndex', 0);

                // Load regions and set the selected region
                $.getJSON('ph-json/region.json', function(data) {
                    data.sort((a, b) => a.region_name.localeCompare(b.region_name));
                    
                    $.each(data, function(key, entry) {
                        regionDropdown.append($('<option></option>')
                            .attr('value', entry.region_code)
                            .text(entry.region_name));
                    });

                    // Set selected region if exists
                    var savedRegion = $('#region-text').val();
                    if (savedRegion) {
                        regionDropdown.find('option').each(function() {
                            if ($(this).text() === savedRegion) {
                                regionDropdown.val($(this).val()).trigger('change');
                                return false;
                            }
                        });
                    }
                });

                // Load provinces when region is selected
                my_handlers.fill_provinces = function() {
                    var region_code = $(this).val();
                    var region_text = $(this).find("option:selected").text();
                    $('#region-text').val(region_text);
                    
                    let dropdown = $('#province');
                    dropdown.empty();
                    dropdown.append('<option selected="true" disabled>Choose State/Province</option>');
                    dropdown.prop('selectedIndex', 0);

                    $.getJSON('ph-json/province.json', function(data) {
                        var provinces = data.filter(province => province.region_code === region_code);
                        provinces.sort((a, b) => a.province_name.localeCompare(b.province_name));

                        $.each(provinces, function(key, entry) {
                            dropdown.append($('<option></option>')
                                .attr('value', entry.province_code)
                                .text(entry.province_name));
                        });

                        // Set selected province if exists
                        var savedProvince = $('#province-text').val();
                        if (savedProvince) {
                            dropdown.find('option').each(function() {
                                if ($(this).text() === savedProvince) {
                                    dropdown.val($(this).val()).trigger('change');
                                    return false;
                                }
                            });
                        }
                    });
                };

                // Load cities when province is selected
                my_handlers.fill_cities = function() {
                    var province_code = $(this).val();
                    var province_text = $(this).find("option:selected").text();
                    $('#province-text').val(province_text);
                    
                    let dropdown = $('#city');
                    dropdown.empty();
                    dropdown.append('<option selected="true" disabled>Choose City/Municipality</option>');
                    dropdown.prop('selectedIndex', 0);

                    $.getJSON('ph-json/city.json', function(data) {
                        var cities = data.filter(city => city.province_code === province_code);
                        cities.sort((a, b) => a.city_name.localeCompare(b.city_name));

                        $.each(cities, function(key, entry) {
                            dropdown.append($('<option></option>')
                                .attr('value', entry.city_code)
                                .text(entry.city_name));
                        });

                        // Set selected city if exists
                        var savedCity = $('#city-text').val();
                        if (savedCity) {
                            dropdown.find('option').each(function() {
                                if ($(this).text() === savedCity) {
                                    dropdown.val($(this).val()).trigger('change');
                                    return false;
                                }
                            });
                        }
                    });
                };

                // Load barangays when city is selected
                my_handlers.fill_barangays = function() {
                    var city_code = $(this).val();
                    var city_text = $(this).find("option:selected").text();
                    $('#city-text').val(city_text);
                    
                    let dropdown = $('#barangay');
                    dropdown.empty();
                    dropdown.append('<option selected="true" disabled>Choose Barangay</option>');
                    dropdown.prop('selectedIndex', 0);

                    $.getJSON('ph-json/barangay.json', function(data) {
                        var barangays = data.filter(barangay => barangay.city_code === city_code);
                        barangays.sort((a, b) => a.brgy_name.localeCompare(b.brgy_name));

                        $.each(barangays, function(key, entry) {
                            dropdown.append($('<option></option>')
                                .attr('value', entry.brgy_code)
                                .text(entry.brgy_name));
                        });

                        // Set selected barangay if exists
                        var savedBarangay = $('#barangay-text').val();
                        if (savedBarangay) {
                            dropdown.find('option').each(function() {
                                if ($(this).text() === savedBarangay) {
                                    dropdown.val($(this).val()).trigger('change');
                                    return false;
                                }
                            });
                        }
                    });
                };

                // Update barangay text when selected
                my_handlers.onchange_barangay = function() {
                    var barangay_text = $(this).find("option:selected").text();
                    $('#barangay-text').val(barangay_text);
                };
            });

            function saveAddress() {
                const form = document.getElementById('address-form');
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                // Update text inputs with selected text values
                $('#region-text').val($('#region option:selected').text());
                $('#province-text').val($('#province option:selected').text());
                $('#city-text').val($('#city option:selected').text());
                $('#barangay-text').val($('#barangay option:selected').text());

                const formData = new FormData(form);
                
                // Convert FormData to URLSearchParams for PUT request
                const searchParams = new URLSearchParams();
                for (const pair of formData) {
                    searchParams.append(pair[0], pair[1]);
                }
                
                fetch(form.action, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: searchParams
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            iconColor: '#22c55e',
                            background: '#171717',
                            color: '#fff',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#Ff91a4'
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        throw new Error(data.message || 'Failed to update address');
                    }
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
                        confirmButtonColor: '#Ff91a4'
                    });
                });
            }

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
                            color:'#fff',
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

                // Add click event listener to the submit button
                if (submitButton) {
                    submitButton.onclick = function(e) {
                        e.preventDefault();
                        const ratingValue = select.value;
                        const form = select.closest('form');
                        
                        // Show loading state
                        Swal.fire({
                            title: 'Submitting Rating...',
                            text: 'Please wait while we process your rating',
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
                                    loader.style.borderLeftColor = '#ec4899';
                                }
                            }
                        });

                        // Submit the form
                        fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Content-Type': 'application/x-www-form-urlencoded',
                                'Accept': 'application/json'
                            },
                            body: new URLSearchParams(new FormData(form))
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            const contentType = response.headers.get('content-type');
                            if (contentType && contentType.includes('application/json')) {
                                return response.json();
                            }
                            // If response is not JSON, show success anyway
                            return { success: true };
                        })
                        .then(data => {
                            // Show thank you message
                            Swal.fire({
                                icon: 'success',
                                title: 'Thank You for Your Rating!',
                                text: 'Your feedback helps us improve our products and services.',
                                iconColor: '#22c55e',
                                background: '#171717',
                                color: '#fff',
                                confirmButtonText: 'Continue Shopping',
                                confirmButtonColor: '#Ff91a4',
                                customClass: {
                                    popup: 'rounded-[20px] border border-neutral-800',
                                    confirmButton: 'rounded-xl'
                                }
                            }).then(() => {
                                window.location.reload();
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong while submitting your rating. Please try again.',
                                iconColor: '#ec4899',
                                background: '#171717',
                                color: '#fff',
                                confirmButtonText: 'Try Again',
                                confirmButtonColor: '#Ff91a4',
                                customClass: {
                                    popup: 'rounded-[20px] border border-neutral-800',
                                    confirmButton: 'rounded-xl'
                                }
                            });
                        });
                    };
                }
            }
        </script>
    @endpush
</x-app-layout>
