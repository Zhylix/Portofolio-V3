<x-layouts.app :title="$experience->title . ' — Experience Details'">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
        <a href="{{ route('journey.index') }}" class="inline-flex items-center text-xs font-semibold text-zinc-400 hover:text-white transition">
            &larr; Back to Journey Timeline
        </a>

        <header class="space-y-4">
            <div class="flex items-center gap-2 text-xs">
                <span class="px-2.5 py-1 rounded-md bg-indigo-500/10 text-indigo-400 font-medium">
                    {{ $experience->experienceType?->name }}
                </span>
                @if($experience->organization)
                    <span class="px-2.5 py-1 rounded-md bg-zinc-800 text-zinc-300 font-medium">
                        {{ $experience->organization->name }}
                    </span>
                @endif
                <span class="px-2.5 py-1 rounded-md bg-zinc-900 text-zinc-400 font-mono">
                    {{ $experience->location ?? 'Remote' }}
                </span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-bold text-white tracking-tight">
                {{ $experience->title }}
            </h1>

            <div class="text-lg text-indigo-400 font-medium">
                {{ $experience->role }}
            </div>

            <div class="text-xs font-mono text-zinc-500">
                {{ $experience->started_at?->format('F Y') }} — 
                {{ $experience->is_current ? 'Present' : ($experience->ended_at?->format('F Y') ?? 'Present') }}
            </div>
        </header>

        <div class="space-y-10 border-t border-zinc-900 pt-8 text-zinc-300 leading-relaxed">
            <section class="space-y-3">
                <h2 class="text-xl font-bold text-white">Summary</h2>
                <p class="text-base text-zinc-300">{{ $experience->summary }}</p>
            </section>

            @if($experience->description)
                <section class="space-y-3">
                    <h2 class="text-xl font-bold text-white">Full Narrative</h2>
                    <div class="text-sm sm:text-base whitespace-pre-line text-zinc-300 leading-relaxed">{{ $experience->description }}</div>
                </section>
            @endif

            <!-- Challenge & Solution -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if($experience->challenge)
                    <div class="p-6 rounded-2xl bg-zinc-900/30 border border-zinc-800 space-y-2">
                        <h3 class="font-bold text-amber-400 text-base">Key Challenge</h3>
                        <p class="text-sm text-zinc-300">{{ $experience->challenge }}</p>
                    </div>
                @endif

                @if($experience->solution)
                    <div class="p-6 rounded-2xl bg-zinc-900/30 border border-zinc-800 space-y-2">
                        <h3 class="font-bold text-emerald-400 text-base">Applied Solution</h3>
                        <p class="text-sm text-zinc-300">{{ $experience->solution }}</p>
                    </div>
                @endif
            </div>

            @if($experience->contribution)
                <section class="space-y-2 p-5 rounded-2xl bg-indigo-500/5 border border-indigo-500/20">
                    <h3 class="font-bold text-indigo-400 text-base">Core Contribution</h3>
                    <p class="text-sm text-zinc-300">{{ $experience->contribution }}</p>
                </section>
            @endif

            @if($experience->outcome)
                <section class="space-y-2 p-5 rounded-2xl bg-zinc-900/50 border border-zinc-800">
                    <h3 class="font-bold text-white text-base">Measurable Outcome</h3>
                    <p class="text-sm text-zinc-300">{{ $experience->outcome }}</p>
                </section>
            @endif

            <!-- Connected Projects -->
            @if($experience->projects->isNotEmpty())
                <section class="space-y-3 pt-6 border-t border-zinc-900">
                    <h2 class="text-xl font-bold text-white">Associated Projects</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($experience->projects as $proj)
                            <a href="{{ route('projects.show', $proj->slug) }}" class="p-4 rounded-xl bg-zinc-900/40 border border-zinc-800 hover:border-zinc-700 transition block">
                                <div class="font-bold text-white text-sm">{{ $proj->title }}</div>
                                <div class="text-xs text-zinc-400 mt-1 line-clamp-2">{{ $proj->short_description }}</div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- Associated Skills -->
            @if($experience->skills->isNotEmpty())
                <section class="space-y-3 pt-6 border-t border-zinc-900">
                    <h2 class="text-xl font-bold text-white">Skills Applied</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($experience->skills as $skill)
                            <span class="px-3 py-1 rounded-lg bg-zinc-900 border border-zinc-800 text-xs font-mono text-zinc-300">
                                {{ $skill->name }}
                            </span>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </div>
</x-layouts.app>
