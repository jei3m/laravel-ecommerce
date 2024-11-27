<section class="w-full">
    <header>
        <h2 class="text-xl font-semibold text-white mb-2">
            {{ __('Profile Information') }}
        </h2>

        <p class="text-gray-300 text-sm mb-6">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-white" />
            <x-text-input 
                id="name" 
                name="name" 
                type="text" 
                class="mt-1 block w-full px-4 py-2 bg-neutral-800 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-spink transition-colors" 
                :value="old('name', $user->name)" 
                required 
                autofocus 
                autocomplete="name" 
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input 
                id="email" 
                name="email" 
                type="email" 
                class="mt-1 block w-full px-4 py-2 bg-neutral-800 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-spink transition-colors" 
                :value="old('email', $user->email)" 
                required 
                autocomplete="username" 
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-white">
                        {{ __('Your email address is unverified.') }}

                        <button 
                            form="send-verification" 
                            class="underline text-sm text-spink hover:text-pink-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-spink"
                        >
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex justify-end gap-4">
            <button type="submit" class="px-4 py-2 bg-spink text-white font-semibold rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition-colors">
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                @push('scripts')
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Profile Updated',
                        text: 'Your profile has been saved successfully',
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true,
                        background: '#171717',
                        color: '#fff',
                        customClass: {
                            popup: 'rounded-[20px] border border-neutral-700',
                            title: 'text-spink font-bold',
                            timerProgressBar: 'bg-spink',
                            htmlContainer: 'text-gray-300'
                        }
                    });
                </script>
                @endpush
            @endif
        </div>
    </form>
</section>
