<x-layouts.app title="Articles & Publications">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Header -->
        <x-section-heading 
            label="// TECHNICAL ESSAYS"
            title="Articles & Publications"
            description="In-depth technical guides, architectural design analyses, and engineering observations."
        />

        <!-- Articles List -->
        <div class="space-y-6">
            @forelse($articles as $article)
                <article class="p-6 sm:p-8 rounded-2xl bg-[#151311] border border-[#2A2520] hover:border-[#C45A19]/50 transition-all duration-300 flex flex-col justify-between group hover:shadow-xl hover:shadow-[#C45A19]/5">
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-mono uppercase tracking-wider bg-[#1E1A17] text-[#E47A2E] border border-[#2A2520]">
                                {{ $article->category }}
                            </span>
                            <span class="text-xs font-mono text-[#70685F]">
                                {{ $article->published_at ? $article->published_at->format('F d, Y') : 'Draft' }}
                            </span>
                        </div>

                        <h2 class="text-2xl font-heading font-bold text-[#F5F1EA] group-hover:text-[#E47A2E] transition-colors leading-snug">
                            <a href="{{ route('articles.show', $article->slug) }}">
                                {{ $article->title }}
                            </a>
                        </h2>

                        <p class="text-sm text-[#9E958B] leading-relaxed">
                            {{ $article->excerpt }}
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-[#2A2520] flex items-center justify-between text-xs font-mono">
                        <span class="text-[#70685F]">By Helmy Yunan Nasution</span>
                        <a 
                            href="{{ route('articles.show', $article->slug) }}" 
                            class="text-[#E47A2E] group-hover:text-[#F5F1EA] inline-flex items-center gap-1 transition"
                        >
                            <span>Read Article</span>
                            <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>
                </article>
            @empty
                <div class="text-center py-16 border border-dashed border-[#2A2520] rounded-3xl p-8">
                    <p class="text-[#70685F] font-mono">No articles currently published in database.</p>
                </div>
            @endforelse
        </div>

    </div>
</x-layouts.app>
