<x-layouts.app title="Skills Matrix & Evidence — Helmy Yunan Nasution">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
        <header class="max-w-3xl space-y-3">
            <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Skills & Evidence Matrix</h1>
            <p class="text-zinc-400 text-base leading-relaxed">
                Rather than arbitrary percentages, competencies here are demonstrated through empirical evidence: shipped production projects, professional experiences, and verified industry credentials.
            </p>
        </header>

        <div class="space-y-12">
            @forelse($categories as $category)
                <section class="space-y-6">
                    <div class="border-b border-zinc-900 pb-3 flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-white">{{ $category->name }}</h2>
                            @if($category->description)
                                <p class="text-xs text-zinc-500 mt-0.5">{{ $category->description }}</p>
                            @endif
                        </div>
                        <span class="text-xs text-zinc-500 font-mono">{{ $category->skills->count() }} skills</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($category->skills as $skill)
                            <div class="p-5 rounded-2xl bg-zinc-900/40 border border-zinc-800/80 hover:border-zinc-700 transition space-y-3">
                                <div class="flex items-center justify-between">
                                    <h3 class="font-bold text-white text-base">{{ $skill->name }}</h3>
                                    @if($skill->featured)
                                        <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">Featured</span>
                                    @endif
                                </div>

                                @if($skill->description)
                                    <p class="text-xs text-zinc-400 leading-relaxed">{{ $skill->description }}</p>
                                @endif

                                <div class="pt-2 border-t border-zinc-800/60 flex items-center justify-between text-xs text-zinc-500 font-mono">
                                    <span>Evidence base:</span>
                                    <div class="flex items-center gap-2 text-zinc-300">
                                        <span title="Projects">{{ $skill->projects_count }} proj</span>
                                        <span>•</span>
                                        <span title="Experiences">{{ $skill->experiences_count }} exp</span>
                                        <span>•</span>
                                        <span title="Certificates">{{ $skill->certificates_count }} cert</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @empty
                <p class="text-sm text-zinc-500">No skill categories found.</p>
            @endforelse
        </div>
    </div>
</x-layouts.app>
