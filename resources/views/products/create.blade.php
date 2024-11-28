@extends('layouts.app')

@section('content')
<div class="p-10">
<div class="container mx-auto pt-10 p-2 lg:p-0">
    <div class="bg-neutral-800 rounded-[30px] p-8">
        <div class="w-auto mx-auto">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-white">Create New Product</h1>
                <a href="{{ route('profile') }}" class="text-spink font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Profile
                </a>
            </div>

            @if ($errors->any())
                <div class="bg-red-900/50 border border-red-500 text-red-200 px-6 py-4 rounded-[20px] mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="space-y-6">
                    <div class="bg-neutral-700/50 rounded-[20px] p-6">
                        <label class="block text-gray-200 text-sm font-semibold mb-3" for="name">
                            Product Name
                        </label>
                        <input class="w-full bg-neutral-800 border border-neutral-600 text-white rounded-xl py-3 px-4 focus:outline-none @error('name') border-red-500 @enderror"
                            id="name"
                            type="text"
                            name="name"
                            onkeypress="return allowOnlyLetters(event)"
                            oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"
                            onpaste="return false"
                            value="{{ old('name') }}"
                            required>
                    </div>

                    <div class="bg-neutral-700/50 rounded-[20px] p-6">
                        <label class="block text-gray-200 text-sm font-semibold mb-3" for="category">
                            Category
                        </label>
                        <select class="w-full bg-neutral-800 border border-neutral-600 text-white rounded-xl py-3 px-4 focus:outline-none @error('category') border-red-500 @enderror"
                            id="category"
                            name="category"
                            required>
                            <option value="">Select a category</option>
                            <option value="Electronics" {{ old('category') == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                            <option value="Mobile" {{ old('category') == 'Mobile' ? 'selected' : '' }}>Mobile</option>
                            <option value="Audio" {{ old('category') == 'Audio' ? 'selected' : '' }}>Audio</option>
                            <option value="Gaming" {{ old('category') == 'Gaming' ? 'selected' : '' }}>Gaming</option>
                            <option value="Accessories" {{ old('category') == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-neutral-700/50 rounded-[20px] p-6">
                            <label class="block text-gray-200 text-sm font-semibold mb-3" for="price">
                                Price
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-3 text-gray-400">$</span>
                                <input class="w-full bg-neutral-800 border border-neutral-600 text-white rounded-xl py-3 pl-8 pr-4 focus:outline-none @error('price') border-red-500 @enderror"
                                    id="price"
                                    type="number"
                                    name="price"
                                    value="{{ old('price') }}"
                                    required>
                            </div>
                        </div>

                        <div class="bg-neutral-700/50 rounded-[20px] p-6">
                            <label class="block text-gray-200 text-sm font-semibold mb-3" for="stock">
                                Stock
                            </label>
                            <input class="w-full bg-neutral-800 border border-neutral-600 text-white rounded-xl py-3 px-4 focus:outline-none @error('stock') border-red-500 @enderror"
                                id="stock"
                                type="number"
                                name="stock"
                                step="1"
                                value="{{ old('stock') }}"
                                required>
                        </div>
                    </div>

                    <div class="bg-neutral-700/50 rounded-[20px] p-6">
                        <label class="block text-gray-200 text-sm font-semibold mb-3" for="description">
                            Description
                        </label>
                        <textarea class="w-full bg-neutral-800 border border-neutral-600 text-white rounded-xl py-3 px-4 focus:outline-none @error('description') border-red-500 @enderror"
                            id="description"
                            name="description"
                            rows="4"
                            required>{{ old('description') }}</textarea>
                    </div>

                    <div class="bg-neutral-700/50 rounded-[20px] p-6">
                        <label class="block text-gray-200 text-sm font-semibold mb-3" for="image">
                            Product Image
                        </label>
                        <div class="relative">
                            <input class="w-full bg-neutral-800 border border-neutral-600 text-white rounded-xl py-3 px-4 focus:outline-none @error('image') border-red-500 @enderror"
                                id="image"
                                type="file"
                                name="image"
                                accept="image/*">
                        </div>
                        <p class="ml-1 mt-1 text-sm text-gray-400">Recommended: Square Image</p>
                    </div>

                    <div class="flex justify-end pt-6">
                        <button class="bg-spink text-white font-bold py-4 px-8 rounded-full focus:outline-none focus:shadow-outline" type="submit">
                            <i class="fas fa-plus-circle mr-2"></i>Create Product
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
    function allowOnlyLetters(event) {
        const charCode = event.which || event.keyCode;
        // Allow only letters and space
        if (!((charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122) || charCode === 32)) {
            event.preventDefault();
            return false;
        }
        return true;
    }

    // Additional validation on the input field
    document.getElementById('name').addEventListener('keydown', function(e) {
        // Prevent numbers even if they're held down
        if (e.key >= '0' && e.key <= '9') {
            e.preventDefault();
            return false;
        }
    });
</script>
@endpush
