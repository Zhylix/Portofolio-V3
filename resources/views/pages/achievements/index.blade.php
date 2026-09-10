<x-layouts.app title="Achievements & Honors">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Header -->
        <x-section-heading 
            label="// HONORS & RECOGNITION"
            title="Honors & Achievements"
            description="Competitive hackathons, enterprise leadership recognitions, and national technical awards."
        />

        <!-- Achievements Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($achievements as $achievement)
                <x-achievement-card :achievement="$achievement" />
            @empty
                <div class="col-span-3 text-center py-16 border border-dashed border-[#2A2520] rounded-3xl p-8">
                    <p class="text-[#70685F] font-mono">No achievements currently recorded in database.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination Links -->
        @if($achievements->hasPages())
            <div class="mt-12 pt-8 border-t border-[#2A2520]">
                {{ $achievements->links() }}
            </div>
        @endif

    </div>
</x-layouts.app>
