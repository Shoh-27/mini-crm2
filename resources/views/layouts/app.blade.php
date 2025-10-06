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

    <!-- Scripts / Styles (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
<div id="app" class="min-h-screen flex flex-col">
    <!-- Top navigation -->
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Brand -->
                <div class="flex items-center space-x-3">
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <div class="h-8 w-8 bg-blue-600 text-white rounded flex items-center justify-center font-bold">
                            {{ strtoupper(substr(config('app.name','App'),0,1)) }}
                        </div>
                        <span class="hidden sm:inline font-semibold text-lg">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>

                <!-- Desktop links -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('leads.index') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100">Leads</a>
                    <a href="{{route('deals.index')}}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100">Deals</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100">Analytics</a>
                </div>

                <!-- Notifications -->
                @foreach(auth()->user()->notifications as $notification)
                    <div class="p-2 border-b">
                        <strong>{{ $notification->data['title'] }}</strong><br>
                        Deadline: {{ $notification->data['deadline'] ?? '—' }}
                    </div>
                @endforeach


                <!-- Right: user -->
                <div class="flex items-center space-x-3">
                    @auth
                        <div class="hidden sm:flex flex-col text-right mr-3">
                            <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                            <a href="#" class="text-xs text-gray-500">Profil</a>
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm px-3 py-2 rounded-md hover:bg-gray-100">Chiqish</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm px-3 py-2 rounded-md hover:bg-gray-100">Kirish</a>
                    @endauth

                    <!-- Mobile menu button -->
                    <button id="mobileMenuButton" class="md:hidden p-2 rounded-md hover:bg-gray-100" aria-label="Open menu">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu (hidden by default) -->
        <div id="mobileMenu" class="md:hidden hidden border-t border-gray-100">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('leads.index') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100">Leads</a>
                <a href="{{route('deals.index')}}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100">Deals</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100">Analytics</a>
                @auth
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100">Profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-md hover:bg-gray-100">Chiqish</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100">Kirish</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <div class="text-lg font-semibold text-gray-800">
                        {{ $header }}
                    </div>
                    <div>
                        <!-- Example action button (optional) -->
                        @isset($headerActions)
                            {{ $headerActions }}
                        @endisset
                    </div>
                </div>
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main class="flex-1">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                {{ $slot }}
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between text-sm text-gray-500">
            <div>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</div>
            <div class="space-x-4">
                <a href="#" class="hover:underline">Privacy</a>
                <a href="#" class="hover:underline">Terms</a>
            </div>
        </div>
    </footer>
</div>

<!-- Minimal JS: mobile menu toggle (works without Alpine) -->
<script>
    (function(){
        const btn = document.getElementById('mobileMenuButton');
        const menu = document.getElementById('mobileMenu');
        if (!btn || !menu) return;
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    })();
</script>
</body>
</html>
