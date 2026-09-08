<x-layouts.app :title="$project->title . ' — Project Case Study'">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
        <a href="{{ route('projects.index') }}" class="inline-flex items-center text-xs font-semibold text-zinc-400 hover:text-white transition">
            &larr; Back to all projects
        </a>

        <header class="space-y-4">
            <div class="flex items-center gap-2 text-xs">
                <span class="px-2.5 py-1 rounded-md bg-indigo-500/10 text-indigo-400 font-medium">
                    {{ $project->category?->name ?? 'General' }}
                </span>
                <span class="px-2.5 py-1 rounded-md bg-zinc-800 text-zinc-300 font-mono capitalize">
                    {{ $project->status }}
                </span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-bold text-white tracking-tight">
                {{ $project->title }}
            </h1>

            <p class="text-lg text-zinc-300 leading-relaxed">
                {{ $project->short_description }}
            </p>

            <div class="flex flex-wrap items-center gap-4 pt-4 border-t border-zinc-900 text-xs text-zinc-400">
                @if($project->role)
                    <div><span class="text-zinc-500">Role:</span> <strong class="text-zinc-200">{{ $project->role }}</strong></div>
                @endif
                @if($project->started_at)
                    <div><span class="text-zinc-500">Timeline:</span> <strong class="text-zinc-200">{{ $project->started_at->format('M Y') }} - {{ $project->ended_at?->format('M Y') ?? 'Present' }}</strong></div>
                @endif
                @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="text-indigo-400 hover:underline">Repository &rarr;</a>
                @endif
                @if($project->demo_url)
                    <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="text-emerald-400 hover:underline">Live System &rarr;</a>
                @endif
            </div>
        </header>

        <!-- Deep Dive Sections -->
        <div class="space-y-10 border-t border-zinc-900 pt-8 text-zinc-300 leading-relaxed">
            @if($project->description)
                <section class="space-y-3">
                    <h2 class="text-xl font-bold text-white">System Overview</h2>
                    <div class="text-sm sm:text-base whitespace-pre-line text-zinc-300">{{ $project->description }}</div>
                </section>
            @endif

            @if($project->problem)
                <section class="space-y-3 p-6 rounded-2xl bg-zinc-900/30 border border-zinc-800">
                    <h2 class="text-xl font-bold text-amber-400">The Engineering Problem</h2>
                    <p class="text-sm sm:text-base text-zinc-300 leading-relaxed">{{ $project->problem }}</p>
                </section>
            @endif

            @if($project->solution)
                <section class="space-y-3 p-6 rounded-2xl bg-zinc-900/30 border border-zinc-800">
                    <h2 class="text-xl font-bold text-emerald-400">The Implemented Solution</h2>
                    <p class="text-sm sm:text-base text-zinc-300 leading-relaxed">{{ $project->solution }}</p>
                </section>
            @endif

            @if($project->architecture)
                <section class="space-y-3">
                    <h2 class="text-xl font-bold text-white">System Architecture & Design</h2>
                    <p class="text-sm sm:text-base text-zinc-300 leading-relaxed font-mono bg-zinc-950 p-4 rounded-xl border border-zinc-800">{{ $project->architecture }}</p>
                </section>
            @endif

            <!-- Technologies -->
            @if($project->technologies->isNotEmpty())
                <section class="space-y-3">
                    <h2 class="text-xl font-bold text-white">Technologies Employed</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($project->technologies as $tech)
                            <span class="px-3 py-1 rounded-lg bg-zinc-900 border border-zinc-800 text-xs font-mono text-zinc-200">
                                {{ $tech->name }}
                            </span>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- Connected Experiences -->
            @if($project->experiences->isNotEmpty())
                <section class="space-y-3">
                    <h2 class="text-xl font-bold text-white">Related Professional Journey</h2>
                    <div class="space-y-2">
                        @foreach($project->experiences as $exp)
                            <a href="{{ route('journey.show', $exp->slug) }}" class="block p-4 rounded-xl bg-zinc-900/40 border border-zinc-800 hover:border-zinc-700 transition">
                                <div class="font-bold text-white text-sm">{{ $exp->title }}</div>
                                <div class="text-xs text-zinc-400 mt-0.5">{{ $exp->role }} • {{ $exp->experienceType?->name }}</div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </div>
</x-layouts.app>
