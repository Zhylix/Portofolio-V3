<x-layouts.app title="Projects & Systems Portfolio">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Header -->
        <x-section-heading 
            label="// PRODUCTION WORK"
            title="Engineered Systems & Projects"
            description="Explore software architectures, enterprise platforms, developer toolchains, and distributed backends."
        />

        <!-- Filters & Search Bar -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 pb-8 mb-10 border-b border-[#2A2520]">
            <!-- Category Chips -->
            <div class="flex flex-wrap items-center gap-2">
                <x-chip 
                    :active="!$categorySlug" 
                    :href="route('projects.index')"
                >
                    All Systems ({{ $projects->count() }})
                </x-chip>

                @foreach($categories as $cat)
                    <x-chip 
                        :active="$categorySlug === $cat->slug" 
                        :href="route('projects.index', ['category' => $cat->slug])"
                        :count="$cat->projects_count"
                    >
                        {{ $cat->name }}
                    </x-chip>
                @endforeach
            </div>
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($projects as $project)
                <x-project-card :project="$project" />
            @empty
                <div class="col-span-3 text-center py-16 border border-dashed border-[#2A2520] rounded-3xl p-8">
                    <div class="w-12 h-12 rounded-full bg-[#151311] border border-[#2A2520] flex items-center justify-center mx-auto mb-4 text-[#E47A2E]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="text-lg font-heading font-bold text-[#F5F1EA]">No Projects Found</h3>
                    <p class="text-sm text-[#9E958B] mt-1">No systems currently match the selected category filter.</p>
                    <div class="mt-4">
                        <x-button :href="route('projects.index')" variant="secondary" size="sm">
                            Clear Filter
                        </x-button>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
</x-layouts.app>
