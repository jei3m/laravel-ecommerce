<x-app-layout>
    <x-header />
    
    <div class="container mx-auto p-2 lg:p-12">
        <div class="bg-neutral-800 rounded-[30px] p-8">
            <div class="bg-neutral-900 rounded-[20px] p-6">
                <div class="flex items-center space-x-4 mb-8">
                    <div class="w-16 h-16 rounded-full bg-neutral-800 flex items-center justify-center">
                        <i class="fas fa-user text-2xl text-spink"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Edit Profile</h1>
                        <p class="text-gray-400">Update your account settings and preferences</p>
                    </div>
                </div>

                <div class="space-y-8">
                    <!-- Profile Information -->
                    <div class="border-b border-neutral-700 pb-8">
                        <div class="w-full">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="border-b border-neutral-700 pb-8">
                        <div class="w-full">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div class="pb-8">
                        <div class="w-full">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Add any necessary JavaScript here
    </script>
    @endpush
</x-app-layout>
