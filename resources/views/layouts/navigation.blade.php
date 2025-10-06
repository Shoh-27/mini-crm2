<nav x-data="{ open: false, showNotifications: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center space-x-6">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
            </div>

            <!-- Notifications -->
            <div class="relative">
                <button @click="showNotifications = !showNotifications"
                        class="relative focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V11a6 6 0 00-9.33-4.945" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 17H4l1.405-1.405A2.032 2.032 0 006 14v-3a6 6 0 1112 0v3a2.032 2.032 0 00.595 1.595L20 17h-5m-6 0a3 3 0 006 0" />
                    </svg>

                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="absolute top-0 right-0 block w-2 h-2 bg-red-600 rounded-full"></span>
                    @endif
                </button>

                <!-- Dropdown Notifications -->
                <div x-show="showNotifications"
                     @click.away="showNotifications = false"
                     x-transition
                     class="absolute right-0 mt-2 w-80 bg-white border rounded-lg shadow-lg z-50">
                    <div class="p-3 border-b flex justify-between items-center">
                        <span class="font-semibold text-gray-800">Notifications</span>
                        <form action="{{ route('notifications.read.all') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-sm text-blue-600 hover:underline">Mark all read</button>
                        </form>
                    </div>

                    <div class="max-h-64 overflow-y-auto">
                        @forelse(auth()->user()->notifications as $notification)
                            <div class="px-4 py-2 border-b hover:bg-gray-50 {{ $notification->read_at ? '' : 'bg-gray-100' }}">
                                <div class="font-medium text-gray-800">
                                    Task: {{ $notification->data['title'] }}
                                </div>
                                <div class="text-sm text-gray-600">
                                    Deadline: {{ $notification->data['deadline'] ?? '—' }}
                                </div>
                                <div class="text-xs text-gray-400">
                                    {{ $notification->created_at->diffForHumans() }}
                                </div>
                            </div>
                        @empty
                            <div class="p-4 text-gray-500 text-sm text-center">
                                No notifications yet.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
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
        </div>
    </div>
</nav>
