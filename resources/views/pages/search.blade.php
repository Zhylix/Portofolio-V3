<x-layouts.app title="Search Results — Helmy Yunan Nasution">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
        <header class="space-y-4">
            <h1 class="text-3xl font-bold text-white tracking-tight">System Search</h1>
            <form action="{{ route('search') }}" method="GET" class="relative">
                <input type="text" name="q" value="{{ $query }}" placeholder="Search projects, technologies, journey, skills..." class="w-full text-base bg-zinc-900 border border-zinc-800 rounded-2xl px-5 py-3.5 focus:outline-none focus:border-indigo-500 text-white placeholder-zinc-500 shadow-inner">
            </form>
        </header>

        @if($query !== '')
            <div class="space-y-10">
                <!-- Projects Results -->
                @if($projects->isNotEmpty())
                    <section class="space-y-3">
                        <h2 class="text-lg font-bold text-white border-b border-zinc-900 pb-2">Projects ({{ $projects->count() }})</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($projects as $p)
                                <a href="{{ route('projects.show', $p->slug) }}" class="p-4 rounded-xl bg-zinc-900/40 border border-zinc-800 hover:border-zinc-700 block transition">
                                    <div class="font-bold text-white text-sm">{{ $p->title }}</div>
                                    <div class="text-xs text-zinc-400 mt-1 line-clamp-2">{{ $p->short_description }}</div>
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- Experiences Results -->
                @if($experiences->isNotEmpty())
                    <section class="space-y-3">
                        <h2 class="text-lg font-bold text-white border-b border-zinc-900 pb-2">Professional Journey ({{ $experiences->count() }})</h2>
                        <div class="space-y-3">
                            @foreach($experiences as $exp)
                                <a href="{{ route('journey.show', $exp->slug) }}" class="p-4 rounded-xl bg-zinc-900/40 border border-zinc-800 hover:border-zinc-700 block transition">
                                    <div class="font-bold text-white text-sm">{{ $exp->title }}</div>
                                    <div class="text-xs text-zinc-400 mt-0.5">{{ $exp->role }} • {{ $exp->summary }}</div>
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- Skills Results -->
                @if($skills->isNotEmpty())
                    <section class="space-y-3">
                        <h2 class="text-lg font-bold text-white border-b border-zinc-900 pb-2">Skills ({{ $skills->count() }})</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($skills as $sk)
                                <span class="px-3 py-1 rounded-lg bg-zinc-900 border border-zinc-800 text-xs font-mono text-zinc-300">
                                    {{ $sk->name }}
                                </span>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- Articles Results -->
                @if($articles->isNotEmpty())
                    <section class="space-y-3">
                        <h2 class="text-lg font-bold text-white border-b border-zinc-900 pb-2">Articles ({{ $articles->count() }})</h2>
                        <div class="space-y-3">
                            @foreach($articles as $art)
                                <a href="{{ route('articles.show', $art->slug) }}" class="p-4 rounded-xl bg-zinc-900/40 border border-zinc-800 hover:border-zinc-700 block transition">
                                    <div class="font-bold text-white text-sm">{{ $art->title }}</div>
                                    <div class="text-xs text-zinc-400 mt-0.5">{{ $art->excerpt }}</div>
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif

                @if($projects->isEmpty() && $experiences->isEmpty() && $skills->isEmpty() && $articles->isEmpty())
                    <div class="py-12 text-center text-zinc-500">
                        No matches found for "{{ $query }}".
                    </div>
                @endif
            </div>
        @endif
    </div>
</x-layouts.app>
