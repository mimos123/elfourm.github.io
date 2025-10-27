<x-app-layout>
    <div class="mt-3">
        <h1 class="text-2xl font-bold mb-4">All Applications for My Offers</h1>

        @if(session('success'))
            <div id="flash-message" class="flash-message success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div id="flash-message" class="flash-message error">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-md p-4">
            <div class="applications-container"> <!-- Set fixed height and enable vertical scrolling -->
                <table class=" divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CV</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($applications as $application)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $application->username }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $application->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $application->phone }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('application.downloadCv', $application->id) }}" class="text-blue-600 hover:text-blue-800">Download CV</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ ucfirst($application->status) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($application->status !== 'Up For Interview' && $application->status !== 'rejected')
                                        <form action="{{ route('application.accept', $application->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-800">Accept</button>
                                        </form>
                                        <form action="{{ route('application.reject', $application->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-red-600 hover:text-red-800">Reject</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                setTimeout(() => {
                    flashMessage.style.opacity = '0';
                    flashMessage.style.transition = 'opacity 1s';
                    setTimeout(() => flashMessage.remove(), 1000); // Adjust the duration as needed
                }, 3000); // Adjust the duration as needed
            }
        });
    </script>
</x-app-layout>

<style>
    .applications-container {
        max-height: 500px; /* Set the desired fixed height */
        /* Enable vertical scrolling */
    }
</style>
