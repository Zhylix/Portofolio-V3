<x-layouts.app :title="$experience->title . ' — Journey Case Study'">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Back Navigation -->
        <div class="mb-8">
            <a 
                href="{{ route('journey.index') }}" 
                class="inline-flex items-center gap-2 text-xs font-mono uppercase tracking-wider text-[#9E958B] hover:text-[#E47A2E] transition-colors"
            >
                <span>&larr;</span>
                <span>Back to Journey Timeline</span>
            </a>
        </div>

        <!-- Experience Mini Case Study Header -->
        <article class="space-y-12">
            <header class="p-8 sm:p-12 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-6">
                <div class="flex flex-wrap items-center gap-3">
                    @if($experience->experienceType)
                        <span class="px-3 py-1 rounded-full text-xs font-mono uppercase tracking-wider bg-[#1E1A17] text-[#E47A2E] border border-[#2A2520]">
                            {{ $experience->experienceType->name }}
                        </span>
                    @endif

                    @if($experience->is_current)
                        <span class="px-3 py-1 rounded-full text-xs font-mono uppercase tracking-wider bg-emerald-950/50 text-emerald-400 border border-emerald-800/40">
                            Active Position
                        </span>
                    @endif
                </div>

                <h1 class="text-3xl sm:text-5xl font-heading font-extrabold text-[#F5F1EA] tracking-tight leading-tight">
                    {{ $experience->title }}
                </h1>

                <div class="flex flex-wrap items-center gap-y-2 gap-x-6 text-sm font-mono text-[#9E958B]">
                    <span class="text-[#F5F1EA] font-semibold">{{ $experience->role }}</span>
                    @if($experience->organization)
                        <span>&bull; {{ $experience->organization->name }}</span>
                    @endif
                    @if($experience->location)
                        <span>&bull; {{ $experience->location }}</span>
                    @endif
                </div>

                <!-- Date Range -->
                <div class="text-xs font-mono text-[#E47A2E] pt-2">
                    {{ $experience->started_at ? $experience->started_at->format('F Y') : 'Start' }} — 
                    {{ $experience->is_current ? 'Present' : ($experience->ended_at ? $experience->ended_at->format('F Y') : 'Ongoing') }}
                </div>

                <p class="text-base sm:text-lg text-[#F5F1EA] leading-relaxed pt-2 border-t border-[#2A2520]">
                    {{ $experience->summary }}
                </p>
            </header>

            <!-- Contributions & Impact -->
            @if($experience->contribution)
                <div class="p-8 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-3">
                    <h3 class="text-xs font-mono uppercase tracking-widest text-[#E47A2E]">Primary Contribution</h3>
                    <h4 class="text-xl font-heading font-bold text-[#F5F1EA]">What Was Built & Delivered</h4>
                    <p class="text-sm text-[#9E958B] leading-relaxed">
                        {{ $experience->contribution }}
                    </p>
                </div>
            @endif

            <!-- Challenge & Solution Grid -->
            @if($experience->challenge || $experience->solution)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @if($experience->challenge)
                        <div class="p-8 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-3">
                            <h3 class="text-xs font-mono uppercase tracking-widest text-[#E47A2E]">The Challenge</h3>
                            <h4 class="text-lg font-heading font-bold text-[#F5F1EA]">Technical Hurdles</h4>
                            <p class="text-sm text-[#9E958B] leading-relaxed">
                                {{ $experience->challenge }}
                            </p>
                        </div>
                    @endif

                    @if($experience->solution)
                        <div class="p-8 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-3">
                            <h3 class="text-xs font-mono uppercase tracking-widest text-emerald-400">The Solution</h3>
                            <h4 class="text-lg font-heading font-bold text-[#F5F1EA]">Strategy & Implementation</h4>
                            <p class="text-sm text-[#9E958B] leading-relaxed">
                                {{ $experience->solution }}
                            </p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Outcome -->
            @if($experience->outcome)
                <div class="p-8 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-3">
                    <h3 class="text-xs font-mono uppercase tracking-widest text-emerald-400">Measurable Outcome</h3>
                    <h4 class="text-xl font-heading font-bold text-[#F5F1EA]">Results & Production Impact</h4>
                    <p class="text-sm text-[#9E958B] leading-relaxed">
                        {{ $experience->outcome }}
                    </p>
                </div>
            @endif

            <!-- Full Narrative Description -->
            @if($experience->description)
                <div class="p-8 sm:p-10 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-4">
                    <h3 class="text-2xl font-heading font-bold text-[#F5F1EA]">Detailed Narrative</h3>
                    <div class="prose prose-invert max-w-none text-[#9E958B] leading-relaxed font-sans space-y-3">
                        {!! nl2br(e($experience->description)) !!}
                    </div>
                </div>
            @endif

            <!-- Related Artifacts (Skills, Projects, Achievements, Certificates) -->
            <div class="p-8 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-6 reveal-on-scroll">
                <h3 class="text-xl font-heading font-bold text-[#F5F1EA]">Associated Systems & Evidence</h3>

                <!-- Skills -->
                @if($experience->skills->isNotEmpty())
                    <div>
                        <h4 class="text-xs font-mono uppercase tracking-wider text-[#70685F] mb-3">Applied Skills</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($experience->skills as $skill)
                                <a 
                                    href="{{ route('skills.index') }}" 
                                    class="px-3 py-1 rounded-full text-xs font-mono bg-[#1E1A17] text-[#F5F1EA] border border-[#2A2520] hover:border-[#C45A19] hover:text-[#E47A2E] transition"
                                >
                                    {{ $skill->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Projects -->
                @if($experience->projects->isNotEmpty())
                    <div class="pt-4 border-t border-[#2A2520]">
                        <h4 class="text-xs font-mono uppercase tracking-wider text-[#70685F] mb-3">Related Projects Built</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($experience->projects as $proj)
                                <a 
                                    href="{{ route('projects.show', $proj->slug) }}" 
                                    data-cursor="view"
                                    class="p-4 rounded-2xl bg-[#0E0D0C] border border-[#2A2520] hover:border-[#C45A19] transition block group"
                                >
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-semibold text-[#F5F1EA] group-hover:text-[#E47A2E] transition-colors">{{ $proj->title }}</span>
                                        <span class="text-xs font-mono text-[#E47A2E]">&rarr;</span>
                                    </div>
                                    <span class="text-xs text-[#9E958B] line-clamp-2">{{ $proj->short_description }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Certificates -->
                @if($experience->certificates->isNotEmpty())
                    <div class="pt-4 border-t border-[#2A2520]">
                        <h4 class="text-xs font-mono uppercase tracking-wider text-[#70685F] mb-3">Verified Certificates</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($experience->certificates as $cert)
                                <a 
                                    href="{{ $cert->credential_url ?? route('certificates.index') }}" 
                                    target="{{ $cert->credential_url ? '_blank' : '_self' }}"
                                    data-cursor="explore"
                                    class="p-4 rounded-2xl bg-[#0E0D0C] border border-[#2A2520] hover:border-[#C45A19] transition block group"
                                >
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-semibold text-[#F5F1EA] group-hover:text-[#E47A2E] transition-colors">{{ $cert->title }}</span>
                                        <span class="text-xs font-mono text-[#70685F]">{{ $cert->issuer }}</span>
                                    </div>
                                    @if($cert->credential_id)
                                        <span class="text-[10px] font-mono text-[#70685F] block">ID: {{ $cert->credential_id }}</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Achievements -->
                @if($experience->achievements->isNotEmpty())
                    <div class="pt-4 border-t border-[#2A2520]">
                        <h4 class="text-xs font-mono uppercase tracking-wider text-[#70685F] mb-3">Distinctions & Honors</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($experience->achievements as $ach)
                                <a 
                                    href="{{ $ach->url ?? route('achievements.index') }}" 
                                    target="{{ $ach->url ? '_blank' : '_self' }}"
                                    data-cursor="explore"
                                    class="p-4 rounded-2xl bg-[#0E0D0C] border border-[#2A2520] hover:border-[#C45A19] transition block group"
                                >
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-semibold text-[#F5F1EA] group-hover:text-[#E47A2E] transition-colors">{{ $ach->title }}</span>
                                        <span class="text-xs font-mono text-[#E47A2E]">{{ $ach->rank ?? 'Awarded' }}</span>
                                    </div>
                                    <span class="text-xs text-[#9E958B] line-clamp-1">{{ $ach->organization }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </article>
    </div>
</x-layouts.app>
