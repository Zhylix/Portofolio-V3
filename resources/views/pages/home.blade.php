<x-layouts.app>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-24">
        <!-- Hero Section -->
        <section class="flex flex-col items-start gap-6 pt-8 pb-12 max-w-4xl">
            @if($profile?->availability)
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    {{ $profile->availability }}
                </div>
            @endif

            <h1 class="text-4xl sm:text-6xl font-bold tracking-tight text-white leading-tight">
                {{ $profile?->hero_label ?? 'Software Engineer & System Architect' }}
            </h1>

            <p class="text-lg sm:text-xl text-zinc-400 leading-relaxed max-w-3xl">
                {{ $profile?->headline ?? 'Building robust backend architectures, high-performance systems, and clean scalable personal journey platforms.' }}
            </p>

            @if($profile?->short_bio)
                <p class="text-zinc-500 text-sm sm:text-base leading-relaxed">
                    {{ $profile->short_bio }}
                </p>
            @endif

            <div class="flex flex-wrap items-center gap-4 pt-4">
                <a href="{{ route('projects.index') }}" class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-medium text-sm transition shadow-lg shadow-indigo-600/25">
                    Explore Projects
                </a>
                <a href="{{ route('journey.index') }}" class="px-5 py-2.5 rounded-xl bg-zinc-900 hover:bg-zinc-800 text-zinc-200 border border-zinc-800 font-medium text-sm transition">
                    View Career Journey
                </a>
                <a href="{{ route('contact.index') }}" class="px-5 py-2.5 rounded-xl text-zinc-400 hover:text-white font-medium text-sm transition">
                    Get in Touch &rarr;
                </a>
            </div>

            <!-- Social Links -->
            @if($socialLinks->isNotEmpty())
                <div class="flex items-center gap-3 pt-4 border-t border-zinc-900 w-full">
                    <span class="text-xs text-zinc-500 uppercase tracking-wider font-semibold">Connect:</span>
                    <div class="flex items-center gap-2">
                        @foreach($socialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="px-3 py-1 rounded-md text-xs font-medium text-zinc-400 hover:text-white hover:bg-zinc-900 transition border border-zinc-800/60">
                                {{ ucfirst($link->platform) }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>

        <!-- Featured Projects -->
        <section class="space-y-8">
            <div class="flex items-end justify-between">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-white">Featured Projects</h2>
                    <p class="text-sm text-zinc-400 mt-1">Highlighted architectural systems, enterprise platforms, and tools.</p>
                </div>
                <a href="{{ route('projects.index') }}" class="text-xs font-semibold text-indigo-400 hover:text-indigo-300 transition">
                    View All Projects &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($featuredProjects as $project)
                    <div class="group relative rounded-2xl bg-zinc-900/40 border border-zinc-800/80 p-6 hover:border-zinc-700 transition flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between text-xs text-zinc-500 mb-3">
                                <span>{{ $project->category?->name ?? 'General' }}</span>
                                <span class="capitalize px-2 py-0.5 rounded bg-zinc-800/60 text-zinc-400">{{ $project->status }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-white group-hover:text-indigo-400 transition">
                                <a href="{{ route('projects.show', $project->slug) }}">
                                    <span class="absolute inset-0"></span>
                                    {{ $project->title }}
                                </a>
                            </h3>
                            <p class="text-sm text-zinc-400 mt-2 line-clamp-3">
                                {{ $project->short_description }}
                            </p>
                        </div>

                        <div class="mt-6 pt-4 border-t border-zinc-800/60 flex flex-wrap items-center gap-1.5 z-10">
                            @foreach($project->technologies->take(4) as $tech)
                                <span class="text-[11px] px-2 py-0.5 rounded-md bg-zinc-800 text-zinc-300 font-mono">{{ $tech->name }}</span>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <p class="text-zinc-500 text-sm">No featured projects yet.</p>
                @endforelse
            </div>
        </section>

        <!-- Featured Experiences & Professional Journey -->
        <section class="space-y-8">
            <div class="flex items-end justify-between">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-white">Professional Journey</h2>
                    <p class="text-sm text-zinc-400 mt-1">Diverse experiences spanning work, open source, competitions, and leadership.</p>
                </div>
                <a href="{{ route('journey.index') }}" class="text-xs font-semibold text-indigo-400 hover:text-indigo-300 transition">
                    Explore Timeline &rarr;
                </a>
            </div>

            <div class="space-y-4">
                @forelse($featuredExperiences as $exp)
                    <div class="rounded-xl bg-zinc-900/40 border border-zinc-800/70 p-5 hover:border-zinc-700 transition flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs px-2 py-0.5 rounded bg-indigo-500/10 text-indigo-400 font-medium">
                                    {{ $exp->experienceType?->name }}
                                </span>
                                @if($exp->organization)
                                    <span class="text-xs text-zinc-500">at {{ $exp->organization->name }}</span>
                                @endif
                            </div>
                            <h3 class="text-lg font-semibold text-white">
                                <a href="{{ route('journey.show', $exp->slug) }}" class="hover:text-indigo-400 transition">
                                    {{ $exp->title }}
                                </a>
                            </h3>
                            <p class="text-sm text-zinc-400 mt-1 max-w-2xl">{{ $exp->summary }}</p>
                        </div>
                        <div class="text-xs text-zinc-500 font-mono sm:text-right shrink-0">
                            {{ $exp->started_at?->format('M Y') ?? 'N/A' }} - 
                            {{ $exp->is_current ? 'Present' : ($exp->ended_at?->format('M Y') ?? 'Present') }}
                        </div>
                    </div>
                @empty
                    <p class="text-zinc-500 text-sm">No experiences listed yet.</p>
                @endforelse
            </div>
        </section>

        <!-- Skills Overview -->
        <section class="space-y-6">
            <div class="flex items-end justify-between">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-white">Core Competencies & Evidence</h2>
                    <p class="text-sm text-zinc-400 mt-1">Skills validated by real-world projects, certifications, and experience.</p>
                </div>
                <a href="{{ route('skills.index') }}" class="text-xs font-semibold text-indigo-400 hover:text-indigo-300 transition">
                    View Complete Matrix &rarr;
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach($featuredSkills as $skill)
                    <div class="p-4 rounded-xl bg-zinc-900/40 border border-zinc-800/80">
                        <div class="text-xs text-indigo-400 font-medium">{{ $skill->category?->name }}</div>
                        <div class="font-bold text-white text-base mt-1">{{ $skill->name }}</div>
                        <div class="text-xs text-zinc-500 mt-2">
                            {{ $skill->evidence_count }} connected evidence items
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Services -->
        @if($services->isNotEmpty())
            <section class="space-y-6">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-white">Services & Expertise</h2>
                    <p class="text-sm text-zinc-400 mt-1">High-impact engineering solutions and consulting offerings.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($services as $service)
                        <div class="p-6 rounded-2xl bg-zinc-900/40 border border-zinc-800/80 space-y-3">
                            <h3 class="text-lg font-bold text-white">{{ $service->title }}</h3>
                            <p class="text-sm text-zinc-400 leading-relaxed">{{ $service->description }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-layouts.app>
