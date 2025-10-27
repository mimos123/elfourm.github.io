<x-app-layout>
    <div class="w-full bg-gray-100 min-h-screen p-8">
        <h1 class="text-2xl font-bold mb-4">Pending Attendances for All Events</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        @foreach ($pendingAttendances as $event)
            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h2 class="text-xl font-semibold mb-4">{{ $event->name }}</h2>
                @if ($event->users->isEmpty())
                    <p>No pending attendances for this event.</p>
                @else
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2">Company Name</th>
                                <th class="py-2">Email</th>
                                <th class="py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($event->users as $company)
                                <tr>
                                    <td class="py-2">{{ $company->name }}</td>
                                    <td class="py-2">{{ $company->email }}</td>
                                    <td class="py-2">
                                        <form action="{{ route('jpo.update-attendance', ['event' => $event->id, 'user' => $company->id]) }}" method="POST" class="inline-block">
                                            @csrf
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-300 ease-in-out">
                                                Confirm
                                            </button>
                                        </form>
                                        <form action="{{ route('jpo.update-attendance', ['event' => $event->id, 'user' => $company->id]) }}" method="POST" class="inline-block">
                                            @csrf
                                            <input type="hidden" name="status" value="refused">
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300 ease-in-out">
                                                Refuse
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        @endforeach
    </div>
</x-app-layout>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
        text-align: left;
    }
</style>
