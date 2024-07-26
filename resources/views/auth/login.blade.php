<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <!-- Optional: Include logo here if needed -->
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                <input id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                <input id="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center mb-4">
                <input id="remember_me" name="remember" type="checkbox" class="mr-2" />
                <label for="remember_me" class="text-sm text-gray-600">{{ __('Remember me') }}</label>
            </div>

                <x-jet-button>
                {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>

        <!-- Sign Up Link -->
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">{{ __('Don\'t have an account?') }}</p>
            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-black bg-blue-500 hover:bg-blue-600">
                {{ __('Sign Up') }}
            </a>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
