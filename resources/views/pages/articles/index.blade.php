<x-layouts.app title="Articles & Insights — Helmy Yunan Nasution">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
        <header class="space-y-3">
            <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Articles & Engineering Insights</h1>
            <p class="text-zinc-400 text-base leading-relaxed">
                Reflections and deep dives on software architecture, backend engineering, performance tuning, and system design.
            </p>
        </header>

        <div class="space-y-8">
            @forelse($articles as $article)
                <article class="p-6 rounded-2xl bg-zinc-900/40 border border-zinc-800/80 hover:border-zinc-700 transition space-y-3">
                    <div class="flex items-center gap-3 text-xs text-zinc-500">
                        @if($article->category)
                            <span class="text-indigo-400 font-semibold">{{ $article->category }}</span>
                            <span>•</span>
                        @endif
                        <time datetime="{{ $article->published_at?->toIso8601String() }}">
                            {{ $article->published_at?->format('F d, Y') }}
                        </time>
                    </div>

                    <h2 class="text-2xl font-bold text-white hover:text-indigo-400 transition">
                        <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                    </h2>

                    <p class="text-zinc-400 text-sm leading-relaxed line-clamp-3">
                        {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 200) }}
                    </p>

                    <div class="pt-2">
                        <a href="{{ route('articles.show', $article->slug) }}" class="text-xs font-semibold text-indigo-400 hover:text-indigo-300">
                            Read Article &rarr;
                        </a>
                    </div>
                </article>
            @empty
                <p class="text-sm text-zinc-500">No published articles yet.</p>
            @endforelse
        </div>
    </div>
</x-layouts.app>
