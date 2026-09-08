@props([
    'experience',
])

@php
    $startDate = $experience->started_at ? $experience->started_at->format('M Y') : 'Present';
    $endDate = $experience->is_current ? 'Present' : ($experience->ended_at ? $experience->ended_at->format('M Y') : 'Present');
@endphp

<article class="relative flex flex-col md:flex-row gap-6 p-6 sm:p-8 rounded-2xl bg-[#151311] border border-[#2A2520] hover:border-[#C45A19]/50 transition-all duration-300 group">
    <!-- Left Column: Dates & Meta -->
    <div class="md:w-56 shrink-0 flex flex-col justify-between">
        <div>
            <div class="inline-flex items-center gap-2 mb-2">
                @if($experience->experienceType)
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono uppercase tracking-wider bg-[#1E1A17] text-[#E47A2E] border border-[#2A2520]">
                        {{ $experience->experienceType->name }}
                    </span>
                @endif
                @if($experience->is_current)
                    <span class="inline-flex items-center gap-1 text-[10px] font-mono text-emerald-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                        Active
                    </span>
                @endif
            </div>

            <div class="text-xs font-mono text-[#9E958B]">
                {{ $startDate }} — {{ $endDate }}
            </div>

            @if($experience->location)
                <div class="text-xs text-[#70685F] mt-1 font-mono">
                    {{ $experience->location }}
                </div>
            @endif
        </div>

        @if($experience->organization)
            <div class="mt-4 pt-4 border-t border-[#2A2520]/60 hidden md:block">
                <span class="text-xs font-mono uppercase text-[#70685F]">Organization</span>
                <p class="text-sm font-semibold text-[#F5F1EA] truncate">{{ $experience->organization->name }}</p>
            </div>
        @endif
    </div>

    <!-- Right Column: Content -->
    <div class="flex-1 flex flex-col justify-between space-y-4">
        <div class="space-y-2">
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between gap-1">
                <h3 class="text-xl font-heading font-bold text-[#F5F1EA] group-hover:text-[#E47A2E] transition-colors">
                    <a href="{{ route('journey.show', $experience->slug) }}" class="focus:outline-none">
                        {{ $experience->title }}
                    </a>
                </h3>
                <span class="text-sm font-mono text-[#9E958B]">{{ $experience->role }}</span>
            </div>

            <p class="text-sm text-[#9E958B] leading-relaxed line-clamp-3">
                {{ $experience->summary }}
            </p>
        </div>

        <!-- Associated Skills -->
        @if($experience->skills->isNotEmpty())
            <div class="pt-3 border-t border-[#2A2520] flex flex-wrap gap-1.5 items-center">
                @foreach($experience->skills->take(5) as $skill)
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-[#1E1A17] text-[#9E958B] border border-[#2A2520]">
                        {{ $skill->name }}
                    </span>
                @endforeach
                @if($experience->skills->count() > 5)
                    <span class="text-[10px] font-mono text-[#70685F]">
                        +{{ $experience->skills->count() - 5 }} more
                    </span>
                @endif
            </div>
        @endif

        <!-- Case Study Link -->
        <div class="pt-2 flex items-center justify-between">
            <a 
                href="{{ route('journey.show', $experience->slug) }}" 
                class="inline-flex items-center gap-1.5 text-xs font-mono uppercase tracking-wider text-[#E47A2E] group-hover:text-[#F5F1EA] transition-colors"
            >
                <span>Read Full Case Study</span>
                <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>
    </div>
</article>
