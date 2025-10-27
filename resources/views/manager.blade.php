<x-app-layout>
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous">

    <div class="container mx-auto mt-3">

        <div class="bg-white shadow-md rounded-md p-6">
            <div class="mt-6 text-center">
        <a href="{{ route('managers.add') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition duration-300">
            Add New Responsible User
        </a>
    </div>
            @if($managers->isEmpty())
                <div class="text-center py-4">
                    <p class="text-gray-800">No responsible users found.</p>
                </div>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($managers as $manager)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $manager->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $manager->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-4">
                                        <a href="{{ route('edit.manager', $manager->id) }}" class="text-yellow-500 hover:text-yellow-700">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('delete.manager', $manager->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this manager?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</x-app-layout>

<style>
    .container {
        max-width: 1200px;
        padding: 0 15px;
    }

    .bg-white {
        background: #ffffff;
    }

    .shadow-md {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .rounded-md {
        border-radius: 8px;
    }

    .text-gray-800 {
        color: #2d3748;
    }

    .text-gray-600 {
        color: #718096;
    }

    .hover\:text-blue-800:hover {
        color: #2b6cb0;
    }

    .hover\:bg-blue-700:hover {
        background-color: #2b6cb0;
    }

    .text-red-500 {
        color: #f56565;
    }

    .text-red-600 {
        color: #e53e3e;
    }

    .text-yellow-500 {
        color: #ecc94b;
    }

    .hover\:text-red-700:hover {
        color: #c53030;
    }

    .hover\:text-yellow-700:hover {
        color: #d69e2e;
    }

    .hover\:bg-blue-700:hover {
        background-color: #2b6cb0;
    }
</style>
