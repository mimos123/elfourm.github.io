<x-app-layout>
    <div class="container mx-auto mt-3">
        <div class="bg-white shadow-md rounded-md p-4">
            <h2 class="text-2xl font-semibold mb-4">Edit Manager</h2>
            <form action="{{ route('update.manager', $manager->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ $manager->name }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ $manager->email }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Manager</button>
                    <a href="{{ route('managers.index') }}" class="inline-block bg-gray-300 text-gray-700 px-4 py-2 rounded-md ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
