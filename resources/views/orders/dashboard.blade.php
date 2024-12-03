<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders Dashboard') }}
        </h2>
    </x-slot>

    <x-header/>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-neutral-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h1 class="text-2xl font-bold text-white">Orders Dashboard</h1>
                            <p class="text-gray-400">Manage customer orders and order status</p>
                        </div>
                        <div class="relative hidden md:block max-w-xs">
                            <form action="{{ route('orders.search') }}" method="GET" class="relative flex items-center px-2 py-1 rounded-full">
                                <i class="fas fa-search absolute left-5 text-gray-400"></i>
                                <input type="text" name="query" placeholder="Search orders..." class="w-full py-2 pl-9 pr-4 bg-transparent text-white rounded-full focus:outline-none" value="{{ request('query') }}">
                            </form>
                        </div>
                    </div>

                    <!-- Orders Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left">
                                    <th class="px-6 py-3 bg-neutral-800 text-gray-400 rounded-l-xl">Order ID</th>
                                    <th class="px-6 py-3 bg-neutral-800 text-gray-400">Customer</th>
                                    <th class="px-6 py-3 bg-neutral-800 text-gray-400">Total Amount</th>
                                    <th class="px-6 py-3 bg-neutral-800 text-gray-400">Payment Method</th>
                                    <th class="px-6 py-3 bg-neutral-800 text-gray-400">Payment Status</th>
                                    <th class="px-6 py-3 bg-neutral-800 text-gray-400">Order Status</th>
                                    <th class="px-6 py-3 bg-neutral-800 text-gray-400 rounded-r-xl">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-800">
                                @foreach($orders as $order)
                                <tr class="group transition-colors">
                                    <td class="px-6 py-4 text-white">#{{ $order->id }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-full bg-neutral-800 flex items-center justify-center">
                                                <i class="fas fa-user text-spink"></i>
                                            </div>
                                            <span class="text-white">{{ $order->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-white">${{ number_format($order->total_amount, 2) }}</td>
                                    <td class="px-6 py-4">
                                        <span class="text-white">{{ strtoupper($order->payment_method) }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg justify-center min-w-[100px]
                                            @if($order->payment_status === 'pending') bg-yellow-500/20 text-yellow-500
                                            @elseif($order->payment_status === 'completed') bg-green-500/20 text-green-500
                                            @elseif($order->payment_status === 'cancelled') bg-red-500/20 text-red-500
                                            @endif">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <select 
                                            onchange="updateOrderStatus({{ $order->id }}, this.value)"
                                            class="bg-neutral-800 text-white px-3 py-1 rounded-lg border border-neutral-700 focus:outline-none focus:border-spink"
                                        >
                                            <option value="pending" {{ $order->order_status === 'pending' ? 'selected' : '' }} 
                                                class="text-yellow-500">Pending</option>
                                            <option value="completed" {{ $order->order_status === 'completed' ? 'selected' : '' }}
                                                class="text-green-500">Completed</option>
                                            <option value="cancelled" {{ $order->order_status === 'cancelled' ? 'selected' : '' }}
                                                class="text-red-500">Cancelled</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 text-gray-400">
                                        {{ $order->created_at->format('M d, Y H:i') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $orders->links('components.custom-pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function updateOrderStatus(orderId, status) {
            Swal.fire({
                title: 'Update Order Status',
                text: "Are you sure you want to update the order status?",
                icon: 'warning',
                iconColor: '#Ff91a4',
                showCancelButton: true,
                confirmButtonText: 'Update',
                cancelButtonText: 'Cancel',
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
                    // Show loading state
                    Swal.fire({
                        title: 'Updating...',
                        background: '#171717',
                        color:'#fff',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Send update request
                    fetch(`/orders/${orderId}/update-status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ order_status: status })
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Order status updated successfully',
                            iconColor: '#22c55e',
                            background: '#171717',
                            color:'#fff',
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
                            title: 'Error',
                            text: 'Failed to update order status',
                            iconColor: '#ef4444',
                            background: '#171717',
                            color:'#fff',
                            confirmButtonColor: '#Ff91a4',
                            customClass: {
                                popup: 'rounded-[20px] border border-neutral-800',
                                confirmButton: 'rounded-xl'
                            }
                        });
                    });
                }
            });
        }

        function viewOrderDetails(orderId) {
            window.location.href = `/orders/${orderId}`;
        }
    </script>
    @endpush
</x-app-layout>