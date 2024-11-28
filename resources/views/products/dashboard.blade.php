<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Dashboard') }}
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
                            <h1 class="text-2xl font-bold text-white">Product Dashboard</h1>
                            <p class="text-gray-400">Manage your products inventory</p>
                        </div>
                        <a href="{{ route('products.create') }}" class="bg-spink text-white px-6 py-3 rounded-full inline-flex items-center">
                            <i class="fas fa-plus-circle mr-2"></i>Add New Product
                        </a>
                    </div>

                    <!-- Products Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left">
                                    <th class="px-6 py-3 bg-neutral-800 text-gray-400 rounded-l-xl">Product Name</th>
                                    <th class="px-6 py-3 bg-neutral-800 text-gray-400">Category</th>
                                    <th class="px-6 py-3 bg-neutral-800 text-gray-400">Price</th>
                                    <th class="px-6 py-3 bg-neutral-800 text-gray-400">Stock</th>
                                    <th class="px-6 py-3 bg-neutral-800 text-gray-400">Sales</th>
                                    <th class="px-6 py-3 bg-neutral-800 text-gray-400 rounded-r-xl text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-800">
                                @foreach($products as $product)
                                <tr class="group transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 rounded-lg overflow-hidden">
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                            </div>
                                            <span class="text-white font-medium">{{ $product->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center bg-opacity-20 bg-spink px-3 py-1 rounded-lg">
                                            <span class="text-sm font-medium text-spink">{{ $product->category }}</span>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-white">${{ number_format($product->price, 2) }}</td>
                                    <td class="px-6 py-4 text-white">{{ $product->stock }}</td>
                                    <td class="px-6 py-4 text-white">{{ $product->sold }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-end space-x-5">
                                            <a href="{{ route('products.edit', $product) }}" class="text-gray-400 hover:text-white transition-colors">
                                                <i class="fas fa-edit text-lg"></i>
                                            </a>
                                            <a href="{{ route('products.show', $product) }}" class="text-gray-400 hover:text-white transition-colors">
                                                <i class="fas fa-eye text-lg"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" id="delete-form-{{ $product->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="text-gray-400 hover:text-red-500 transition-colors" 
                                                        onclick="confirmDelete({{ $product->id }})">
                                                    <i class="fas fa-trash text-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDelete(productId) {
            Swal.fire({
                title: 'Delete Product',
                text: "This action cannot be undone",
                icon: 'warning',
                iconColor: '#Ff91a4',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#ef4444',
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
                    document.getElementById('delete-form-' + productId).submit();
                }
            })
        }
    </script>
    @endpush
</x-app-layout>