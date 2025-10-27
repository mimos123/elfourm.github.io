<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    @vite(['resources/css/app.css'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js"></script>
    <style>
        body {
            background-color: #f0f4f8;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Nunito', sans-serif;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .section {
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .section h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .section p {
            margin-bottom: 1.5rem;
            color: #6b7280;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            background-color: #f9fafb;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            border-color: #6366f1;
            outline: none;
        }

        .button {
            padding: 0.75rem 1.5rem;
            background-color: #6366f1;
            color: #ffffff;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .button:hover {
            background-color: #4f46e5;
        }

        .alert {
            padding: 0.75rem 1.5rem;
            background-color: #d1fae5;
            color: #065f46;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
        }

        .flex {
            display: flex;
            gap: 1rem;
        }

        .justify-end {
            justify-content: flex-end;
        }

        .gap-4 {
            gap: 1rem;
        }

        .profile-picture {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .profile-picture img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #d1d5db;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 0.375rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .text-red-500 {
            color: #ef4444;
        }

        .text-green-500 {
            color: #10b981;
        }
    </style>
</head>

<body class="bg-gray-200 flex items-center justify-center min-h-screen">
    <div class="container">
        <!-- Update Profile Information Section -->
        <div class="section">
            <h2>Profile Information</h2>
            <p>Update your account's profile information and email address.</p>
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>
            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                    @error('name')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                    @error('email')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800">
                                Your email address is unverified.
                                <button form="send-verification" class="underline text-sm text-indigo-600 hover:text-indigo-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Click here to re-send the verification email.
                                </button>
                            </p>
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">
                                    A new verification link has been sent to your email address.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="flex justify-end gap-4">
                    <button type="submit" class="button">
                        Save
                    </button>
                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-500">
                            Saved.
                        </p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Update Profile Picture Section -->
        <div class="section">
            <h2>Update Profile Picture</h2>
            <div class="profile-picture">
                <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture">
                @if (session('success'))
                    <div class="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('profile.updatePicture') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="profile_picture">Profile Picture</label>
                        <input type="file" id="profile_picture" name="profile_picture" required>
                    </div>
                    <button type="submit" class="button">
                        Update
                    </button>
                </form>
            </div>
        </div>

        <!-- Update Password Section -->
        <div class="section">
            <h2>Update Password</h2>
            <p>Ensure your account is using a long, random password to stay secure.</p>
            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input id="current_password" name="current_password" type="password" autocomplete="current-password" />
                    @error('current_password')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" />
                    @error('password')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" />
                    @error('password_confirmation')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-end gap-4">
                    <button type="submit" class="button">
                        Save
                    </button>
                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-500">
                            Saved.
                        </p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Delete Account Section -->
        <div class="section" x-data="{ open: false }">
            <h2>Delete Account</h2>
            <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
            <button @click="open = true" class="button bg-red-600 hover:bg-red-700">
                Delete Account
            </button>
            <div x-show="open" class="modal">
                <div class="modal-content">
                    <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                        @csrf
                        @method('delete')
                        <h2 class="text-lg font-medium text-gray-900">
                            Are you sure you want to delete your account?
                        </h2>
                        <p class="text-gray-600">
                            Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                        </p>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input id="password" name="password" type="password" class="mt-1 block w-full" placeholder="Password" />
                            @error('password')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex justify-end gap-4">
                            <button @click="open = false" type="button" class="button bg-gray-600 hover:bg-gray-700">
                                Cancel
                            </button>
                            <button type="submit" class="button bg-red-600 hover:bg-red-700">
                                Delete Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
