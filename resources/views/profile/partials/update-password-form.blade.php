<section>
    <header>
        <h2 class="text-xl font-semibold text-white mb-2">
            Update Password
        </h2>

        <p class="text-gray-300 text-sm mb-6">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" value="Current Password" class="text-white" />
            <x-text-input 
                id="current_password" 
                name="current_password" 
                type="password" 
                class="mt-1 block w-full px-4 py-2 bg-neutral-800 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-spink transition-colors" 
                autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="New Password" class="text-white" />
            <x-text-input 
                id="password" 
                name="password" 
                type="password" 
                class="mt-1 block w-full px-4 py-2 bg-neutral-800 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-spink transition-colors" 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Confirm Password" class="text-white" />
            <x-text-input 
                id="password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="mt-1 block w-full px-4 py-2 bg-neutral-800 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-spink transition-colors" 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-4 py-2 bg-spink text-white font-semibold rounded-xl hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition-colors">
                Save
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-300"
                >
                    Saved.
                </p>
            @endif
        </div>
    </form>
</section>
