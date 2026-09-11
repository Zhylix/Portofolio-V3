@php
    $health = $this->getHealthData();
@endphp

<x-filament-widgets::widget>
    <div class="bg-[#151311] border border-[#2A2520] rounded-2xl p-5 sm:p-6 flex flex-col justify-between h-full space-y-5">
        {{-- Header --}}
        <div class="flex items-center justify-between pb-4 border-b border-[#2A2520]">
            <div>
                <span class="font-mono text-[10px] uppercase tracking-wider text-[#C45A19] block font-medium">Overview</span>
                <h2 class="font-heading text-lg font-bold text-[#F5F1EA]">Content Health</h2>
                <p class="text-xs text-[#9E958B] mt-0.5">Status kelengkapan data portfolio kamu.</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-[10px] font-mono px-2 py-0.5 rounded {{ $health['seoStatus'] === 'Complete' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-amber-500/10 text-amber-400 border border-amber-500/20' }}">
                    SEO: {{ $health['seoStatus'] }}
                </span>
            </div>
        </div>

        {{-- Profile Completion Progress Bar --}}
        <div class="bg-[#0E0D0C] border border-[#2A2520] rounded-xl p-4 space-y-2.5">
            <div class="flex items-center justify-between text-xs font-mono">
                <span class="text-[#9E958B] uppercase tracking-wider font-medium">Profile Completion</span>
                <span class="text-[#E47A2E] font-bold">{{ $health['completionPercentage'] }}%</span>
            </div>

            {{-- Progress Bar --}}
            <div class="w-full h-2 rounded-full bg-[#1E1A17] overflow-hidden border border-[#2A2520]">
                <div class="h-full bg-gradient-to-r from-[#C45A19] to-[#E47A2E] rounded-full transition-all duration-500" 
                     style="width: {{ $health['completionPercentage'] }}%"></div>
            </div>

            @if (!empty($health['missingItems']))
                <div class="pt-1 text-[11px] font-mono text-[#9E958B]">
                    <span class="text-[#70685F] block mb-1">Lengkapi profile kamu:</span>
                    <ul class="space-y-0.5">
                        @foreach (array_slice($health['missingItems'], 0, 2) as $missing)
                            <li class="flex items-center gap-1.5 text-[#E47A2E]">
                                <span>&rarr;</span>
                                <span>{{ $missing }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="pt-1 text-[11px] font-mono text-emerald-400 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Semua data utama profile kamu sudah lengkap & terverifikasi!</span>
                </div>
            @endif
        </div>

        {{-- Content Domain Metrics Grid --}}
        <div class="grid grid-cols-2 gap-2 text-xs font-mono">
            <div class="bg-[#0E0D0C] border border-[#2A2520] rounded-lg p-2.5 flex items-center justify-between">
                <span class="text-[#9E958B]">Projects</span>
                <span class="text-[#F5F1EA] font-bold">{{ $health['counts']['projects'] }}</span>
            </div>
            <div class="bg-[#0E0D0C] border border-[#2A2520] rounded-lg p-2.5 flex items-center justify-between">
                <span class="text-[#9E958B]">Skills</span>
                <span class="text-[#F5F1EA] font-bold">{{ $health['counts']['skills'] }}</span>
            </div>
            <div class="bg-[#0E0D0C] border border-[#2A2520] rounded-lg p-2.5 flex items-center justify-between">
                <span class="text-[#9E958B]">Certificates</span>
                <span class="text-[#F5F1EA] font-bold">{{ $health['counts']['certificates'] }}</span>
            </div>
            <div class="bg-[#0E0D0C] border border-[#2A2520] rounded-lg p-2.5 flex items-center justify-between">
                <span class="text-[#9E958B]">Achievements</span>
                <span class="text-[#F5F1EA] font-bold">{{ $health['counts']['achievements'] }}</span>
            </div>
        </div>

        {{-- Quick Link --}}
        <div class="pt-1 flex items-center justify-between text-xs font-mono text-[#9E958B]">
            <span>Profile Status: <strong class="text-[#F5F1EA]">{{ $health['profileStatus'] }}</strong></span>
            <a href="{{ \App\Filament\Resources\Profiles\ProfileResource::getUrl('index') }}" 
               class="text-[#C45A19] hover:text-[#E47A2E] flex items-center gap-1 transition-colors">
                <span>Manage Profile</span> &rarr;
            </a>
        </div>
    </div>
</x-filament-widgets::widget>
