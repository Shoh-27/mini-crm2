<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts / Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gradient-to-br from-gray-900 via-blue-950 to-gray-900 text-gray-100">
<div id="app" class="min-h-screen flex flex-col">

    <!-- 🔹 Navbar -->
    <nav class="bg-gradient-to-r from-blue-800/60 to-indigo-900/60 backdrop-blur-md border-b border-gray-700/50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <div class="h-8 w-8 bg-blue-600 text-white rounded-lg flex items-center justify-center font-bold shadow-md">
                            {{ strtoupper(substr(config('app.name','App'),0,1)) }}
                        </div>
                        <span class="hidden sm:inline font-semibold text-lg text-blue-300">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>

                <!-- Nav Links -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('leads.index') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700/30 hover:text-blue-300 transition">Leads</a>
                    <a href="{{ route('deals.index') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700/30 hover:text-blue-300 transition">Deals</a>
                    <a href="{{ route('analytics.index') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700/30 hover:text-blue-300 transition">Analytics</a>
                    <a href="{{ route('tasks.index') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700/30 hover:text-blue-300 transition">Tasks</a>
                </div>

                <!-- Notifications -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="relative p-2 rounded-full hover:bg-blue-800/40 focus:ring-2 focus:ring-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3c0 .528-.214 1.04-.595 1.405L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute top-0 right-0 px-1.5 py-0.5 text-xs font-bold text-white bg-red-500 rounded-full">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </button>

                    <!-- Dropdown -->
                    <div
                        x-show="open"
                        @click.away="open = false"
                        class="absolute right-0 mt-2 w-80 bg-gray-900 border border-gray-700 rounded-xl shadow-xl z-50 overflow-hidden"
                        style="display:none;"
                    >
                        <div class="px-4 py-3 bg-blue-950 border-b border-gray-700 font-semibold text-blue-300 flex justify-between items-center">
                            <span>🔔 Bildirishnomalar</span>
                            <form method="POST" action="{{ route('notifications.read.all') }}">
                                @csrf
                                <button type="submit" class="text-xs text-blue-400 hover:text-blue-300 hover:underline">
                                    O‘qilgan deb belgilash
                                </button>
                            </form>
                        </div>

                        @forelse(auth()->user()->notifications as $notification)
                            <div class="px-4 py-3 border-b border-gray-800 hover:bg-blue-900/30 transition">
                                <div class="font-medium text-gray-200">
                                    {{ $notification->data['title'] ?? 'No title' }}
                                </div>
                                <div class="text-sm text-blue-300">
                                    Deadline: {{ $notification->data['deadline'] ?? '—' }}
                                </div>
                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $notification->created_at->diffForHumans() }}
                                </div>
                            </div>
                        @empty
                            <div class="px-4 py-4 text-center text-gray-500 text-sm">
                                Bildirishnoma yo‘q
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- User -->
                <div class="flex items-center space-x-3">
                    @auth
                        <div class="hidden sm:flex flex-col text-right mr-3">
                            <span class="text-sm font-medium text-blue-300">{{ auth()->user()->name }}</span>
                            <a href="#" class="text-xs text-gray-400 hover:text-blue-400">Profil</a>
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm px-3 py-2 rounded-md bg-blue-800/40 hover:bg-blue-700/40 transition">
                                Chiqish
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm px-3 py-2 rounded-md bg-blue-700/40 hover:bg-blue-600/40">Kirish</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    @if (isset($header))
        <header class="bg-blue-950/40 border-b border-gray-800 shadow-md">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <div class="text-lg font-semibold text-blue-300">
                    {{ $header }}
                </div>
                @isset($headerActions)
                    {{ $headerActions }}
                @endisset
            </div>
        </header>
    @endif

    <!-- Content -->
    <main class="flex-1">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                {{ $slot }}
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-950/40 border-t border-gray-800 text-gray-500">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between text-sm">
            <div>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</div>
            <div class="space-x-4">
                <a href="#" class="hover:text-blue-400">Privacy</a>
                <a href="#" class="hover:text-blue-400">Terms</a>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
