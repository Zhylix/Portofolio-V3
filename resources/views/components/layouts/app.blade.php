<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' — Helmy Yunan Nasution' : 'Helmy Yunan Nasution — Personal Information & Professional Journey System' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Personal Information & Professional Journey System of Helmy Yunan Nasution. Lead Software Engineer & System Architect.' }}">
    <link rel="canonical" href="{{ $canonicalUrl ?? url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $ogType ?? 'website' }}">
    <meta property="og:url" content="{{ $canonicalUrl ?? url()->current() }}">
    <meta property="og:title" content="{{ isset($title) ? $title . ' — Helmy Yunan Nasution' : 'Helmy Yunan Nasution — Personal Information & Professional Journey System' }}">
    <meta property="og:description" content="{{ $metaDescription ?? 'Personal Information & Professional Journey System of Helmy Yunan Nasution.' }}">
    <meta property="og:image" content="{{ $ogImage ?? asset('images/og-card.png') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $canonicalUrl ?? url()->current() }}">
    <meta name="twitter:title" content="{{ isset($title) ? $title . ' — Helmy Yunan Nasution' : 'Helmy Yunan Nasution — Personal Information & Professional Journey System' }}">
    <meta name="twitter:description" content="{{ $metaDescription ?? 'Personal Information & Professional Journey System of Helmy Yunan Nasution.' }}">
    <meta name="twitter:image" content="{{ $ogImage ?? asset('images/og-card.png') }}">

    <!-- Fonts: Space Grotesk, Inter, JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Schema.org Structured Data -->
    <x-structured-data :article="$article ?? null" :breadcrumbs="$breadcrumbs ?? null" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-[#080808] text-[#F5F1EA] font-sans antialiased min-h-screen flex flex-col relative overflow-x-hidden selection:bg-[#C45A19] selection:text-[#F5F1EA]">

    <!-- Accessibility: Skip to Main Content -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-[#C45A19] focus:text-white focus:rounded-xl focus:shadow-lg focus:outline-none font-mono text-xs">
        Skip to main content
    </a>

    <!-- Top Scroll Progress Bar -->
    <div id="scroll-progress" class="fixed top-0 left-0 h-0.5 sm:h-1 bg-gradient-to-r from-[#C45A19] to-[#E47A2E] z-50 w-0 pointer-events-none transition-[width] duration-75 shadow-sm shadow-[#C45A19]/50" aria-hidden="true"></div>

    <!-- Desktop Custom Cursor -->
    <div id="cursor-dot" aria-hidden="true"></div>
    <div id="cursor-ring" aria-hidden="true"><span id="cursor-label"></span></div>

    <!-- Subtle Ambient Radial Glows -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden" aria-hidden="true">
        <!-- Top radial glow (burnt orange) -->
        <div class="absolute -top-48 left-1/2 -translate-x-1/2 w-[700px] sm:w-[900px] h-[450px] bg-[radial-gradient(ellipse_at_center,_rgba(196,90,25,0.07)_0%,_rgba(8,8,8,0)_70%)] blur-2xl"></div>
        <!-- Center-right subtle warm accent -->
        <div class="absolute top-[35%] -right-48 w-[600px] h-[500px] bg-[radial-gradient(ellipse_at_center,_rgba(196,90,25,0.04)_0%,_rgba(8,8,8,0)_70%)] blur-3xl"></div>
        <!-- Bottom-left ambient tint -->
        <div class="absolute bottom-10 -left-48 w-[600px] h-[500px] bg-[radial-gradient(ellipse_at_center,_rgba(196,90,25,0.03)_0%,_rgba(8,8,8,0)_70%)] blur-3xl"></div>
        <!-- Grid pattern overlay -->
        <div class="absolute inset-0 bg-grid-subtle opacity-40"></div>
    </div>

    <!-- Floating Glass Navbar -->
    <x-navbar />

    <!-- Main Content Container -->
    <main id="main-content" class="flex-grow z-10 pt-28 pb-20 focus:outline-none" tabindex="-1">
        {{ $slot }}
    </main>

    <!-- Global Command Palette -->
    <x-command-palette />

    <!-- Footer -->
    <x-footer />

    @livewireScripts
</body>
</html>
