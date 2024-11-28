<x-guest-layout>
    <div class="w-full max-w-2xl p-8 bg-neutral-800 rounded-[30px]">
        <div class="bg-neutral-900 rounded-[20px] p-6">
            <!-- Logo/Title -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-spink flex items-center justify-center gap-3">
                    <i class="fas fa-shopping-bag text-4xl"></i>
                    E-COMMERCE
                </h1>
                <p class="text-gray-400 mt-2">Welcome back! Please login to continue.</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" id="login-form">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-400 mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2 bg-neutral-800 border border-neutral-700 text-white rounded-xl focus:outline-none focus:border-spink transition-colors"
                        autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-400 mb-1">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-2 bg-neutral-800 border border-neutral-700 text-white rounded-xl focus:outline-none focus:border-spink transition-colors"
                        autocomplete="current-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="rounded-md border-neutral-700 bg-neutral-800 text-spink focus:ring-spink">
                        <span class="ms-2 text-sm text-gray-400">Remember me</span>
                    </label>
                </div>

                <div class="flex flex-col space-y-3">
                    <!-- Login Button -->
                    <button type="submit" class="w-full py-2 px-4 bg-spink text-white font-semibold rounded-xl hover:bg-pink-600 transition-colors">
                        Login
                    </button>

                    <!-- Register Button -->
                    <a href="{{ route('register') }}" class="w-full py-2 px-4 bg-neutral-700 text-white font-semibold rounded-xl hover:bg-neutral-600 text-center transition-colors">
                        Register
                    </a>

                    <!-- Forgot Password -->
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-400 hover:text-spink text-center transition-colors" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>