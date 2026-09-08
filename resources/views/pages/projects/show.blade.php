<x-layouts.app :title="$project->title . ' — Case Study'">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Back Navigation -->
        <div class="mb-8">
            <a 
                href="{{ route('projects.index') }}" 
                class="inline-flex items-center gap-2 text-xs font-mono uppercase tracking-wider text-[#9E958B] hover:text-[#E47A2E] transition-colors"
            >
                <span>&larr;</span>
                <span>Back to All Projects</span>
            </a>
        </div>

        <!-- Project Hero Card -->
        <article class="space-y-12">
            <header class="p-8 sm:p-12 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-6 relative overflow-hidden">
                <div class="flex flex-wrap items-center gap-3">
                    @if($project->category)
                        <span class="px-3 py-1 rounded-full text-xs font-mono uppercase tracking-wider bg-[#1E1A17] text-[#E47A2E] border border-[#2A2520]">
                            {{ $project->category->name }}
                        </span>
                    @endif

                    <span class="px-3 py-1 rounded-full text-xs font-mono uppercase tracking-wider bg-[#080808] text-[#9E958B] border border-[#2A2520]">
                        Status: {{ $project->status instanceof \App\Enums\ProjectStatus ? $project->status->label() : ucfirst($project->status) }}
                    </span>

                    @if($project->featured)
                        <span class="px-3 py-1 rounded-full text-xs font-mono uppercase tracking-wider bg-[#C45A19]/20 text-[#E47A2E] border border-[#C45A19]/40 font-semibold">
                            Core Featured Project
                        </span>
                    @endif
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-heading font-extrabold text-[#F5F1EA] tracking-tight leading-tight">
                    {{ $project->title }}
                </h1>

                <p class="text-lg sm:text-xl text-[#9E958B] leading-relaxed max-w-3xl font-sans">
                    {{ $project->short_description }}
                </p>

                <!-- Project Action Buttons -->
                <div class="pt-4 flex flex-wrap items-center gap-4">
                    @if($project->demo_url)
                        <x-button :href="$project->demo_url" target="_blank" rel="noopener noreferrer" variant="primary" size="md">
                            <span>LIVE SYSTEM DEMO</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </x-button>
                    @endif

                    @if($project->github_url)
                        <x-button :href="$project->github_url" target="_blank" rel="noopener noreferrer" variant="secondary" size="md">
                            <span>VIEW SOURCE CODE</span>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                        </x-button>
                    @endif
                </div>

                <!-- Meta Specs Strip -->
                <div class="pt-6 border-t border-[#2A2520] grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs font-mono">
                    @if($project->role)
                        <div>
                            <span class="text-[#70685F] block">Role</span>
                            <span class="text-[#F5F1EA] font-semibold">{{ $project->role }}</span>
                        </div>
                    @endif
                    @if($project->started_at)
                        <div>
                            <span class="text-[#70685F] block">Timeline</span>
                            <span class="text-[#F5F1EA] font-semibold">
                                {{ $project->started_at->format('M Y') }} — {{ $project->ended_at ? $project->ended_at->format('M Y') : 'Active' }}
                            </span>
                        </div>
                    @endif
                    <div>
                        <span class="text-[#70685F] block">Technologies</span>
                        <span class="text-[#E47A2E] font-semibold">{{ $project->technologies->count() }} Libraries / Tools</span>
                    </div>
                </div>
            </header>

            <!-- Problem & Solution Split Cards -->
            @if($project->problem || $project->solution)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @if($project->problem)
                        <div class="p-8 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-4">
                            <div class="inline-flex items-center gap-2 text-xs font-mono uppercase tracking-widest text-[#E47A2E]">
                                <span class="w-2 h-2 rounded-full bg-[#E47A2E]"></span>
                                The Engineering Problem
                            </div>
                            <h3 class="text-xl font-heading font-bold text-[#F5F1EA]">Challenges & Bottlenecks</h3>
                            <p class="text-sm text-[#9E958B] leading-relaxed">
                                {{ $project->problem }}
                            </p>
                        </div>
                    @endif

                    @if($project->solution)
                        <div class="p-8 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-4">
                            <div class="inline-flex items-center gap-2 text-xs font-mono uppercase tracking-widest text-emerald-400">
                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                The Implemented Solution
                            </div>
                            <h3 class="text-xl font-heading font-bold text-[#F5F1EA]">Architectural Strategy</h3>
                            <p class="text-sm text-[#9E958B] leading-relaxed">
                                {{ $project->solution }}
                            </p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Architecture Specification -->
            @if($project->architecture)
                <div class="p-8 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-4">
                    <div class="inline-flex items-center gap-2 text-xs font-mono uppercase tracking-widest text-[#E47A2E]">
                        <span class="w-2 h-2 rounded-full bg-[#C45A19]"></span>
                        Architecture & Flow Specification
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-[#F5F1EA]">System Blueprint</h3>
                    <div class="p-4 rounded-xl bg-[#0E0D0C] border border-[#2A2520] font-mono text-xs text-[#9E958B] whitespace-pre-line leading-relaxed">
                        {{ $project->architecture }}
                    </div>
                </div>
            @endif

            <!-- Features & Capabilities -->
            @if(!empty($project->features))
                <div class="p-8 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-6">
                    <h3 class="text-2xl font-heading font-bold text-[#F5F1EA]">Core Capabilities & Shipped Features</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($project->features as $feature)
                            <div class="flex items-start gap-3 p-4 rounded-xl bg-[#0E0D0C] border border-[#2A2520]">
                                <span class="w-5 h-5 rounded-full bg-[#1E1A17] text-[#E47A2E] flex items-center justify-center text-xs font-mono shrink-0 mt-0.5">
                                    &check;
                                </span>
                                <span class="text-sm text-[#F5F1EA] font-sans leading-relaxed">{{ $feature }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Full Narrative / Description -->
            @if($project->description)
                <div class="p-8 sm:p-10 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-6">
                    <h3 class="text-2xl font-heading font-bold text-[#F5F1EA]">Complete Case Study Narrative</h3>
                    <div class="prose prose-invert max-w-none text-[#9E958B] leading-relaxed font-sans space-y-4">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>
            @endif

            <!-- Tech Stack & Skills Used -->
            <div class="p-8 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-6">
                <h3 class="text-xl font-heading font-bold text-[#F5F1EA]">Technologies & Disciplines Applied</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($project->technologies as $tech)
                        <span class="px-3 py-1.5 rounded-xl bg-[#1E1A17] border border-[#2A2520] text-xs font-mono text-[#F5F1EA]">
                            {{ $tech->name }}
                        </span>
                    @endforeach
                    @foreach($project->skills as $skill)
                        <span class="px-3 py-1.5 rounded-xl bg-[#0E0D0C] border border-[#C45A19]/30 text-xs font-mono text-[#E47A2E]">
                            {{ $skill->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        </article>
    </div>
</x-layouts.app>
