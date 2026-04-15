<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'VideosApp') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 flex flex-col min-h-screen">

        <!-- ── Navbar ── -->
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between">

                <a href="{{ route('videos.index') }}" class="text-lg font-bold text-gray-800 hover:text-blue-600 transition-colors">
                    {{ config('app.name', 'VideosApp') }}
                </a>

                <div class="flex items-center gap-6">
                    <a href="{{ route('videos.index') }}"
                       class="text-sm {{ request()->routeIs('videos.index') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-gray-900' }} transition-colors">
                        Vídeos
                    </a>
                    @can('manage-videos')
                        <a href="{{ route('videos.manage') }}"
                           class="text-sm {{ request()->routeIs('videos.manage*') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-gray-900' }} transition-colors">
                            Gestionar Vídeos
                        </a>
                    @endcan
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        <span class="text-sm text-gray-500">{{ auth()->user()->name }}</span>
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">
                            Iniciar sessió
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-blue-700 transition-colors">
                                Registrar-se
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </nav>

        <!-- ── Contingut principal ── -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- ── Footer ── -->
        <footer class="bg-white border-t border-gray-200 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-sm text-gray-500">
                    &copy; {{ date('Y') }} <span class="font-semibold text-gray-700">{{ config('app.name', 'VideosApp') }}</span> — Miquel Dieguez
                </p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('videos.index') }}" class="text-sm text-gray-500 hover:text-gray-700 transition-colors">Vídeos</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-gray-700 transition-colors">Iniciar sessió</a>
                    @endauth
                </div>
            </div>
        </footer>

    </body>
</html>
