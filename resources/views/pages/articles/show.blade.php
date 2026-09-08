<x-layouts.app :title="$article->title . ' — Helmy Yunan Nasution'">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-8">
        <a href="{{ route('articles.index') }}" class="inline-flex items-center text-xs font-semibold text-zinc-400 hover:text-white transition">
            &larr; Back to all articles
        </a>

        <header class="space-y-4">
            <div class="flex items-center gap-3 text-xs text-zinc-400">
                @if($article->category)
                    <span class="px-2.5 py-0.5 rounded-full bg-indigo-500/10 text-indigo-400 font-medium">{{ $article->category }}</span>
                @endif
                <time>{{ $article->published_at?->format('F d, Y') }}</time>
            </div>

            <h1 class="text-3xl sm:text-5xl font-bold text-white tracking-tight leading-tight">
                {{ $article->title }}
            </h1>

            @if($article->excerpt)
                <p class="text-lg text-zinc-400 leading-relaxed border-l-2 border-indigo-500 pl-4 italic">
                    {{ $article->excerpt }}
                </p>
            @endif
        </header>

        <article class="prose prose-invert max-w-none text-zinc-300 leading-relaxed space-y-6 pt-6 border-t border-zinc-900 text-base">
            {!! nl2br(e($article->content)) !!}
        </article>

        <!-- Connected Skills/Projects -->
        @if($article->skills->isNotEmpty() || $article->projects->isNotEmpty())
            <div class="pt-8 border-t border-zinc-900 space-y-4 text-xs">
                <span class="text-zinc-500 uppercase font-semibold tracking-wider">Related Context:</span>
                <div class="flex flex-wrap gap-2">
                    @foreach($article->skills as $skill)
                        <span class="px-2.5 py-1 rounded bg-zinc-900 border border-zinc-800 text-zinc-300">{{ $skill->name }}</span>
                    @endforeach
                    @foreach($article->projects as $proj)
                        <a href="{{ route('projects.show', $proj->slug) }}" class="px-2.5 py-1 rounded bg-indigo-500/10 text-indigo-400 hover:underline">
                            Project: {{ $proj->title }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
