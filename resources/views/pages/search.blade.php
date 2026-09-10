<x-layouts.app title="System Search — Helmy Yunan Nasution">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-10">
        <header class="space-y-4">
            <x-section-heading 
                label="// QUERY ENGINE"
                title="System Search"
                description="Search across production projects, technical capabilities, certificates, and achievements."
            />

            <form action="{{ route('search') }}" method="GET" class="relative">
                <input 
                    type="text" 
                    name="q" 
                    value="{{ $query }}" 
                    placeholder="Search systems, technologies, architecture, skills..." 
                    class="w-full text-base bg-[#0E0D0C] border border-[#2A2520] focus:border-[#C45A19] focus:ring-1 focus:ring-[#C45A19] rounded-2xl px-6 py-4 text-[#F5F1EA] placeholder-[#70685F] shadow-inner font-sans outline-none transition"
                >
                @if($type !== 'all')
                    <input type="hidden" name="type" value="{{ $type }}">
                @endif
            </form>

            @if($query !== '')
                <!-- Filter Tabs -->
                <div class="flex flex-wrap gap-2 pt-2">
                    @php
                        $types = [
                            'all' => 'All Results',
                            'projects' => 'Projects',
                            'skills' => 'Skills',
                            'certificates' => 'Certificates',
                            'achievements' => 'Achievements',
                        ];
                    @endphp
                    @foreach($types as $key => $label)
                        <a 
                            href="{{ route('search', ['q' => $query, 'type' => $key]) }}"
                            class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-all {{ $type === $key ? 'bg-[#C45A19] text-[#F5F1EA] font-semibold shadow-md shadow-[#C45A19]/20' : 'bg-[#151311] border border-[#2A2520] text-[#9E958B] hover:text-[#F5F1EA] hover:border-[#70685F]' }}"
                        >
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            @endif
        </header>

        @if($query !== '')
            <div class="space-y-10">
                @if($type === 'all')
                    <!-- Projects Results -->
                    @if($projects->isNotEmpty())
                        <section class="space-y-4">
                            <div class="flex items-center justify-between border-b border-[#2A2520] pb-2">
                                <h2 class="text-xs font-mono uppercase tracking-widest text-[#E47A2E]">
                                    Projects & Systems ({{ $projects->count() }})
                                </h2>
                                <a href="{{ route('search', ['q' => $query, 'type' => 'projects']) }}" class="text-xs font-mono text-[#9E958B] hover:text-[#E47A2E]">View all &rarr;</a>
                            </div>
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

                    <!-- Skills Results -->
                    @if($skills->isNotEmpty())
                        <section class="space-y-4">
                            <div class="flex items-center justify-between border-b border-[#2A2520] pb-2">
                                <h2 class="text-xs font-mono uppercase tracking-widest text-[#E47A2E]">
                                    Capabilities & Skills ({{ $skills->count() }})
                                </h2>
                                <a href="{{ route('search', ['q' => $query, 'type' => 'skills']) }}" class="text-xs font-mono text-[#9E958B] hover:text-[#E47A2E]">View all &rarr;</a>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                @foreach($skills as $sk)
                                    <a href="{{ route('skills.index') }}" class="px-3.5 py-1.5 rounded-full bg-[#151311] border border-[#2A2520] hover:border-[#C45A19] text-xs font-mono text-[#F5F1EA] transition">
                                        {{ $sk->name }}
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- Certificates Results -->
                    @if($certificates->isNotEmpty())
                        <section class="space-y-4">
                            <div class="flex items-center justify-between border-b border-[#2A2520] pb-2">
                                <h2 class="text-xs font-mono uppercase tracking-widest text-[#E47A2E]">
                                    Certificates ({{ $certificates->count() }})
                                </h2>
                                <a href="{{ route('search', ['q' => $query, 'type' => 'certificates']) }}" class="text-xs font-mono text-[#9E958B] hover:text-[#E47A2E]">View all &rarr;</a>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($certificates as $cert)
                                    <div class="p-5 rounded-2xl bg-[#151311] border border-[#2A2520]">
                                        <div class="font-heading font-bold text-[#F5F1EA] text-base">{{ $cert->title }}</div>
                                        <div class="text-xs text-[#9E958B] mt-1 font-mono">{{ $cert->issuer }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- Achievements Results -->
                    @if($achievements->isNotEmpty())
                        <section class="space-y-4">
                            <div class="flex items-center justify-between border-b border-[#2A2520] pb-2">
                                <h2 class="text-xs font-mono uppercase tracking-widest text-[#E47A2E]">
                                    Achievements & Honors ({{ $achievements->count() }})
                                </h2>
                                <a href="{{ route('search', ['q' => $query, 'type' => 'achievements']) }}" class="text-xs font-mono text-[#9E958B] hover:text-[#E47A2E]">View all &rarr;</a>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($achievements as $ach)
                                    <div class="p-5 rounded-2xl bg-[#151311] border border-[#2A2520]">
                                        <div class="font-heading font-bold text-[#F5F1EA] text-base">{{ $ach->title }}</div>
                                        <div class="text-xs text-[#9E958B] mt-1 font-mono">{{ $ach->organization ?? $ach->rank }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    @if($projects->isEmpty() && $skills->isEmpty() && $certificates->isEmpty() && $achievements->isEmpty())
                        <div class="text-center py-16 border border-dashed border-[#2A2520] rounded-3xl p-8">
                            <p class="text-sm text-[#9E958B]">No records found matching "{{ $query }}".</p>
                        </div>
                    @endif

                @elseif($paginatedResults)
                    <!-- Paginated View for Single Domain -->
                    <section class="space-y-6">
                        <div class="flex items-center justify-between border-b border-[#2A2520] pb-2">
                            <h2 class="text-xs font-mono uppercase tracking-widest text-[#E47A2E]">
                                Results for {{ ucfirst($type) }} ({{ $paginatedResults->total() }})
                            </h2>
                        </div>

                        @if($paginatedResults->isEmpty())
                            <div class="text-center py-16 border border-dashed border-[#2A2520] rounded-3xl p-8">
                                <p class="text-sm text-[#9E958B]">No {{ $type }} found matching "{{ $query }}".</p>
                            </div>
                        @else
                            @if($type === 'projects')
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach($paginatedResults as $p)
                                        <a href="{{ route('projects.show', $p->slug) }}" class="p-5 rounded-2xl bg-[#151311] border border-[#2A2520] hover:border-[#C45A19] block transition group">
                                            <div class="font-heading font-bold text-[#F5F1EA] group-hover:text-[#E47A2E] text-base">{{ $p->title }}</div>
                                            <div class="text-xs text-[#9E958B] mt-1 line-clamp-2">{{ $p->short_description }}</div>
                                        </a>
                                    @endforeach
                                </div>
                            @elseif($type === 'skills')
                                <div class="flex flex-wrap gap-2">
                                    @foreach($paginatedResults as $sk)
                                        <a href="{{ route('skills.index') }}" class="px-4 py-2 rounded-full bg-[#151311] border border-[#2A2520] hover:border-[#C45A19] text-xs font-mono text-[#F5F1EA] transition">
                                            {{ $sk->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @elseif($type === 'certificates')
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach($paginatedResults as $cert)
                                        <div class="p-5 rounded-2xl bg-[#151311] border border-[#2A2520]">
                                            <div class="font-heading font-bold text-[#F5F1EA] text-base">{{ $cert->title }}</div>
                                            <div class="text-xs text-[#9E958B] mt-1 font-mono">{{ $cert->issuer }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            @elseif($type === 'achievements')
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach($paginatedResults as $ach)
                                        <div class="p-5 rounded-2xl bg-[#151311] border border-[#2A2520]">
                                            <div class="font-heading font-bold text-[#F5F1EA] text-base">{{ $ach->title }}</div>
                                            <div class="text-xs text-[#9E958B] mt-1 font-mono">{{ $ach->organization ?? $ach->rank }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="pt-6">
                                {{ $paginatedResults->links() }}
                            </div>
                        @endif
                    </section>
                @endif
            </div>
        @endif
    </div>
</x-layouts.app>
