@props([
    'skill',
])

@php
    $modalId = 'skill-modal-' . $skill->id;
    $evidenceCount = $skill->evidence_count ?? 0;
@endphp

<div x-data class="relative">
    <!-- Clickable Interactive Skill Card -->
    <button 
        type="button" 
        @click="$dispatch('open-modal', '{{ $modalId }}')"
        class="w-full text-left p-5 rounded-2xl bg-[#151311] border border-[#2A2520] hover:border-[#C45A19]/60 hover:bg-[#1E1A17] transition-all duration-200 group flex flex-col justify-between h-full shadow-sm hover:shadow-lg hover:shadow-[#C45A19]/5"
    >
        <div class="flex items-start justify-between w-full mb-3">
            <div class="w-10 h-10 rounded-xl bg-[#0E0D0C] border border-[#2A2520] group-hover:border-[#C45A19] flex items-center justify-center text-sm font-mono font-bold text-[#E47A2E] transition-colors">
                @if($skill->icon)
                    <span class="text-xs">{{ substr($skill->name, 0, 3) }}</span>
                @else
                    <span class="text-xs">{{ substr($skill->name, 0, 2) }}</span>
                @endif
            </div>

            @if($skill->featured)
                <span class="px-2 py-0.5 rounded-full text-[9px] font-mono uppercase tracking-wider bg-[#C45A19]/15 text-[#E47A2E] border border-[#C45A19]/30">
                    Core
                </span>
            @endif
        </div>

        <div>
            <h4 class="text-base font-heading font-bold text-[#F5F1EA] group-hover:text-[#E47A2E] transition-colors">
                {{ $skill->name }}
            </h4>
            <p class="text-xs text-[#9E958B] mt-1 line-clamp-2">
                {{ $skill->description ?? 'Empirical system engineering and architectural proficiency.' }}
            </p>
        </div>

        <div class="mt-4 pt-3 border-t border-[#2A2520] flex items-center justify-between text-[11px] font-mono text-[#70685F] group-hover:text-[#9E958B]">
            <span>{{ $evidenceCount }} Evidence {{ Str::plural('Artifact', $evidenceCount) }}</span>
            <span class="text-[#E47A2E] group-hover:translate-x-1 transition-transform">&rarr;</span>
        </div>
    </button>

    <!-- Modal Detail for this Skill -->
    <x-modal :name="$modalId" :title="$skill->name" maxWidth="3xl">
        <div class="space-y-6 text-left">
            <!-- Category & Badge -->
            <div class="flex items-center gap-2">
                <span class="px-3 py-1 rounded-full text-xs font-mono uppercase tracking-wider bg-[#1E1A17] text-[#E47A2E] border border-[#2A2520]">
                    {{ $skill->category->name ?? 'Core Capability' }}
                </span>
                @if($skill->featured)
                    <span class="px-3 py-1 rounded-full text-xs font-mono uppercase tracking-wider bg-[#C45A19]/20 text-[#E47A2E] border border-[#C45A19]/40">
                        Featured Skill
                    </span>
                @endif
            </div>

            <!-- Description -->
            <div>
                <h5 class="text-xs font-mono uppercase tracking-widest text-[#70685F] mb-1">Architecture & Domain Context</h5>
                <p class="text-sm text-[#F5F1EA] leading-relaxed">
                    {{ $skill->description ?? 'Demonstrated production experience and architectural mastery across production workloads.' }}
                </p>
            </div>

            <!-- Related Projects -->
            @if($skill->projects->isNotEmpty())
                <div class="pt-4 border-t border-[#2A2520]">
                    <h5 class="text-xs font-mono uppercase tracking-widest text-[#E47A2E] mb-3">
                        Related Projects & Systems ({{ $skill->projects->count() }})
                    </h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($skill->projects as $project)
                            <a 
                                href="{{ route('projects.show', $project->slug) }}" 
                                class="p-3 rounded-xl bg-[#151311] border border-[#2A2520] hover:border-[#C45A19] transition block group/item"
                            >
                                <span class="text-sm font-semibold text-[#F5F1EA] group-hover/item:text-[#E47A2E] block truncate">
                                    {{ $project->title }}
                                </span>
                                <span class="text-xs text-[#9E958B] line-clamp-1 mt-0.5">
                                    {{ $project->short_description }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Related Experiences -->
            @if($skill->experiences->isNotEmpty())
                <div class="pt-4 border-t border-[#2A2520]">
                    <h5 class="text-xs font-mono uppercase tracking-widest text-[#E47A2E] mb-3">
                        Professional Journey Deployments ({{ $skill->experiences->count() }})
                    </h5>
                    <div class="space-y-2">
                        @foreach($skill->experiences as $exp)
                            <a 
                                href="{{ route('journey.show', $exp->slug) }}" 
                                class="flex items-center justify-between p-3 rounded-xl bg-[#151311] border border-[#2A2520] hover:border-[#C45A19] transition group/exp"
                            >
                                <div>
                                    <span class="text-sm font-semibold text-[#F5F1EA] group-hover/exp:text-[#E47A2E] block">
                                        {{ $exp->title }}
                                    </span>
                                    <span class="text-xs text-[#70685F] font-mono">
                                        {{ $exp->role }} &bull; {{ $exp->organization->name ?? 'Organization' }}
                                    </span>
                                </div>
                                <span class="text-xs font-mono text-[#E47A2E]">&rarr;</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Related Certificates & Achievements -->
            @if($skill->certificates->isNotEmpty() || $skill->achievements->isNotEmpty())
                <div class="pt-4 border-t border-[#2A2520] grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @if($skill->certificates->isNotEmpty())
                        <div>
                            <h5 class="text-xs font-mono uppercase tracking-widest text-[#70685F] mb-2">Verified Credentials</h5>
                            <ul class="space-y-1.5 text-xs text-[#9E958B]">
                                @foreach($skill->certificates as $cert)
                                    <li class="flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#E47A2E]"></span>
                                        <span class="text-[#F5F1EA] font-medium">{{ $cert->title }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($skill->achievements->isNotEmpty())
                        <div>
                            <h5 class="text-xs font-mono uppercase tracking-widest text-[#70685F] mb-2">Honors & Awards</h5>
                            <ul class="space-y-1.5 text-xs text-[#9E958B]">
                                @foreach($skill->achievements as $ach)
                                    <li class="flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#C45A19]"></span>
                                        <span class="text-[#F5F1EA] font-medium">{{ $ach->title }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </x-modal>
</div>
