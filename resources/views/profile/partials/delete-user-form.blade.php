<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
        aria-label="{{ __('Open delete account confirmation dialog') }}"
    >
        <i class="fas fa-trash-alt mr-2" aria-hidden="true"></i>
        {{ __('Delete Account') }}
    </button>

    <!-- Modal Backdrop -->
    <div 
        x-data="{ 
            show: {{ $errors->userDeletion->isNotEmpty() ? 'true' : 'false' }},
            passwordInput: null
        }" 
        x-show="show" 
        x-on:open-modal.window="$event.detail === 'confirm-user-deletion' ? (show = true, setTimeout(() => $refs.passwordInput?.focus(), 100)) : null"
        x-on:close-modal.window="show = false"
        x-on:keydown.escape.window="show = false"
        x-cloak
        class="fixed inset-0 z-50 overflow-y-auto"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true"
    >
        <!-- Backdrop overlay -->
        <div 
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
            x-on:click="show = false"
            aria-hidden="true"
        ></div>

        <!-- Modal content -->
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div 
                x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
                x-on:click.away="show = false"
            >
                <form method="post" action="{{ route('profile.destroy') }}" class="bg-white">
                    @csrf
                    @method('delete')

                    <!-- Warning Icon Header -->
                    <div class="bg-red-50 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-exclamation-triangle text-red-600" aria-hidden="true"></i>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left flex-1">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">
                                    {{ __('Are you sure you want to delete your account?') }}
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-600">
                                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Content -->
                    <div class="px-4 pb-4 sm:px-6 sm:pb-6">
                        <div class="mt-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Password') }}
                            </label>

                            <input
                                x-ref="passwordInput"
                                id="password"
                                name="password"
                                type="password"
                                class="block w-full px-4 py-3 text-base border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-lg shadow-sm @error('password', 'userDeletion') border-red-300 @enderror"
                                placeholder="{{ __('Enter your password') }}"
                                required
                                autocomplete="current-password"
                            >

                            @error('password', 'userDeletion')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1" aria-hidden="true"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-3">
                        <button 
                            type="submit" 
                            class="inline-flex w-full justify-center items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 sm:w-auto"
                        >
                            <i class="fas fa-trash-alt mr-2" aria-hidden="true"></i>
                            {{ __('Delete Account') }}
                        </button>

                        <button 
                            type="button" 
                            x-on:click="show = false" 
                            class="mt-3 inline-flex w-full justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 sm:mt-0 sm:w-auto"
                        >
                            {{ __('Cancel') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</section>