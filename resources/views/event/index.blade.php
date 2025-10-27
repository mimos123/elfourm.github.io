<x-app-layout>
    <div class="container mx-auto mt-5">


        @if(Auth::check() &&( (Auth::user()->role === 'admin' || Auth::user()->role === 'resp')))
            <div class="mb-3 text-right">
                <a href="{{ route('event.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Add New Event</a>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @forelse($events as $event)
                <div class="bg-white shadow-md rounded-md p-4">
                    <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->name }}" class="h-40 object-cover rounded-md mb-4">
                    <h5 class="text-xl font-semibold text-gray-800">{{ $event->name }}</h5>
                    <p class="text-gray-600 mb-2">Start Date: {{ $event->start_date }}</p>
                    <p class="text-gray-600 mb-2">End Date: {{ $event->end_date }}</p>
                    <p class="text-gray-600 mb-2">Tags:
                        @foreach($event->tags as $tag)
                            <span class="inline-block bg-gray-200 text-gray-700 px-2 py-1 rounded-md mr-1">{{ $tag->name }}</span>
                        @endforeach
                    </p>

                    @php
                        $userAttendance = $event->users->firstWhere('id', Auth::id());
                    @endphp

                      @if($userAttendance)
                        @if($userAttendance->pivot->status == 'confirmed')
                            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'resp' || Auth::user()->role === 'student')
                                <a href="{{ route('events.feed', $event) }}" class="text-blue-600 hover:text-blue-800 mr-2">Go to Feed</a>
                            @else
                                <p class="text-yellow-600">Status: {{ ucfirst($userAttendance->pivot->status) }}</p>
                            @endif
                        @else
                            <p class="text-yellow-600">Status: {{ ucfirst($userAttendance->pivot->status) }}</p>
                        @endif
                    @else
                        <form action="{{ route('events.attend', $event->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Attend</button>
                        </form>
                    @endif
                    @if(Auth::user()->role === "admin" || Auth::user()->role === "resp")
                        <div class="flex justify-end">
                            <a href="{{ route('events.edit', $event->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M15.293 3.293a1 1 0 0 1 1.414 1.414l-10 10a1 1 0 0 1-.571.293H4a1 1 0 0 1-1-1v-1.122a1 1 0 0 1 .293-.708l10-10zM5 11v2h2l8-8v-2h-2L5 9v2z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 5.293a1 1 0 0 1 1.414 0L10 8.586l3.293-3.293a1 1 0 1 1 1.414 1.414L11.414 10l3.293 3.293a1 1 0 1 1-1.414 1.414L10 11.414l-3.293 3.293a1 1 0 0 1-1.414-1.414L8.586 10 5.293 6.707a1 1 0 0 1 0-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <div class="w-full">
                    <div class="bg-white shadow-md rounded-md p-4">
                        <p class="text-gray-800">No events found.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
