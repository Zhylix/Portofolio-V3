@props([
    'project',
])

@php
    $imageUrl = $project->getFirstMediaUrl('featured_image') ?: $project->getFirstMediaUrl();
@endphp

<article data-cursor="view" class="group relative flex flex-col bg-[#151311] border border-[#2A2520] hover:border-[#C45A19]/60 rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-[#C45A19]/10">
    <!-- Project Media / Thumbnail with zoom -->
    <div data-cursor="view" class="relative h-48 sm:h-56 w-full overflow-hidden bg-[#0E0D0C] border-b border-[#2A2520]">
        @if($imageUrl)
            <img 
                src="{{ $imageUrl }}" 
                alt="{{ $project->title }}" 
                loading="lazy"
                class="w-full h-full object-cover object-center transform group-hover:scale-105 transition-transform duration-500"
            />
        @else
            <!-- Elegant Dark Abstract Blueprint Pattern -->
            <div class="w-full h-full flex flex-col items-center justify-center p-6 bg-gradient-to-br from-[#151311] via-[#0E0D0C] to-[#1E1A17] relative overflow-hidden">
                <div class="absolute inset-0 bg-grid-subtle opacity-30"></div>
                <div class="relative z-10 flex flex-col items-center text-center">
                    <span class="w-12 h-12 rounded-xl bg-[#1E1A17] border border-[#2A2520] group-hover:border-[#C45A19] flex items-center justify-center text-lg font-mono font-bold text-[#E47A2E] mb-2 transform group-hover:scale-110 transition-transform duration-300">
                        {{ strtoupper(substr($project->slug, 0, 2)) }}
                    </span>
                    <span class="text-xs font-mono uppercase tracking-widest text-[#70685F]">
                        {{ $project->category->name ?? 'System Architecture' }}
                    </span>
                </div>
            </div>
        @endif

        <!-- Top Badges -->
        <div class="absolute top-3 inset-x-3 flex items-center justify-between pointer-events-none z-10">
            @if($project->category)
                <span class="px-2.5 py-1 rounded-full text-[10px] font-mono uppercase tracking-wider bg-[#080808]/85 text-[#E47A2E] border border-[#2A2520] backdrop-blur-md">
                    {{ $project->category->name }}
                </span>
            @endif

            @if($project->featured)
                <span class="px-2.5 py-1 rounded-full text-[10px] font-mono uppercase tracking-wider bg-[#C45A19]/90 text-white font-semibold backdrop-blur-md">
                    Featured
                </span>
            @endif
        </div>
    </div>

    <!-- Content Area -->
    <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
        <div class="space-y-2">
            <h3 class="text-xl font-heading font-bold text-[#F5F1EA] group-hover:text-[#E47A2E] transition-colors leading-tight">
                <a href="{{ route('projects.show', $project->slug) }}" class="focus:outline-none">
                    {{ $project->title }}
                </a>
            </h3>

            <p class="text-sm text-[#9E958B] line-clamp-2 leading-relaxed">
                {{ $project->short_description }}
            </p>
        </div>

        <!-- Tech Stack Tags -->
        <div class="pt-2 border-t border-[#2A2520] flex flex-wrap gap-1.5 items-center">
            @foreach($project->technologies->take(4) as $tech)
                <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-[#1E1A17] text-[#9E958B] border border-[#2A2520]">
                    {{ $tech->name }}
                </span>
            @endforeach
            @if($project->technologies->count() > 4)
                <span class="text-[10px] font-mono text-[#70685F]">
                    +{{ $project->technologies->count() - 4 }}
                </span>
            @endif
        </div>

        <!-- Action / Case Study Link -->
        <div class="pt-2 flex items-center justify-between">
            <a 
                href="{{ route('projects.show', $project->slug) }}" 
                class="inline-flex items-center gap-1.5 text-xs font-mono uppercase tracking-wider text-[#E47A2E] group-hover:text-[#F5F1EA] transition-colors"
            >
                <span>Case Study</span>
                <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>

            @if($project->demo_url || $project->github_url)
                <div class="flex items-center gap-2">
                    @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="text-[#70685F] hover:text-[#F5F1EA] p-1 transition" title="Source Code">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                        </a>
                    @endif
                    @if($project->demo_url)
                        <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="text-[#70685F] hover:text-[#E47A2E] p-1 transition" title="Live System Demo">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</article>
