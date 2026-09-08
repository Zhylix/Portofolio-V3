<x-layouts.app title="System Search — Helmy Yunan Nasution">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">
        <header class="space-y-4">
            <x-section-heading 
                label="// QUERY ENGINE"
                title="System Search"
                description="Search across production projects, journey milestones, technical articles, and capabilities."
            />

            <form action="{{ route('search') }}" method="GET" class="relative">
                <input 
                    type="text" 
                    name="q" 
                    value="{{ $query }}" 
                    placeholder="Search systems, technologies, architecture, skills..." 
                    class="w-full text-base bg-[#0E0D0C] border border-[#2A2520] focus:border-[#C45A19] focus:ring-1 focus:ring-[#C45A19] rounded-2xl px-6 py-4 text-[#F5F1EA] placeholder-[#70685F] shadow-inner font-sans outline-none transition"
                >
            </form>
        </header>

        @if($query !== '')
            <div class="space-y-10">
                <!-- Projects Results -->
                @if($projects->isNotEmpty())
                    <section class="space-y-4">
                        <h2 class="text-xs font-mono uppercase tracking-widest text-[#E47A2E] border-b border-[#2A2520] pb-2">
                            Projects & Systems ({{ $projects->count() }})
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($projects as $p)
                                <a href="{{ route('projects.show', $p->slug) }}" class="p-5 rounded-2xl bg-[#151311] border border-[#2A2520] hover:border-[#C45A19] block transition group">
                                    <div class="font-heading font-bold text-[#F5F1EA] group-hover:text-[#E47A2E] text-base">{{ $p->title }}</div>
                                    <div class="text-xs text-[#9E958B] mt-1 line-clamp-2">{{ $p->short_description }}</div>
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- Experiences Results -->
                @if($experiences->isNotEmpty())
                    <section class="space-y-4">
                        <h2 class="text-xs font-mono uppercase tracking-widest text-[#E47A2E] border-b border-[#2A2520] pb-2">
                            Professional Journey ({{ $experiences->count() }})
                        </h2>
                        <div class="space-y-3">
                            @foreach($experiences as $exp)
                                <a href="{{ route('journey.show', $exp->slug) }}" class="p-5 rounded-2xl bg-[#151311] border border-[#2A2520] hover:border-[#C45A19] block transition group">
                                    <div class="font-heading font-bold text-[#F5F1EA] group-hover:text-[#E47A2E] text-base">{{ $exp->title }}</div>
                                    <div class="text-xs text-[#9E958B] mt-0.5 font-mono">{{ $exp->role }} &bull; {{ $exp->organization->name ?? 'Organization' }}</div>
                                    <div class="text-xs text-[#70685F] mt-1 line-clamp-1">{{ $exp->summary }}</div>
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- Skills Results -->
                @if($skills->isNotEmpty())
                    <section class="space-y-4">
                        <h2 class="text-xs font-mono uppercase tracking-widest text-[#E47A2E] border-b border-[#2A2520] pb-2">
                            Capabilities & Skills ({{ $skills->count() }})
                        </h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($skills as $sk)
                                <span class="px-3.5 py-1.5 rounded-full bg-[#151311] border border-[#2A2520] text-xs font-mono text-[#F5F1EA]">
                                    {{ $sk->name }}
                                </span>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- Articles Results -->
                @if($articles->isNotEmpty())
                    <section class="space-y-4">
                        <h2 class="text-xs font-mono uppercase tracking-widest text-[#E47A2E] border-b border-[#2A2520] pb-2">
                            Articles ({{ $articles->count() }})
                        </h2>
                        <div class="space-y-3">
                            @foreach($articles as $art)
                                <a href="{{ route('articles.show', $art->slug) }}" class="p-5 rounded-2xl bg-[#151311] border border-[#2A2520] hover:border-[#C45A19] block transition group">
                                    <div class="font-heading font-bold text-[#F5F1EA] group-hover:text-[#E47A2E] text-base">{{ $art->title }}</div>
                                    <div class="text-xs text-[#9E958B] mt-1 line-clamp-2">{{ $art->excerpt }}</div>
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif

                @if($projects->isEmpty() && $experiences->isEmpty() && $skills->isEmpty() && $articles->isEmpty())
                    <div class="text-center py-16 border border-dashed border-[#2A2520] rounded-3xl p-8">
                        <p class="text-sm text-[#9E958B]">No records found matching "{{ $query }}".</p>
                    </div>
                @endif
            </div>
        @endif
    </div>
</x-layouts.app>
