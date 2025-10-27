<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-200 flex items-center justify-center min-h-screen">
    <div class="shadow-lg overflow-hidden bg-white" style="width: 850px; height: 550px;">
        <div class="flex h-full">
            <!-- Blue Section -->
            <div class="bg-blue-800 text-white flex flex-col justify-center items-center p-4 w-1/2">
                <img src="{{ asset('logoform.png') }}" alt="Logo" class="mb-4">
            </div>

            <!-- Form Section -->
<div class="flex-auto p-6" style="background-image: url('{{ asset('background.png') }}'); background-position: top left; background-repeat: no-repeat; background-size: 300px 298px;">

            <div class="max-w-md w-full mt-12">
                    <h2 class="text-4xl font-inter font-extrabold text-gray-900 mb-6">Welcome Back</h2>
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email Address -->
                        <div class="space-y-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="space-y-4 mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ml-2 text-sm text-gray-700">{{ __('Keep me Logged in') }}</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>

                        <x-primary-button class="w-full mt-4">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </form>

                    <p class="mt-4 text-sm text-center">
                        Don't have an account? <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
