<nav x-data="{ open: false }" class="nav">
    <!-- Logo Section -->
    <div class="logo">

            <img src="{{ asset('logoform.png') }}">

    </div>

    <!-- Dynamic Navigation Links for Different User Roles -->
    <div class="sm:flex flex-col sm:justify-between mt-8 font-inter font-bold">
        @auth
            @if(Auth::user()->role === "admin")
                <a href="{{ route('managers.index') }}" :class="{ 'active': request()->routeIs('managers.index') }">Event Managers</a>
                <a href="{{ route('event.index') }}" :class="{ 'active': request()->routeIs('event.index') }">Manage Events</a>
                <a href="{{ route('company.list') }}" :class="{ 'active': request()->routeIs('company.list') }">Companies</a>
                <a href="{{ route('jpo.pending-attendances') }}" :class="{ 'active': request()->routeIs('jpo.pending-attendances') }">Pending Attendances</a>
               <a href="{{ route('applications.index') }}" :class="{ 'active': request()->routeIs('event.index') }">Demands</a>
                <a href="{{ route('posts.index') }}" :class="{ 'active': request()->routeIs('posts.index') }">my posts</a>

                <a href="{{ route('dashboard') }}" :class="{ 'active': request()->routeIs('dashboard') }">Dashboard</a>
            @elseif(Auth::user()->role === "resp")
                <a href="{{ route('event.index') }}" :class="{ 'active': request()->routeIs('event.index') }">Manage Events</a>
                <a href="{{ route('company.list') }}" :class="{ 'active': request()->routeIs('company.list') }">Companies</a>
                 <a href="{{ route('jpo.pending-attendances') }}" :class="{ 'active': request()->routeIs('jpo.pending-attendances') }">Pending Attendances</a>
<a href="{{ route('applications.index') }}" :class="{ 'active': request()->routeIs('event.index') }">Demands</a>
                <a href="{{ route('posts.index') }}" :class="{ 'active': request()->routeIs('posts.index') }">my posts</a>

                 <a href="{{ route('jpo.pending-attendances') }}" :class="{ 'active': request()->routeIs('jpo.pending-attendances') }">Pending Attendances</a>
            @elseif(Auth::user()->role === "company")
                <a href="{{ route('event.index') }}" :class="{ 'active': request()->routeIs('event.index') }">Events</a>
                <a href="{{ route('applications.index') }}" :class="{ 'active': request()->routeIs('event.index') }">Demands</a>
                <a href="{{ route('posts.index') }}" :class="{ 'active': request()->routeIs('posts.index') }">my posts</a>

            @else
                <a href="{{ route('event.index') }}" :class="{ 'active': request()->routeIs('event.index') }">Events</a>
                <a href="{{ route('company.list') }}" :class="{ 'active': request()->routeIs('company.list') }">Companies</a>

                <a href="{{ route('user.applications') }}" :class="{ 'active': request()->routeIs('user.applications') }">Applications</a>
            @endif
        @endauth
    </div>

    <!-- User Dropdown Section -->
    <div class="user-dropdown hidden sm:flex sm:items-center sm:ml-6 text-cyan-800">
        <x-dropdown width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition duration-150">
                    <div>{{ Auth::user()->name }}</div>
                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>
            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</nav>
