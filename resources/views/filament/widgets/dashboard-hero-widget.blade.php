<x-filament-widgets::widget>
    <div class="bg-[#151311] border border-[#2A2520] rounded-2xl p-6 lg:p-7 relative overflow-hidden">
        {{-- Subtle background radial glow --}}
        <div class="absolute top-0 right-0 w-80 h-80 bg-[#C45A19]/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            {{-- Left: Greeting & Status --}}
            <div class="space-y-3">
                <div class="flex flex-wrap items-center gap-2.5">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-mono font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        SYSTEM ONLINE
                    </span>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-mono font-medium bg-[#1E1A17] text-[#E47A2E] border border-[#2A2520] uppercase">
                        ENV: {{ app()->environment() }}
                    </span>
                    <span class="text-xs font-mono text-[#9E958B]">
                        {{ now()->format('l, d M Y') }}
                    </span>
                </div>

                <div>
                    <h1 class="font-heading text-2xl lg:text-3xl font-bold text-[#F5F1EA] tracking-tight">
                        Welcome back, {{ auth()->user()->name ?? 'Helmy' }}.
                    </h1>
                    <p class="text-sm text-[#9E958B] mt-1">
                        Kelola portfolio, projects, dan informasi personal kamu dari sini.
                    </p>
                </div>
            </div>

            {{-- Right: Quick Actions Group --}}
            <div class="space-y-2 pt-2 lg:pt-0 lg:text-right">
                <span class="text-[11px] font-mono text-[#9E958B] block">
                    Tambahkan content baru ke portfolio kamu.
                </span>
                <div class="flex flex-wrap items-center gap-2 lg:justify-end">
                    <a href="{{ \App\Filament\Resources\Projects\ProjectResource::getUrl('create') }}" 
                       class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-medium font-mono bg-[#C45A19] hover:bg-[#E47A2E] text-[#F5F1EA] shadow-sm transition-all duration-200">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>+ Add Project</span>
                    </a>

                <a href="{{ \App\Filament\Resources\Skills\SkillResource::getUrl('create') }}" 
                   class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-medium font-mono bg-[#1E1A17] hover:bg-[#2A2520] text-[#F5F1EA] border border-[#2A2520] transition-all duration-200">
                    <svg class="w-3.5 h-3.5 text-[#C45A19]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>+ Add Skill</span>
                </a>

                <a href="{{ \App\Filament\Resources\Certificates\CertificateResource::getUrl('create') }}" 
                   class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-medium font-mono bg-[#1E1A17] hover:bg-[#2A2520] text-[#F5F1EA] border border-[#2A2520] transition-all duration-200">
                    <svg class="w-3.5 h-3.5 text-[#C45A19]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>+ Add Certificate</span>
                </a>

                <a href="{{ \App\Filament\Resources\Achievements\AchievementResource::getUrl('create') }}" 
                   class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-medium font-mono bg-[#1E1A17] hover:bg-[#2A2520] text-[#F5F1EA] border border-[#2A2520] transition-all duration-200">
                    <svg class="w-3.5 h-3.5 text-[#C45A19]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>+ Add Achievement</span>
                </a>

                <a href="{{ route('home') }}" target="_blank"
                   class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-medium font-mono text-[#9E958B] hover:text-[#F5F1EA] hover:bg-[#1E1A17] border border-transparent hover:border-[#2A2520] transition-all duration-200">
                    <span>Live Site</span>
                    <svg class="w-3 h-3 text-[#C45A19]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
