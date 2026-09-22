<x-guest-layout>

    <h2>Forgot Password</h2>
    <p class="sub">No problem — we'll email you a reset link.</p>

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Enter your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-primary-button class="w-full">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>

    <div class="pd-auth-footer">
        Remembered it? <a href="{{ route('login') }}">Back to Log in</a>
    </div>

</x-guest-layout>