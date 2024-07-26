<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex space-x-8 sm:ml-10">
                <!-- Navigation Links -->
                <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('tasks') }}" :active="request()->routeIs('tasks')">
                    {{ __('Tasks') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('projects') }}" :active="request()->routeIs('projects')">
                    {{ __('Projects') }}
                </x-jet-nav-link>
            </div>

            <!-- Logout Link -->
            <div class="flex items-center">
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-jet-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-jet-nav-link>
                </form>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('tasks') }}" :active="request()->routeIs('tasks')">
                {{ __('Tasks') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('projects') }}" :active="request()->routeIs('projects')">
                {{ __('Projects') }}
            </x-jet-responsive-nav-link>
        </div>
        <div class="pt-4 pb-1 border-t border-gray-200">
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <x-jet-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                    {{ __('Log Out') }}
                </x-jet-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
