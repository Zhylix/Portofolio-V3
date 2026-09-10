<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'System Notification') — Helmy Yunan Nasution</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&family=Space+Grotesk:wght@600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#080808] text-[#F5F1EA] font-sans antialiased min-h-screen flex flex-col justify-between relative overflow-x-hidden selection:bg-[#C45A19] selection:text-[#F5F1EA]">

    <!-- Ambient Glows -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden" aria-hidden="true">
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[700px] h-[400px] bg-[radial-gradient(ellipse_at_center,_rgba(196,90,25,0.08)_0%,_rgba(8,8,8,0)_70%)] blur-2xl"></div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[400px] bg-[radial-gradient(ellipse_at_center,_rgba(196,90,25,0.04)_0%,_rgba(8,8,8,0)_70%)] blur-3xl"></div>
        <div class="absolute inset-0 bg-grid-subtle opacity-35"></div>
    </div>

    <!-- Minimal Header -->
    <header class="relative z-10 w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
            <span class="w-8 h-8 rounded-full bg-[#151311] border border-[#2A2520] group-hover:border-[#C45A19] flex items-center justify-center text-xs font-mono font-bold text-[#E47A2E] transition-all">
                HY
            </span>
            <span class="font-heading font-bold text-sm tracking-wider uppercase text-[#F5F1EA] group-hover:text-[#E47A2E] transition-colors">
                HELMY YUNAN NASUTION
            </span>
        </a>

        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#151311] border border-[#2A2520] text-xs font-mono text-[#9E958B]">
            <span class="w-2 h-2 rounded-full @yield('status-dot', 'bg-[#C45A19]') animate-pulse"></span>
            <span>SYSTEM STATUS: @yield('code', 'NOTICE')</span>
        </div>
    </header>

    <!-- Main Content -->
    <main class="relative z-10 flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12" role="alert">
        <div class="max-w-2xl w-full text-center space-y-8">
            
            <!-- Code Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#151311] border border-[#2A2520] font-mono text-xs text-[#E47A2E] tracking-widest uppercase shadow-sm">
                @yield('badge', 'DIAGNOSTIC REPORT')
            </div>

            <!-- Big Error Code -->
            <div class="space-y-2">
                <h1 class="text-7xl sm:text-9xl font-heading font-extrabold text-[#F5F1EA] tracking-tighter leading-none select-none">
                    @yield('code', 'ERR')
                </h1>
                <h2 class="text-2xl sm:text-3xl font-heading font-bold text-[#E47A2E]">
                    @yield('message', 'An unexpected condition occurred')
                </h2>
            </div>

            <!-- Technical Narrative Description -->
            <div class="p-6 sm:p-8 rounded-3xl bg-[#151311]/90 border border-[#2A2520] text-[#9E958B] text-sm sm:text-base leading-relaxed space-y-4 max-w-xl mx-auto shadow-2xl backdrop-blur-md">
                <p>
                    @yield('description', 'The system encountered an unhandled route or state. Please use the navigation controls below to return to active services.')
                </p>

                @hasSection('diagnostic')
                    <div class="p-3 rounded-xl bg-[#0E0D0C] border border-[#2A2520] font-mono text-xs text-left text-[#70685F] overflow-x-auto">
                        @yield('diagnostic')
                    </div>
                @endif
            </div>

            <!-- Action Controls -->
            <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
                @yield('actions')
                
                <a 
                    href="{{ route('home') }}" 
                    class="px-6 py-3 rounded-xl bg-[#C45A19] hover:bg-[#E47A2E] text-white font-mono text-xs uppercase tracking-wider font-semibold transition-all duration-200 shadow-lg shadow-[#C45A19]/25 flex items-center gap-2"
                >
                    <span>Return to Home</span>
                    <span>&rarr;</span>
                </a>

                <a 
                    href="{{ route('projects.index') }}" 
                    class="px-6 py-3 rounded-xl bg-[#151311] hover:bg-[#1E1A17] text-[#F5F1EA] hover:text-[#E47A2E] border border-[#2A2520] hover:border-[#C45A19]/50 font-mono text-xs uppercase tracking-wider font-semibold transition-all duration-200"
                >
                    Explore Projects
                </a>
            </div>

            <!-- Quick Subsystem Links -->
            <nav class="pt-6 border-t border-[#2A2520]/60 flex flex-wrap items-center justify-center gap-6 text-xs font-mono uppercase tracking-wider text-[#70685F]">
                <a href="{{ route('projects.index') }}" class="hover:text-[#E47A2E] transition-colors">Projects</a>
                <span>&bull;</span>
                <a href="{{ route('skills.index') }}" class="hover:text-[#E47A2E] transition-colors">Skills</a>
                <span>&bull;</span>
                <a href="{{ route('achievements.index') }}" class="hover:text-[#E47A2E] transition-colors">Achievements</a>
                <span>&bull;</span>
                <a href="{{ route('certificates.index') }}" class="hover:text-[#E47A2E] transition-colors">Certificates</a>
                <span>&bull;</span>
                <a href="{{ route('contact.index') }}" class="hover:text-[#E47A2E] transition-colors">Contact</a>
            </nav>

        </div>
    </main>

    <!-- Minimal Footer -->
    <footer class="relative z-10 w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center text-xs font-mono text-[#70685F]">
        <span>&copy; {{ date('Y') }} Helmy Yunan Nasution. Distributed Systems &amp; Resilient Software Architecture.</span>
    </footer>

</body>
</html>
