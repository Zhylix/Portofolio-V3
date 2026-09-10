@php
    $thumbnailUrl = $article->thumbnail_url ?: asset('images/og-card.png');
    $metaDesc = $article->seo?->meta_description ?? ($article->excerpt ?: Str::limit(strip_tags($article->content), 160));
    $breadcrumbs = [
        ['name' => 'Home', 'url' => route('home')],
        ['name' => 'Articles', 'url' => route('articles.index')],
        ['name' => $article->title, 'url' => route('articles.show', $article->slug)],
    ];
@endphp

<x-layouts.app 
    :title="$article->title . ' — Article'"
    :meta-description="$metaDesc"
    :og-image="$thumbnailUrl"
    :article="$article"
    :breadcrumbs="$breadcrumbs"
    og-type="article"
>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Back Navigation -->
        <div class="mb-8">
            <a 
                href="{{ route('articles.index') }}" 
                class="inline-flex items-center gap-2 text-xs font-mono uppercase tracking-wider text-[#9E958B] hover:text-[#E47A2E] transition-colors"
            >
                <span>&larr;</span>
                <span>Back to All Articles</span>
            </a>
        </div>

        <article class="space-y-8">
            <!-- Article Header -->
            <header class="space-y-4 pb-8 border-b border-[#2A2520]">
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded-full text-xs font-mono uppercase tracking-wider bg-[#1E1A17] text-[#E47A2E] border border-[#2A2520]">
                        {{ $article->category }}
                    </span>
                    <span class="text-xs font-mono text-[#70685F]">
                        {{ $article->published_at ? $article->published_at->format('F d, Y') : 'Draft' }}
                    </span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-extrabold text-[#F5F1EA] tracking-tight leading-tight">
                    {{ $article->title }}
                </h1>

                @if($article->excerpt)
                    <p class="text-lg text-[#9E958B] font-sans leading-relaxed">
                        {{ $article->excerpt }}
                    </p>
                @endif
            </header>

            @if($article->thumbnail_url)
                <div class="rounded-3xl overflow-hidden border border-[#2A2520] bg-[#0E0D0C] aspect-video max-h-[420px]">
                    <img 
                        src="{{ $article->thumbnail_url }}" 
                        alt="{{ $article->title }}" 
                        loading="eager"
                        decoding="async"
                        width="1200"
                        height="630"
                        class="w-full h-full object-cover"
                    />
                </div>
            @endif

            <!-- Article Content -->
            <div class="prose prose-invert max-w-none text-[#F5F1EA] leading-relaxed text-base sm:text-lg font-sans space-y-6">
                {!! nl2br(e($article->content)) !!}
            </div>

            <!-- Author Card -->
            <footer class="mt-16 pt-8 border-t border-[#2A2520]">
                <div class="p-6 sm:p-8 rounded-3xl bg-[#151311] border border-[#2A2520] flex flex-col sm:flex-row items-center sm:items-start gap-6 text-center sm:text-left">
                    <div class="w-16 h-16 rounded-full bg-[#1E1A17] border border-[#2A2520] flex items-center justify-center text-xl font-mono font-bold text-[#E47A2E] shrink-0">
                        HY
                    </div>
                    <div class="space-y-2">
                        <span class="text-xs font-mono uppercase tracking-widest text-[#E47A2E]">Author</span>
                        <h4 class="text-xl font-heading font-bold text-[#F5F1EA]">Helmy Yunan Nasution</h4>
                        <p class="text-sm text-[#9E958B] leading-relaxed">
                            Software Engineer & System Architect specializing in distributed systems, Laravel architectures, and database performance.
                        </p>
                    </div>
                </div>
            </footer>
        </article>
    </div>
</x-layouts.app>
