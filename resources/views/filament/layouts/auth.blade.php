@props([
    'livewire' => null,
])

<x-filament-panels::layout.base :livewire="$livewire">
    <div class="zephyr-login-root min-h-screen bg-[#080808] text-[#F5F1EA] flex flex-col justify-center items-center p-4 sm:p-6 lg:p-8 selection:bg-[#C45A19] selection:text-[#F5F1EA] relative overflow-hidden">
        {{-- Background Ambient Glow & Grid --}}
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-[#C45A19]/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-[#E47A2E]/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.025] bg-[linear-gradient(to_right,#F5F1EA_1px,transparent_1px),linear-gradient(to_bottom,#F5F1EA_1px,transparent_1px)] bg-[size:32px_32px] pointer-events-none"></div>

        <div class="w-full max-w-5xl bg-[#0E0D0C] border border-[#2A2520] rounded-2xl sm:rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-12 relative z-10">
            
            {{-- Left Brand & Technical Visual Panel (Desktop / Tablet) --}}
            <div class="lg:col-span-5 bg-gradient-to-br from-[#0B0A09] via-[#0E0D0C] to-[#151311] p-6 sm:p-8 lg:p-10 flex flex-col justify-between border-b lg:border-b-0 lg:border-r border-[#2A2520] relative">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(196,90,25,0.08),transparent_60%)] pointer-events-none"></div>

                {{-- Header Branding --}}
                <div class="relative z-10 space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#151311] border border-[#C45A19]/50 flex items-center justify-center text-[#E47A2E] shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-mono text-[10px] uppercase tracking-widest text-[#9E958B] block">Control Surface</span>
                            <h1 class="font-heading text-lg sm:text-xl font-bold tracking-tight text-[#F5F1EA]">
                                ZEPHYR <span class="text-[#C45A19]">ADMIN</span>
                            </h1>
                        </div>
                    </div>

                    <div class="space-y-2 pt-2 sm:pt-4">
                        <span class="font-mono text-[11px] text-[#C45A19] uppercase tracking-wider block font-semibold">ZEPHYR ADMIN SYSTEM</span>
                        <h2 class="font-heading text-2xl sm:text-3xl font-bold text-[#F5F1EA] leading-tight">
                            Manage the things behind the portfolio.
                        </h2>
                        <p class="text-sm text-[#9E958B] leading-relaxed pt-1">
                            Satu tempat untuk manage semua content portfolio kamu.
                        </p>
                    </div>
                </div>

                {{-- Technical Metadata Block --}}
                <div class="relative z-10 pt-6 sm:pt-8 mt-6 border-t border-[#2A2520]/80 space-y-4">
                    <div class="grid grid-cols-2 gap-2.5 text-xs font-mono">
                        <div class="bg-[#151311] border border-[#2A2520] rounded-lg p-2.5">
                            <span class="text-[#9E958B] block text-[9px] uppercase tracking-wider">SYSTEM</span>
                            <span class="text-[#F5F1EA] font-medium text-[11px]">PORTFOLIO CMS</span>
                        </div>
                        <div class="bg-[#151311] border border-[#2A2520] rounded-lg p-2.5">
                            <span class="text-[#9E958B] block text-[9px] uppercase tracking-wider">STATUS</span>
                            <span class="text-emerald-400 font-medium text-[11px] flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                ONLINE
                            </span>
                        </div>
                        <div class="bg-[#151311] border border-[#2A2520] rounded-lg p-2.5">
                            <span class="text-[#9E958B] block text-[9px] uppercase tracking-wider">ENVIRONMENT</span>
                            <span class="text-[#E47A2E] font-medium text-[11px] uppercase">{{ app()->environment() }}</span>
                        </div>
                        <div class="bg-[#151311] border border-[#2A2520] rounded-lg p-2.5">
                            <span class="text-[#9E958B] block text-[9px] uppercase tracking-wider">ACCESS</span>
                            <span class="text-[#F5F1EA] font-medium text-[11px]">RESTRICTED</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-[11px] font-mono text-[#9E958B] pt-1">
                        <span class="text-[#70685F]">v3.0.0 · Core Engine</span>
                        <a href="{{ route('home') }}" class="text-[#C45A19] hover:text-[#E47A2E] flex items-center gap-1 transition-colors font-medium">
                            <span>Kembali ke Public Site</span> &rarr;
                        </a>
                    </div>
                </div>
            </div>

            {{-- Right Authentication Form Panel --}}
            <div class="lg:col-span-7 bg-[#0E0D0C] p-6 sm:p-8 lg:p-12 flex flex-col justify-center relative">
                <div class="w-full max-w-md mx-auto space-y-6">
                    <div>
                        <span class="font-mono text-[11px] uppercase tracking-wider text-[#C45A19] block font-medium">Authentication</span>
                        <h2 class="font-heading text-2xl sm:text-3xl font-bold text-[#F5F1EA] tracking-tight mt-1">
                            Welcome back.
                        </h2>
                        <p class="text-sm text-[#F5F1EA]/90 mt-1 font-medium">
                            Sign in to manage your portfolio.
                        </p>
                        <p class="text-xs text-[#9E958B] mt-1 leading-relaxed">
                            Login untuk mengelola projects, certificates, skills, dan informasi portfolio kamu.
                        </p>
                    </div>

                    <div class="fi-simple-main">
                        {{ $slot }}
                    </div>
                </div>
            </div>

        </div>

        {{-- Footer attribution --}}
        <div class="mt-6 text-center text-xs font-mono text-[#70685F] relative z-10">
            Helmy Yunan Nasution · Zephyr Portfolio CMS
        </div>
    </div>
</x-filament-panels::layout.base>
