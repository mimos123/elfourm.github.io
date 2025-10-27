<x-app-layout>
    <div class="flex justify-center items-center min-h-screen">
        <div class="apply-form bg-white p-6 rounded-lg shadow-md w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center">Apply for Post</h1>
            <form action="{{ route('post.apply.submit', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Username Field -->
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username', Auth::user()->name) }}" class="w-full px-3 py-2 border rounded" >
                    @error('username')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full px-3 py-2 border rounded" >
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone Number Field -->
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 font-bold mb-2">Phone Number</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="w-full px-3 py-2 border rounded" >
                    @error('phone')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- CV Upload Field -->
                <div class="mb-4">
                    <label for="cv" class="block text-gray-700 font-bold mb-2">Upload CV (PDF)</label>
                    <input type="file" id="cv" name="cv" accept="application/pdf" class="w-full px-3 py-2 border rounded" >
                    @error('cv')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit and Cancel Buttons -->
                <div class="flex justify-between m-9">
                    <button type="submit" class="bg-green-500 text-white py-2 px-4 ml-9 rounded hover:bg-green-600">
                        Apply
                    </button>
                    <a href="{{ route('events.feed', ['event' => $post->jpo_id]) }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <style>
        .apply-form h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .apply-form .form-group {
            margin-bottom: 15px;
        }

        .apply-form .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .apply-form .form-group input,
        .apply-form .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .apply-form .form-group input[type="file"] {
            padding: 3px;
        }

        .apply-form button {
            width: 60%;
            padding: 10px;
            background: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .apply-form button:hover {
            background: #218838;
        }

        .apply-form .cancel-button {
            width: 60%;
            padding: 10px;
            background: #6c757d;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }

        .apply-form .cancel-button:hover {
            background: #5a6268;
        }
    </style>
</x-app-layout>
