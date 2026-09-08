<x-layouts.app title="Projects — Helmy Yunan Nasution">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
        <header class="max-w-3xl space-y-3">
            <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Engineered Projects</h1>
            <p class="text-zinc-400 text-base leading-relaxed">
                Explore architectural designs, software systems, tools, and platforms built with rigorous engineering standards.
            </p>
        </header>

        <!-- Category Filters -->
        @if($categories->isNotEmpty())
            <div class="flex flex-wrap items-center gap-2 border-b border-zinc-900 pb-4">
                <a href="{{ route('projects.index') }}" class="px-3.5 py-1.5 rounded-lg text-xs font-medium transition {{ !$categorySlug ? 'bg-indigo-600 text-white' : 'bg-zinc-900 text-zinc-400 hover:text-white hover:bg-zinc-800' }}">
                    All Projects ({{ $projects->count() }})
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('projects.index', ['category' => $cat->slug]) }}" class="px-3.5 py-1.5 rounded-lg text-xs font-medium transition {{ $categorySlug === $cat->slug ? 'bg-indigo-600 text-white' : 'bg-zinc-900 text-zinc-400 hover:text-white hover:bg-zinc-800' }}">
                        {{ $cat->name }} ({{ $cat->projects_count }})
                    </a>
                @endforeach
            </div>
        @endif

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($projects as $project)
                <div class="rounded-2xl bg-zinc-900/40 border border-zinc-800/80 p-6 flex flex-col justify-between hover:border-zinc-700 transition">
                    <div>
                        <div class="flex items-center justify-between text-xs text-zinc-500 mb-3">
                            <span class="text-indigo-400 font-medium">{{ $project->category?->name ?? 'Project' }}</span>
                            <span class="capitalize px-2 py-0.5 rounded bg-zinc-800/60 font-mono">{{ $project->status }}</span>
                        </div>
                        <h2 class="text-xl font-bold text-white hover:text-indigo-400 transition">
                            <a href="{{ route('projects.show', $project->slug) }}">{{ $project->title }}</a>
                        </h2>
                        <p class="text-sm text-zinc-400 mt-2 line-clamp-3">
                            {{ $project->short_description }}
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-zinc-800/60 space-y-3">
                        <div class="flex flex-wrap items-center gap-1.5">
                            @foreach($project->technologies->take(4) as $tech)
                                <span class="text-[11px] px-2 py-0.5 rounded-md bg-zinc-800 text-zinc-300 font-mono">{{ $tech->name }}</span>
                            @endforeach
                        </div>
                        <div class="flex items-center justify-between text-xs pt-1">
                            <a href="{{ route('projects.show', $project->slug) }}" class="font-medium text-indigo-400 hover:text-indigo-300">Case Study &rarr;</a>
                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="text-zinc-500 hover:text-zinc-300">GitHub</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-zinc-500">
                    No projects found for the selected category.
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.app>
