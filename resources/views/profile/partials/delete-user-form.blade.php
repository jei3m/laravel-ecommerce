<section class="space-y-6">
    <header>
        <h2 class="text-xl font-semibold text-white mb-2">
            Delete Account
        </h2>

        <p class="text-gray-300 text-sm mb-6">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </header>

    <div class="flex justify-start">
        <button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="px-4 py-2 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors"
        >
            Delete Account
        </button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-neutral-900 w-full">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-white mb-4">
                Are you sure you want to delete your account?
            </h2>

            <p class="text-white text-sm mb-6">
                Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Password" class="text-white" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full px-4 py-2 bg-neutral-800 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-spink transition-colors"
                    placeholder="Password"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-4">
                <button 
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="px-4 py-2 bg-neutral-800 text-white font-semibold rounded-xl hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-neutral-600 focus:ring-offset-2 transition-colors"
                >
                    Cancel
                </button>

                <button 
                    type="submit"
                    class="px-4 py-2 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors"
                >
                    Delete Account
                </button>
            </div>
        </form>
    </x-modal>
</section>
