<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Company</title>
    @vite(['resources/css/app.css'])
    <style>
        .background-pattern {
            background-image: url('{{ asset('backgroundcompany.png') }}');
            background-position: top center;
            background-repeat: no-repeat;
            background-size: 650px 270px; /* Set the desired width and height */
        }
    </style>
</head>

<body class="bg-gray-200 flex items-center justify-center min-h-screen ">
    <div class="shadow-lg overflow-hidden bg-white flex background-pattern" style="width: 850px; height: 550px;">
        <!-- Left Section -->
        <div class="flex flex-col justify-center items-center p-4 w-1/2">
            <img src="{{ asset('logocompany.png') }}" alt="Logo" class="mb-4">
        </div>

        <!-- Right Section -->
        <div class="flex-auto p-6">
            <div class="max-w-md w-full mt-12">
                <h2 class="text-2xl font-inter font-extrabold text-gray-900 mb-6">Add Company</h2>

                <form method="POST" action="{{ route('company.add.submit') }}">
                    @csrf

                    <!-- Name -->
                    <div class="space-y-3">
                        <label for="name" class="block text-sm font-medium text-gray-700">Enter name</label>
                        <input id="name" class="block mt-1 w-full bg-gray-100 border border-gray-300 rounded-md py-1 px-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                        @error('name')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="space-y-3 mt-3">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" class="block mt-1 w-full bg-gray-100 border border-gray-300 rounded-md py-1 px-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                        @error('email')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-3 mt-3">
                        <label for="password" class="block text-sm font-medium text-gray-700">Create password</label>
                        <input id="password" class="block mt-1 w-full bg-gray-100 border border-gray-300 rounded-md py-1 px-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm" type="password" name="password" required autocomplete="new-password" />
                        @error('password')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-3 mt-3">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm password</label>
                        <input id="password_confirmation" class="block mt-1 w-full bg-gray-100 border border-gray-300 rounded-md py-1 px-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm" type="password" name="password_confirmation" required autocomplete="new-password" />
                        @error('password_confirmation')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="terms" class="inline-flex items-center text-sm">
                            <input id="terms" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" required>
                            <span class="ml-2 text-gray-700">
                                I acknowledge that I have read and agree with the <a href="#" class="text-indigo-600 hover:underline">Terms of use</a>
                            </span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between mt-4 space-x-3">
                        <button type="submit" class="w-full py-1.5 px-3 bg-indigo-600 text-white font-bold rounded-md text-sm hover:bg-indigo-700">
                            Add Company
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
