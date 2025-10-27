<x-app-layout>
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous">

    <div class="w-full bg-gray-100">
        <main class="flex w-full">
            <!-- Main content area -->
            <div class="flex-1 relative">
                <!-- Header -->
<div class="absolute top-0 left-0 right-0 z-50 bg-white py-2 px-4 shadow-md flex justify-between items-center">
    <h1 class="text-xl font-bold">Feed for: {{ $event->name }}</h1>
    @if (auth()->user()->role !== 'user')
        <a href="{{ route('post.create', ['event' => $event->id]) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out">
            Create Post
        </a>
    @endif
</div>

                <!-- Posts Section -->
                <div class="pt-16 overflow-auto" style="height: calc(100vh - 4rem);">
                    @if ($posts->isEmpty())
                        <p class="text-center mt-4">No posts found.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
                            @foreach ($posts as $post)
                                <div class="post-container bg-white p-4 rounded-lg shadow-lg">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center">
                                            <img src="{{ Storage::url($post->user->profile_picture) }}" alt="Profile Picture" class="w-10 h-10 rounded-full mr-4">
                                            <p class="text-gray-800 text-sm font-bold">{{ $post->user->name }}</p>
                                        </div>
                                        @if (auth()->user()->id === $post->user_id || auth()->user()->role !== 'user')
                                            <div class="flex space-x-2">
                                                <a href="{{ route('post.edit', ['post' => $post->id]) }}" class="text-yellow-500 hover:text-yellow-700">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('post.destroy', ['post' => $post->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="text-gray-800 text-sm">{{ $post->content }}</p>
                                    @if ($post->image)
                                        <div class="mt-2">
                                            <img src="{{ Storage::url($post->image) }}" alt="Post Image" class="post-image">
                                        </div>
                                    @else
                                        <div class="mt-2 bg-cover bg-center rounded h-48 flex items-center justify-center text-white" style="background-image: url('{{ Storage::url($post->user->profile_picture) }}'); filter: blur(8px);">
                                            <span class="text-lg font-bold">No Image</span>
                                        </div>
                                    @endif
                                    @if(Auth::user()->role === "user")
                                    @if ($post->type == 'offer')
                                        <a href="{{ route('post.apply', ['post' => $post->id]) }}" class="apply-button mt-2 inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
                                            Apply
                                        </a>
                                    @endif
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</x-app-layout>

<style>
    .post-container {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: left;
    }

    .post-image {
        width: 100%;
        height: 200px; /* Set a fixed height */
        object-fit: cover; /* Maintain aspect ratio and cover the container */
        border-radius: 8px; /* Optional: add rounded corners to images */
    }

    .apply-button, .edit-button, .delete-button {
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s;
    }

    .apply-button {
        background: #28a745;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
    }

    .apply-button:hover {
        background: #218838;
    }

    .owner-info img {
        border-radius: 50%;
    }
</style>
