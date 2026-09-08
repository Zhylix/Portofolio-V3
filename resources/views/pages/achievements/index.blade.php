<x-layouts.app title="Achievements & Honors — Helmy Yunan Nasution">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
        <header class="max-w-3xl space-y-3">
            <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Honors & Achievements</h1>
            <p class="text-zinc-400 text-base leading-relaxed">
                Notable awards, hackathon victories, and technical honors earned throughout my engineering trajectory.
            </p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($achievements as $ach)
                <div class="p-6 rounded-2xl bg-zinc-900/40 border border-zinc-800/80 hover:border-zinc-700 transition flex flex-col justify-between space-y-4">
                    <div>
                        <div class="flex items-center justify-between text-xs mb-2">
                            <span class="px-2.5 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 font-medium">
                                {{ $ach->rank ?? 'Award' }}
                            </span>
                            @if($ach->date)
                                <span class="text-zinc-500 font-mono">{{ $ach->date->format('M Y') }}</span>
                            @endif
                        </div>

                        <h2 class="text-xl font-bold text-white">{{ $ach->title }}</h2>

                        @if($ach->organization)
                            <div class="text-xs text-indigo-400 font-medium mt-1">{{ $ach->organization }}</div>
                        @endif

                        @if($ach->description)
                            <p class="text-sm text-zinc-400 mt-3 leading-relaxed">{{ $ach->description }}</p>
                        @endif
                    </div>

                    <div class="pt-4 border-t border-zinc-800/60 flex items-center justify-between text-xs">
                        @if($ach->result)
                            <span class="text-zinc-300 font-medium">Result: <strong class="text-white">{{ $ach->result }}</strong></span>
                        @else
                            <span></span>
                        @endif

                        @if($ach->url)
                            <a href="{{ $ach->url }}" target="_blank" rel="noopener noreferrer" class="text-indigo-400 hover:text-indigo-300 font-semibold">
                                View Reference &rarr;
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-sm text-zinc-500 col-span-full">No achievements found.</p>
            @endforelse
        </div>
    </div>
</x-layouts.app>
