<x-app-layout>
    <div class="container mx-auto mt-8">
        <div class="max-w-2xl mx-auto">
            <h2 class="text-2xl font-semibold mb-4">Create a New Post</h2>
            <form action="{{ route('post.store', ['event' => $event->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="jpo_id" value="{{ $event->id }}">

                <div class="mb-4">
                    <label for="content" class="block text-gray-700 font-medium">Content</label>
                    <textarea name="content" id="content" rows="4" class="form-textarea mt-1 block w-full border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required></textarea>
                </div>
                @error('content')
                <span class="text-red-500">{{ $message }}</span>
                @enderror

                <div class="mb-4">
                    <label for="type" class="block text-gray-700 font-medium">Type</label>
                    <select name="type" id="type" class="form-select mt-1 block w-full border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        <option value="normal">Normal</option>
                        <option value="offer">Offer</option>
                    </select>
                </div>
                @error('type')
                <span class="text-red-500">{{ $message }}</span>
                @enderror

                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-medium">Image</label>
                    <input type="file" name="image" id="image" class="form-input mt-1 block w-full border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                </div>
                @error('image')
                <span class="text-red-500">{{ $message }}</span>
                @enderror

                <div class="mt-6">
                    <button type="submit" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Create Post</button>
                    <a href="{{ url()->previous() }}" class="inline-block bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
