<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Name') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-user text-gray-400" aria-hidden="true"></i>
                </div>
                <input 
                    id="name" 
                    name="name" 
                    type="text" 
                    class="block w-full pl-10 pr-4 py-3 text-base border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm @error('name') border-red-300 @enderror" 
                    value="{{ old('name', $user->name) }}" 
                    required 
                    autofocus 
                    autocomplete="name"
                    placeholder="{{ __('Enter your name') }}"
                >
            </div>
            @error('name')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1" aria-hidden="true"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Email') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400" aria-hidden="true"></i>
                </div>
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    class="block w-full pl-10 pr-4 py-3 text-base border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm @error('email') border-red-300 @enderror" 
                    value="{{ old('email', $user->email) }}" 
                    required 
                    autocomplete="username"
                    placeholder="{{ __('Enter your email address') }}"
                >
            </div>
            @error('email')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1" aria-hidden="true"></i>
                    {{ $message }}
                </p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-yellow-600 mt-0.5 mr-2" aria-hidden="true"></i>
                        <div class="flex-1">
                            <p class="text-sm text-gray-800">
                                {{ __('Your email address is unverified.') }}
                            </p>
                            <button 
                                form="send-verification" 
                                class="mt-2 inline-flex items-center text-sm text-indigo-600 hover:text-indigo-800 font-medium underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition"
                            >
                                <i class="fas fa-paper-plane mr-1" aria-hidden="true"></i>
                                {{ __('Click here to re-send the verification email.') }}
                            </button>

                            @if (session('status') === 'verification-link-sent')
                                <p 
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 5000)"
                                    class="mt-2 text-sm text-green-600 flex items-center font-medium"
                                >
                                    <i class="fas fa-check-circle mr-1" aria-hidden="true"></i>
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button 
                type="submit" 
                class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                <i class="fas fa-save mr-2" aria-hidden="true"></i>
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
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
                    {{ __('Profile updated successfully!') }}
                </p>
            @endif
        </div>
    </form>
</section>