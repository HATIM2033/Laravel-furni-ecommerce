<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Current Password') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400" aria-hidden="true"></i>
                </div>
                <input 
                    id="update_password_current_password" 
                    name="current_password" 
                    type="password" 
                    class="block w-full pl-10 pr-4 py-3 text-base border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm @error('current_password', 'updatePassword') border-red-300 @enderror" 
                    autocomplete="current-password"
                    placeholder="{{ __('Enter current password') }}"
                    required
                >
            </div>
            @error('current_password', 'updatePassword')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1" aria-hidden="true"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('New Password') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-key text-gray-400" aria-hidden="true"></i>
                </div>
                <input 
                    id="update_password_password" 
                    name="password" 
                    type="password" 
                    class="block w-full pl-10 pr-4 py-3 text-base border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm @error('password', 'updatePassword') border-red-300 @enderror" 
                    autocomplete="new-password"
                    placeholder="{{ __('Enter new password') }}"
                    required
                >
            </div>
            @error('password', 'updatePassword')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1" aria-hidden="true"></i>
                    {{ $message }}
                </p>
            @enderror
            <p class="mt-1 text-xs text-gray-500">
                {{ __('Use at least 8 characters with a mix of letters, numbers and symbols.') }}
            </p>
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Confirm Password') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-check-circle text-gray-400" aria-hidden="true"></i>
                </div>
                <input 
                    id="update_password_password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    class="block w-full pl-10 pr-4 py-3 text-base border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm @error('password_confirmation', 'updatePassword') border-red-300 @enderror" 
                    autocomplete="new-password"
                    placeholder="{{ __('Confirm new password') }}"
                    required
                >
            </div>
            @error('password_confirmation', 'updatePassword')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1" aria-hidden="true"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button 
                type="submit" 
                class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                <i class="fas fa-save mr-2" aria-hidden="true"></i>
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-green-600 flex items-center font-medium"
                >
                    <i class="fas fa-check-circle mr-1" aria-hidden="true"></i>
                    {{ __('Password updated successfully!') }}
                </p>
            @endif
        </div>
    </form>
</section>