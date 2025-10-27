<x-app-layout>
    <div class="w-full bg-gray-100">
        <main class="flex w-full">
            <div class="flex-grow bg-white p-8">
                <h1 class="text-2xl font-bold mb-4">Your Applications</h1>
                <div class="applications-container overflow-y-auto">
                    @if ($applications->isEmpty())
                        <p class="text-center">You have not applied for any posts yet.</p>
                    @else
                        @foreach ($applications as $application)
                            <div class="application mb-4 p-4 border border-gray-200 rounded shadow-sm">
                                <div class="application-info">
                                    <!-- Display the profile picture and name of the offer owner -->
                                    <div class="owner-info flex items-center mb-4">
                                        <img src="{{ $application->post->user->profile_picture }}" alt="{{ $application->post->user->name }}" class="w-10 h-10 rounded-full mr-3">
                                        <span class="text-gray-700 font-bold">{{ $application->post->user->name }}</span>
                                    </div>
                                    <span class="block text-gray-700">{{ $application->post->content }}</span>
                                    <span class="application-date text-gray-500 text-sm">Applied on: {{ $application->created_at->format('d M Y') }}</span>
                                    <span class="application-status text-gray-600 text-sm">Status: <strong>{{ ucfirst($application->status) }}</strong></span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </main>
    </div>
</x-app-layout>

<style>
    .application {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: left;
        width: 100%;
        max-width: 700px;
        margin: 20px auto;
    }

    .application-info {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
    }

    .application-info span {
        font-size: 14px;
        color: #555;
        margin-bottom: 5px;
    }

    .application-date {
        font-size: 12px;
        color: #999;
        margin-bottom: 10px;
    }

    .application-status {
        font-size: 14px;
        color: #333;
    }

    .applications-container {
        overflow-y: auto;
        max-height: calc(100vh - 10rem); /* Adjust the height to fit your layout */
    }

    .owner-info img {
        border-radius: 50%;
    }
</style>
