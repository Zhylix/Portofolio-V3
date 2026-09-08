<x-layouts.app title="Capabilities & Empirical Skills">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
        
        <!-- Header -->
        <x-section-heading 
            label="// TECHNICAL CAPABILITIES"
            title="Skills & Empirical Evidence"
            description="Competencies grouped by technical domain. Click any card to inspect associated production systems, case studies, and verified credentials."
        />

        <!-- Categorized Skills Sections -->
        @forelse($categories as $category)
            @if($category->skills->isNotEmpty())
                <section class="space-y-6">
                    <div class="flex items-center gap-3 pb-3 border-b border-[#2A2520]">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#C45A19]"></span>
                        <h2 class="text-xl font-heading font-bold text-[#F5F1EA]">
                            {{ $category->name }}
                        </h2>
                        <span class="text-xs font-mono text-[#70685F]">
                            ({{ $category->skills->count() }} {{ Str::plural('Skill', $category->skills->count()) }})
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                        @foreach($category->skills as $skill)
                            <x-skill-card :skill="$skill" />
                        @endforeach
                    </div>
                </section>
            @endif
        @empty
            <div class="text-center py-16 border border-dashed border-[#2A2520] rounded-3xl p-8">
                <p class="text-[#70685F] font-mono">No skills currently available in database.</p>
            </div>
        @endforelse

    </div>
</x-layouts.app>
