<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Helmy Yunan Nasution — Personal Information & Professional Journey System' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Personal Information & Professional Journey System of Helmy Yunan Nasution, Software Engineer & System Architect.' }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-zinc-950 text-zinc-100 font-sans antialiased selection:bg-indigo-500 selection:text-white min-h-screen flex flex-col">
    <!-- Navbar -->
    <header x-data="{ open: false }" class="sticky top-0 z-50 backdrop-blur-md bg-zinc-950/80 border-b border-zinc-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center font-bold text-white shadow-lg shadow-indigo-500/20 group-hover:scale-105 transition duration-300">
                        H
                    </div>
                    <span class="font-semibold text-lg tracking-tight group-hover:text-indigo-400 transition">
                        Helmy Yunan Nasution
                    </span>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center gap-1 text-sm font-medium text-zinc-300">
                    <a href="{{ route('home') }}" class="px-3 py-1.5 rounded-lg hover:text-white hover:bg-zinc-800/60 transition {{ request()->routeIs('home') ? 'text-indigo-400 bg-zinc-800/40' : '' }}">Home</a>
                    <a href="{{ route('about') }}" class="px-3 py-1.5 rounded-lg hover:text-white hover:bg-zinc-800/60 transition {{ request()->routeIs('about') ? 'text-indigo-400 bg-zinc-800/40' : '' }}">About</a>
                    <a href="{{ route('projects.index') }}" class="px-3 py-1.5 rounded-lg hover:text-white hover:bg-zinc-800/60 transition {{ request()->routeIs('projects.*') ? 'text-indigo-400 bg-zinc-800/40' : '' }}">Projects</a>
                    <a href="{{ route('journey.index') }}" class="px-3 py-1.5 rounded-lg hover:text-white hover:bg-zinc-800/60 transition {{ request()->routeIs('journey.*') ? 'text-indigo-400 bg-zinc-800/40' : '' }}">Journey</a>
                    <a href="{{ route('skills.index') }}" class="px-3 py-1.5 rounded-lg hover:text-white hover:bg-zinc-800/60 transition {{ request()->routeIs('skills.*') ? 'text-indigo-400 bg-zinc-800/40' : '' }}">Skills</a>
                    <a href="{{ route('certificates.index') }}" class="px-3 py-1.5 rounded-lg hover:text-white hover:bg-zinc-800/60 transition {{ request()->routeIs('certificates.*') ? 'text-indigo-400 bg-zinc-800/40' : '' }}">Certificates</a>
                    <a href="{{ route('achievements.index') }}" class="px-3 py-1.5 rounded-lg hover:text-white hover:bg-zinc-800/60 transition {{ request()->routeIs('achievements.*') ? 'text-indigo-400 bg-zinc-800/40' : '' }}">Achievements</a>
                    <a href="{{ route('articles.index') }}" class="px-3 py-1.5 rounded-lg hover:text-white hover:bg-zinc-800/60 transition {{ request()->routeIs('articles.*') ? 'text-indigo-400 bg-zinc-800/40' : '' }}">Articles</a>
                    <a href="{{ route('contact.index') }}" class="px-3 py-1.5 rounded-lg hover:text-white hover:bg-zinc-800/60 transition {{ request()->routeIs('contact.*') ? 'text-indigo-400 bg-zinc-800/40' : '' }}">Contact</a>
                </nav>

                <!-- Search & Actions -->
                <div class="hidden sm:flex items-center gap-3">
                    <form action="{{ route('search') }}" method="GET" class="relative">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search system..." class="w-40 focus:w-56 transition-all duration-300 text-xs bg-zinc-900 border border-zinc-800 rounded-full px-3.5 py-1.5 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-zinc-200 placeholder-zinc-500">
                    </form>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="open = !open" type="button" class="p-2 rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="open" x-cloak class="md:hidden border-b border-zinc-800 bg-zinc-950/95 px-4 pt-2 pb-4 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-zinc-300 hover:text-white hover:bg-zinc-800">Home</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-zinc-300 hover:text-white hover:bg-zinc-800">About</a>
            <a href="{{ route('projects.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-zinc-300 hover:text-white hover:bg-zinc-800">Projects</a>
            <a href="{{ route('journey.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-zinc-300 hover:text-white hover:bg-zinc-800">Journey</a>
            <a href="{{ route('skills.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-zinc-300 hover:text-white hover:bg-zinc-800">Skills</a>
            <a href="{{ route('certificates.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-zinc-300 hover:text-white hover:bg-zinc-800">Certificates</a>
            <a href="{{ route('achievements.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-zinc-300 hover:text-white hover:bg-zinc-800">Achievements</a>
            <a href="{{ route('articles.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-zinc-300 hover:text-white hover:bg-zinc-800">Articles</a>
            <a href="{{ route('contact.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-zinc-300 hover:text-white hover:bg-zinc-800">Contact</a>
        </div>
    </header>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-between text-sm">
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="border-t border-zinc-800/80 bg-zinc-950 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="text-center md:text-left">
                    <p class="font-semibold text-zinc-200">Helmy Yunan Nasution</p>
                    <p class="text-xs text-zinc-500 mt-1">Personal Information & Professional Journey System &copy; {{ date('Y') }}. All rights reserved.</p>
                </div>
                <div class="flex items-center gap-6 text-sm text-zinc-400">
                    <a href="{{ route('projects.index') }}" class="hover:text-white transition">Projects</a>
                    <a href="{{ route('journey.index') }}" class="hover:text-white transition">Journey</a>
                    <a href="{{ route('skills.index') }}" class="hover:text-white transition">Skills</a>
                    <a href="{{ route('contact.index') }}" class="hover:text-white transition">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
