@php
    $profile = \App\Models\Profile::first();
    $brandName = $profile ? ($profile->full_name ? explode(' ', $profile->full_name)[0] : 'HELMY') : 'ZEPHYR';
    $isAvailable = $profile ? $profile->is_available : true;
@endphp

<header 
    x-data="{ scrolled: false, mobileOpen: false }" 
    x-init="scrolled = (window.pageYOffset > 10)"
    @scroll.window="scrolled = (window.pageYOffset > 10)"
    class="fixed top-4 sm:top-6 inset-x-0 z-50 px-4 sm:px-6 pointer-events-none"
>
    <div class="max-w-5xl mx-auto flex items-center justify-between">
        <!-- Floating Glass Navbar Pill -->
        <nav 
            class="pointer-events-auto w-full transition-all duration-300 rounded-full border px-4 sm:px-6 py-2.5 sm:py-3 flex items-center justify-between shadow-2xl"
            :class="scrolled ? 'bg-[#0E0D0C]/95 border-[#3D352E] shadow-black/80 backdrop-blur-xl' : 'bg-[#0E0D0C]/80 border-[#2A2520] shadow-black/50 backdrop-blur-lg'"
        >
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group text-left">
                <span class="w-8 h-8 rounded-full bg-[#151311] border border-[#2A2520] group-hover:border-[#C45A19] flex items-center justify-center text-xs font-mono font-bold text-[#F5F1EA] group-hover:text-[#E47A2E] transition-all duration-200">
                    HY
                </span>
                <span class="font-heading font-bold text-sm tracking-wider uppercase text-[#F5F1EA] group-hover:text-[#E47A2E] transition-colors hidden xs:inline">
                    {{ strtoupper($brandName) }}
                </span>
            </a>

            <!-- Desktop Nav Links -->
            <div class="hidden md:flex items-center gap-1 lg:gap-2 text-xs font-mono uppercase tracking-wider text-[#9E958B]">
                <a 
                    href="{{ route('home') }}" 
                    class="px-2.5 py-1.5 rounded-full transition-colors {{ request()->routeIs('home') ? 'text-[#F5F1EA] bg-[#1E1A17] font-semibold text-[#E47A2E]' : 'hover:text-[#F5F1EA] hover:bg-[#151311]' }}"
                >
                    Home
                </a>
                <a 
                    href="{{ route('about') }}" 
                    class="px-2.5 py-1.5 rounded-full transition-colors {{ request()->routeIs('about') ? 'text-[#F5F1EA] bg-[#1E1A17] font-semibold text-[#E47A2E]' : 'hover:text-[#F5F1EA] hover:bg-[#151311]' }}"
                >
                    About
                </a>
                <a 
                    href="{{ route('projects.index') }}" 
                    class="px-2.5 py-1.5 rounded-full transition-colors {{ request()->routeIs('projects.*') ? 'text-[#F5F1EA] bg-[#1E1A17] font-semibold text-[#E47A2E]' : 'hover:text-[#F5F1EA] hover:bg-[#151311]' }}"
                >
                    Work
                </a>
                <a 
                    href="{{ route('journey.index') }}" 
                    class="px-2.5 py-1.5 rounded-full transition-colors {{ request()->routeIs('journey.*') ? 'text-[#F5F1EA] bg-[#1E1A17] font-semibold text-[#E47A2E]' : 'hover:text-[#F5F1EA] hover:bg-[#151311]' }}"
                >
                    Journey
                </a>
                <a 
                    href="{{ route('skills.index') }}" 
                    class="px-2.5 py-1.5 rounded-full transition-colors {{ request()->routeIs('skills.*') ? 'text-[#F5F1EA] bg-[#1E1A17] font-semibold text-[#E47A2E]' : 'hover:text-[#F5F1EA] hover:bg-[#151311]' }}"
                >
                    Skills
                </a>
                <a 
                    href="{{ route('certificates.index') }}" 
                    class="px-2.5 py-1.5 rounded-full transition-colors {{ request()->routeIs('certificates.*') ? 'text-[#F5F1EA] bg-[#1E1A17] font-semibold text-[#E47A2E]' : 'hover:text-[#F5F1EA] hover:bg-[#151311]' }}"
                >
                    Certs
                </a>
                <a 
                    href="{{ route('articles.index') }}" 
                    class="px-2.5 py-1.5 rounded-full transition-colors {{ request()->routeIs('articles.*') ? 'text-[#F5F1EA] bg-[#1E1A17] font-semibold text-[#E47A2E]' : 'hover:text-[#F5F1EA] hover:bg-[#151311]' }}"
                >
                    Articles
                </a>
            </div>

            <!-- Right: Contact Pill with Availability Status Indicator -->
            <div class="hidden sm:flex items-center gap-3">
                <a 
                    href="{{ route('contact.index') }}" 
                    class="relative group flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#151311] hover:bg-[#1E1A17] border border-[#2A2520] hover:border-[#C45A19] transition-all duration-200 text-xs font-mono uppercase tracking-wider text-[#F5F1EA]"
                >
                    <span>Contact</span>
                    @if($isAvailable)
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#E47A2E] opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-[#C45A19]"></span>
                        </span>
                    @else
                        <span class="inline-flex rounded-full h-2 w-2 bg-[#9E958B]"></span>
                    @endif
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="md:hidden flex items-center">
                <button 
                    @click="mobileOpen = !mobileOpen" 
                    type="button" 
                    class="p-2 rounded-full text-[#9E958B] hover:text-[#F5F1EA] hover:bg-[#151311] border border-transparent focus:outline-none focus:border-[#C45A19] transition"
                    aria-label="Toggle Navigation Menu"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </nav>
    </div>

    <!-- Mobile Drawer Overlay -->
    <div 
        x-show="mobileOpen" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        @click.away="mobileOpen = false"
        class="md:hidden pointer-events-auto mt-3 max-w-sm mx-auto bg-[#0E0D0C]/95 backdrop-blur-2xl border border-[#2A2520] rounded-2xl p-4 shadow-2xl"
    >
        <div class="flex flex-col space-y-1 text-sm font-mono uppercase tracking-wider">
            <a href="{{ route('home') }}" @click="mobileOpen = false" class="px-3 py-2 rounded-lg {{ request()->routeIs('home') ? 'bg-[#1E1A17] text-[#E47A2E] font-semibold' : 'text-[#9E958B] hover:text-[#F5F1EA] hover:bg-[#151311]' }}">
                Home
            </a>
            <a href="{{ route('about') }}" @click="mobileOpen = false" class="px-3 py-2 rounded-lg {{ request()->routeIs('about') ? 'bg-[#1E1A17] text-[#E47A2E] font-semibold' : 'text-[#9E958B] hover:text-[#F5F1EA] hover:bg-[#151311]' }}">
                About
            </a>
            <a href="{{ route('projects.index') }}" @click="mobileOpen = false" class="px-3 py-2 rounded-lg {{ request()->routeIs('projects.*') ? 'bg-[#1E1A17] text-[#E47A2E] font-semibold' : 'text-[#9E958B] hover:text-[#F5F1EA] hover:bg-[#151311]' }}">
                Work
            </a>
            <a href="{{ route('journey.index') }}" @click="mobileOpen = false" class="px-3 py-2 rounded-lg {{ request()->routeIs('journey.*') ? 'bg-[#1E1A17] text-[#E47A2E] font-semibold' : 'text-[#9E958B] hover:text-[#F5F1EA] hover:bg-[#151311]' }}">
                Journey
            </a>
            <a href="{{ route('skills.index') }}" @click="mobileOpen = false" class="px-3 py-2 rounded-lg {{ request()->routeIs('skills.*') ? 'bg-[#1E1A17] text-[#E47A2E] font-semibold' : 'text-[#9E958B] hover:text-[#F5F1EA] hover:bg-[#151311]' }}">
                Skills
            </a>
            <a href="{{ route('certificates.index') }}" @click="mobileOpen = false" class="px-3 py-2 rounded-lg {{ request()->routeIs('certificates.*') ? 'bg-[#1E1A17] text-[#E47A2E] font-semibold' : 'text-[#9E958B] hover:text-[#F5F1EA] hover:bg-[#151311]' }}">
                Certificates
            </a>
            <a href="{{ route('achievements.index') }}" @click="mobileOpen = false" class="px-3 py-2 rounded-lg {{ request()->routeIs('achievements.*') ? 'bg-[#1E1A17] text-[#E47A2E] font-semibold' : 'text-[#9E958B] hover:text-[#F5F1EA] hover:bg-[#151311]' }}">
                Achievements
            </a>
            <a href="{{ route('articles.index') }}" @click="mobileOpen = false" class="px-3 py-2 rounded-lg {{ request()->routeIs('articles.*') ? 'bg-[#1E1A17] text-[#E47A2E] font-semibold' : 'text-[#9E958B] hover:text-[#F5F1EA] hover:bg-[#151311]' }}">
                Articles
            </a>
            <div class="pt-2 border-t border-[#2A2520]">
                <a href="{{ route('contact.index') }}" @click="mobileOpen = false" class="flex items-center justify-between px-3 py-2 rounded-lg bg-[#C45A19] text-[#F5F1EA] font-semibold hover:bg-[#E47A2E] transition">
                    <span>Get in Touch</span>
                    <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                </a>
            </div>
        </div>
    </div>
</header>
