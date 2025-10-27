{{-- resources/views/posts/edit.blade.php --}}

<x-app-layout>
    <div class="w-full bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
            <h1 class="text-2xl font-bold mb-4">Edit Post</h1>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="content" class="block text-gray-700 font-bold mb-2">Content</label>
                    <textarea name="content" id="content" rows="5" class="w-full p-2 border rounded-lg @error('content') border-red-500 @enderror" required>{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Post Image</label>
                    @if ($post->image)
                        <div class="mb-4">
                            <img src="{{ Storage::url($post->image) }}" alt="Post Image" class="rounded mb-2">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" class="w-full p-2 border rounded-lg @error('image') border-red-500 @enderror">
                    @error('image')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out">
                        Update Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
