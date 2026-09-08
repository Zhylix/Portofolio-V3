<x-layouts.app title="Professional Journey — Helmy Yunan Nasution">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
        <header class="space-y-3">
            <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Professional Journey & Experience</h1>
            <p class="text-zinc-400 text-base leading-relaxed">
                A multi-dimensional timeline encompassing industry work, freelance engineering, hackathons, open-source work, and community leadership.
            </p>
        </header>

        <!-- Experience Types Filter / Badge List -->
        @if($types->isNotEmpty())
            <div class="flex flex-wrap gap-2 border-b border-zinc-900 pb-6">
                @foreach($types as $type)
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-zinc-900 text-zinc-300 border border-zinc-800">
                        {{ $type->name }}
                    </span>
                @endforeach
            </div>
        @endif

        <!-- Timeline -->
        <div class="relative pl-6 border-l border-zinc-800 space-y-10">
            @forelse($experiences as $exp)
                <div class="relative group">
                    <!-- Timeline node icon -->
                    <div class="absolute -left-[31px] top-1.5 w-3 h-3 rounded-full {{ $exp->is_current ? 'bg-indigo-500 ring-4 ring-indigo-500/20' : 'bg-zinc-700' }}"></div>

                    <div class="p-6 rounded-2xl bg-zinc-900/40 border border-zinc-800/80 hover:border-zinc-700 transition space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <div>
                                <span class="text-xs px-2.5 py-0.5 rounded-full bg-indigo-500/10 text-indigo-400 font-medium">
                                    {{ $exp->experienceType?->name }}
                                </span>
                                @if($exp->organization)
                                    <span class="text-xs text-zinc-400 ml-2">at {{ $exp->organization->name }}</span>
                                @endif
                            </div>
                            <span class="text-xs font-mono text-zinc-500">
                                {{ $exp->started_at?->format('M Y') ?? 'N/A' }} — 
                                {{ $exp->is_current ? 'Present' : ($exp->ended_at?->format('M Y') ?? 'Present') }}
                            </span>
                        </div>

                        <div>
                            <h2 class="text-xl font-bold text-white hover:text-indigo-400 transition">
                                <a href="{{ route('journey.show', $exp->slug) }}">{{ $exp->title }}</a>
                            </h2>
                            <div class="text-sm text-zinc-400 font-medium mt-0.5">{{ $exp->role }}</div>
                            <p class="text-sm text-zinc-300 mt-2 leading-relaxed">{{ $exp->summary }}</p>
                        </div>

                        @if($exp->contribution)
                            <div class="text-xs text-zinc-400 bg-zinc-950/60 p-3 rounded-xl border border-zinc-800/50">
                                <strong class="text-zinc-300">Key Contribution:</strong> {{ $exp->contribution }}
                            </div>
                        @endif

                        <div class="flex items-center justify-between pt-2 border-t border-zinc-800/50 text-xs">
                            <a href="{{ route('journey.show', $exp->slug) }}" class="text-indigo-400 font-semibold hover:underline">
                                Read Experience Details &rarr;
                            </a>

                            @if($exp->skills->isNotEmpty())
                                <div class="flex flex-wrap gap-1">
                                    @foreach($exp->skills->take(3) as $skill)
                                        <span class="text-[10px] px-2 py-0.5 rounded bg-zinc-800 text-zinc-400 font-mono">{{ $skill->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-zinc-500">No experiences found.</p>
            @endforelse
        </div>
    </div>
</x-layouts.app>
