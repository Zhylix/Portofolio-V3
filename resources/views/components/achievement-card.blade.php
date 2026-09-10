@props([
    'achievement',
])

@php
    $modalId = 'ach-modal-' . $achievement->id;
    $achDate = $achievement->date ? $achievement->date->format('M Y') : 'N/A';
@endphp

<div x-data class="relative">
    <div class="p-6 rounded-2xl bg-[#151311] border border-[#2A2520] hover:border-[#C45A19]/50 transition-all duration-300 flex flex-col justify-between h-full group hover:shadow-xl hover:shadow-[#C45A19]/5">
        <div class="space-y-4">
            <!-- Header with Rank / Result Badge -->
            <div class="flex items-start justify-between gap-3">
                <span class="px-2.5 py-1 rounded-full text-xs font-mono uppercase tracking-wider bg-[#1E1A17] text-[#E47A2E] border border-[#2A2520]">
                    {{ $achievement->rank ?? 'Award of Honor' }}
                </span>

                @if($achievement->featured)
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-mono uppercase tracking-wider bg-[#C45A19]/20 text-[#E47A2E] border border-[#C45A19]/30">
                        Distinction
                    </span>
                @endif
            </div>

            <!-- Title & Organization -->
            <div>
                <h4 class="text-lg font-heading font-bold text-[#F5F1EA] group-hover:text-[#E47A2E] transition-colors leading-snug">
                    {{ $achievement->title }}
                </h4>
                @if($achievement->organization)
                    <p class="text-xs font-mono text-[#70685F] mt-1">
                        {{ $achievement->organization }}
                    </p>
                @endif
            </div>

            <p class="text-xs text-[#9E958B] leading-relaxed line-clamp-2">
                {{ $achievement->description }}
            </p>
        </div>

        <!-- Footer Meta & Actions -->
        <div class="mt-6 pt-4 border-t border-[#2A2520] flex items-center justify-between text-xs font-mono">
            <span class="text-[#70685F]">{{ $achDate }}</span>

            <button 
                type="button" 
                @click="$dispatch('open-modal', '{{ $modalId }}')"
                class="inline-flex items-center gap-1 text-[#E47A2E] hover:text-[#F5F1EA] transition-colors font-medium"
            >
                <span>See Details</span>
                <span>&rarr;</span>
            </button>
        </div>
    </div>

    <!-- Modal for Achievement Details -->
    <x-modal :name="$modalId" :title="$achievement->title">
        <div class="space-y-6 text-left">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-xl bg-[#151311] border border-[#2A2520] text-xs font-mono">
                <div>
                    <span class="text-[#70685F] block">Conferring Body</span>
                    <span class="text-[#F5F1EA] font-semibold text-sm">{{ $achievement->organization ?? 'Official Board' }}</span>
                </div>
                <div>
                    <span class="text-[#70685F] block">Date Awarded</span>
                    <span class="text-[#F5F1EA] font-semibold text-sm">{{ $achDate }}</span>
                </div>
                @if($achievement->result)
                    <div class="sm:col-span-2">
                        <span class="text-[#70685F] block">Official Result</span>
                        <span class="text-[#E47A2E] font-semibold">{{ $achievement->result }}</span>
                    </div>
                @endif
            </div>

            @if($achievement->image_url)
                <div class="rounded-xl overflow-hidden border border-[#2A2520] bg-[#0E0D0C]">
                    <img 
                        src="{{ $achievement->image_url }}" 
                        alt="{{ $achievement->title }} award" 
                        loading="lazy" 
                        decoding="async" 
                        width="800" 
                        height="560" 
                        class="w-full max-h-80 object-contain"
                    >
                </div>
            @endif

            @if($achievement->description)
                <div>
                    <h5 class="text-xs font-mono uppercase tracking-widest text-[#70685F] mb-1">Impact & Narrative</h5>
                    <p class="text-sm text-[#9E958B] leading-relaxed">
                        {{ $achievement->description }}
                    </p>
                </div>
            @endif

            @if($achievement->url)
                <div class="pt-4 border-t border-[#2A2520]">
                    <a 
                        href="{{ $achievement->url }}" 
                        target="_blank" 
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 text-xs font-mono uppercase tracking-wider text-[#E47A2E] hover:text-[#F5F1EA] transition"
                    >
                        <span>Official Publication / Announcement</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                </div>
            @endif
        </div>
    </x-modal>
</div>
