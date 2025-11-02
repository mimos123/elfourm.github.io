<x-app-layout>
    <div class="mt-3">
        <h1 class="text-2xl font-bold mb-4">All Applications for My Offers</h1>

        @if(session('success'))
            <div id="flash-message" class="flash-message success px-4 py-2 rounded-md mb-4 bg-green-50 text-green-800 border border-green-100">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div id="flash-message" class="flash-message error px-4 py-2 rounded-md mb-4 bg-red-50 text-red-800 border border-red-100">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-md p-4">
            <div class="applications-container">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-2">
                        <input id="applicationSearch" type="search" placeholder="Search by name, email or phone" class="px-3 py-2 border rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        <select id="statusFilter" class="px-2 py-2 border rounded-md text-sm focus:outline-none">
                            <option value="">All statuses</option>
                            <option value="pending">Pending</option>
                            <option value="up for interview">Up For Interview</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="text-sm text-gray-500">Showing <span id="resultsCount">{{ $applications->count() }}</span> applications</div>
                </div>

                <div class="overflow-x-auto rounded-md border">
                    <table class="min-w-full divide-y divide-gray-200">
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
                                        <a href="{{ route('application.downloadCv', $application->id) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            Download CV
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ ucfirst($application->status) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if(strtolower($application->status) !== 'up for interview' && strtolower($application->status) !== 'rejected')
                                            <form action="{{ route('application.accept', $application->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-green-500 hover:bg-green-600 text-white text-sm rounded-md" aria-label="Accept application">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Accept
                                                </button>
                                            </form>
                                            <form action="{{ route('application.reject', $application->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-sm rounded-md ml-2" aria-label="Reject application">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    Reject
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-gray-500">No actions</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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

            // Client-side search/filter
            const search = document.getElementById('applicationSearch');
            const filter = document.getElementById('statusFilter');
            const table = document.querySelector('tbody');
            const resultsCount = document.getElementById('resultsCount');

            function updateFilter() {
                const q = search.value.trim().toLowerCase();
                const status = (filter.value || '').toLowerCase();
                let visible = 0;
                Array.from(table.querySelectorAll('tr')).forEach(row => {
                    const cols = Array.from(row.querySelectorAll('td')).map(td => td.textContent.toLowerCase());
                    const matchesQuery = q === '' || cols.some(c => c.includes(q));
                    const rowStatus = cols[4] ? cols[4].trim().toLowerCase() : '';
                    const matchesStatus = status === '' || rowStatus.includes(status);
                    const show = matchesQuery && matchesStatus;
                    row.style.display = show ? '' : 'none';
                    if (show) visible++;
                });
                if (resultsCount) resultsCount.textContent = visible;
            }

            if (search) search.addEventListener('input', updateFilter);
            if (filter) filter.addEventListener('change', updateFilter);

            // Confirm before submitting accept/reject forms
            document.querySelectorAll('form').forEach(f => {
                if (f.action.includes('accept') || f.action.includes('reject')) {
                    f.addEventListener('submit', function (e) {
                        const isAccept = f.action.includes('accept');
                        const ok = confirm(isAccept ? 'Mark this application as Up For Interview?' : 'Reject this application?');
                        if (!ok) e.preventDefault();
                    });
                }
            });
        });
    </script>
</x-app-layout>

<style>
    .applications-container {
        max-height: 500px; /* Set the desired fixed height */
        /* Enable vertical scrolling */
    }

    .flash-message { display: inline-block; }

    /* Make the table rows more readable on small screens */
    @media (max-width: 640px) {
        .applications-container table thead { display: none; }
        .applications-container table tbody td { display: block; width: 100%; }
        .applications-container table tbody tr { display: block; margin-bottom: 1rem; border-bottom: 1px solid #eee; }
    }
</style>
