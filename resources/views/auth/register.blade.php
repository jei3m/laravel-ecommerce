<x-guest-layout>
    <div class="w-full max-w-2xl p-8 bg-neutral-800 rounded-[30px]">
        <div class="bg-neutral-900 rounded-[20px] p-6">
            <!-- Logo/Title -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-spink flex items-center justify-center gap-3">
                    <i class="fas fa-shopping-bag text-4xl"></i>
                    E-COMMERCE
                </h1>
                <p class="text-gray-400 mt-2">Create your account to get started.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" id="register-form">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-400 mb-1">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-4 py-2 bg-neutral-800 border border-neutral-700 text-white rounded-xl focus:outline-none focus:border-spink transition-colors"
                        autocomplete="name">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-400 mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2 bg-neutral-800 border border-neutral-700 text-white rounded-xl focus:outline-none focus:border-spink transition-colors"
                        autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-400 mb-1">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-2 bg-neutral-800 border border-neutral-700 text-white rounded-xl focus:outline-none focus:border-spink transition-colors"
                        autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-400 mb-1">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full px-4 py-2 bg-neutral-800 border border-neutral-700 text-white rounded-xl focus:outline-none focus:border-spink transition-colors"
                        autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex flex-col space-y-3">
                    <!-- Register Button -->
                    <button type="submit" class="w-full py-2 px-4 bg-spink text-white font-semibold rounded-xl">
                        Create Account
                    </button>

                    <!-- Login Link -->
                    <a href="{{ route('login') }}" class="w-full py-2 px-4 bg-neutral-700 text-white font-semibold rounded-xl hover:bg-neutral-600 text-center transition-colors">
                        Back to Login
                    </a>

                    <p class="text-sm text-gray-400 text-center">
                        By registering, you agree to our Terms of Service and Privacy Policy
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
