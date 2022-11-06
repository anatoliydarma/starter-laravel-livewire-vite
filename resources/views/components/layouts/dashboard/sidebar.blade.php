<div x-cloak wire:ignore :class="{ 'translate-x-0': sidebar, '-translate-x-full sm:-translate-x-60': !sidebar }" id="sidebarWindow" @swipeleft="sidebar = false" class="fixed top-0 bottom-0 left-0 z-30 block w-full h-full min-h-screen overflow-y-auto font-light transition-transform duration-300 ease-in-out transform translate-x-0 sm:w-60 scrollbar text-stone-700 bg-slate-200 ">

    <div class="flex flex-col items-stretch justify-between h-full">
        <div class="flex flex-col flex-shrink-0 w-full">
            <div class="flex items-center justify-center px-8 py-3 text-center">
                <a href="/" class="text-lg font-semibold text-slate-400 hover:text-slate-500 focus:outline-none focus:ring">SaaS</a>
            </div>

            <nav class="flex-grow md:block md:overflow-y-auto ">
                <a class="flex justify-start items-center px-4 py-3  hover:bg-slate-300 {{ request()->routeIs('dashboard.dashboard') ? 'bg-slate-300/50' : '' }}" href="{{ route('dashboard.dashboard') }}">
                    <x-tabler-dashboard class="w-6 h-6" />
                    <span class="mx-4">Dashboard</span>
                </a>

                <a class="flex justify-start items-center px-4 py-3  hover:bg-slate-300  {{ request()->routeIs('dashboard.users') ? 'bg-slate-300/50' : '' }}" href="{{ route('dashboard.users') }}">
                    <x-tabler-users class="w-6 h-6" />
                    <span class="mx-4">Users</span>
                </a>

                <a class="flex justify-start items-center px-4 py-3  hover:bg-slate-300  {{ request()->routeIs('dashboard.maintenance') ? 'bg-slate-300/50' : '' }}" href="{{ route('dashboard.maintenance') }}">
                    <x-tabler-settings class="w-6 h-6" />
                    <span class="mx-4">Maintenance</span>
                </a>
            </nav>

        </div>
        <div>
            <a title="Logout" href="{{ route('logout') }}" class="block px-4 py-3 " onclick="event.preventDefault();
														document.getElementById('logout-form').submit();">
                <x-tabler-logout class="w-6 h-6" />
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>
