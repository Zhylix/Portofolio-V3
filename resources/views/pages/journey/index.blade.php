<x-layouts.app title="Professional Journey & Timeline">
    <div 
        x-data="{ activeFilter: 'all' }"
        class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12"
    >
        <!-- Header -->
        <x-section-heading 
            label="// CAREER & MILESTONES"
            title="Professional Journey"
            description="Chronological record of full-time architecture roles, open source leadership, conferences, and technical milestones."
        />

        <!-- Responsive Filter Pills -->
        <div class="flex flex-wrap items-center gap-2 pb-6 mb-12 border-b border-[#2A2520]">
            <!-- ALL Pill -->
            <button 
                type="button" 
                @click="activeFilter = 'all'"
                :class="activeFilter === 'all' ? 'bg-[#C45A19] text-[#F5F1EA] font-semibold border-[#E47A2E] shadow-md shadow-[#C45A19]/20' : 'bg-[#151311] text-[#9E958B] hover:text-[#F5F1EA] hover:bg-[#1E1A17] border-[#2A2520]'"
                class="px-3.5 py-1.5 rounded-full text-xs font-mono uppercase tracking-wider border transition-all duration-200"
            >
                ALL ({{ $experiences->count() }})
            </button>

            <!-- Dynamic Active Types from Database -->
            @foreach($types as $type)
                <button 
                    type="button" 
                    @click="activeFilter = '{{ $type->slug }}'"
                    :class="activeFilter === '{{ $type->slug }}' ? 'bg-[#C45A19] text-[#F5F1EA] font-semibold border-[#E47A2E] shadow-md shadow-[#C45A19]/20' : 'bg-[#151311] text-[#9E958B] hover:text-[#F5F1EA] hover:bg-[#1E1A17] border-[#2A2520]'"
                    class="px-3.5 py-1.5 rounded-full text-xs font-mono uppercase tracking-wider border transition-all duration-200"
                >
                    {{ $type->name }}
                </button>
            @endforeach
        </div>

        <!-- Vertical Interactive Timeline -->
        <div class="relative space-y-6 sm:space-y-8 before:absolute before:inset-0 before:left-8 md:before:left-32 before:w-0.5 before:bg-[#2A2520] before:pointer-events-none">
            @forelse($experiences as $exp)
                <div 
                    x-show="activeFilter === 'all' || activeFilter === '{{ $exp->experienceType?->slug }}'"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="relative"
                >
                    <x-experience-card :experience="$exp" />
                </div>
            @empty
                <div class="text-center py-16 border border-dashed border-[#2A2520] rounded-3xl p-8">
                    <p class="text-[#70685F] font-mono">No journey milestones currently published in database.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.app>
