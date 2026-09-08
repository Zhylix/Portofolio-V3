<div 
    x-data="{
        init() {
            setInterval(() => {
                if ($wire.isPlaying) {
                    $wire.nextMilestone();
                    const activeEl = document.getElementById('milestone-' + $wire.currentIndex);
                    if (activeEl) {
                        activeEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            }, 4500);
        }
    }"
    class="space-y-10"
>
    <!-- Filter Bar & "Play My Journey" Controls -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 pb-6 border-b border-[#2A2520]">
        <!-- Dynamic Filter Chips -->
        <div class="flex flex-wrap items-center gap-2">
            <button 
                type="button" 
                wire:click="setFilter('all')"
                class="px-3.5 py-1.5 rounded-full text-xs font-mono uppercase tracking-wider border transition-all duration-200 {{ $activeFilter === 'all' ? 'bg-[#C45A19] text-[#F5F1EA] font-semibold border-[#E47A2E] shadow-md shadow-[#C45A19]/20' : 'bg-[#151311] text-[#9E958B] hover:text-[#F5F1EA] hover:bg-[#1E1A17] border-[#2A2520]' }}"
            >
                ALL ({{ $totalCount }})
            </button>

            @foreach($types as $type)
                <button 
                    type="button" 
                    wire:click="setFilter('{{ $type->code }}')"
                    class="px-3.5 py-1.5 rounded-full text-xs font-mono uppercase tracking-wider border transition-all duration-200 {{ $activeFilter === $type->code ? 'bg-[#C45A19] text-[#F5F1EA] font-semibold border-[#E47A2E] shadow-md shadow-[#C45A19]/20' : 'bg-[#151311] text-[#9E958B] hover:text-[#F5F1EA] hover:bg-[#1E1A17] border-[#2A2520]' }}"
                >
                    {{ $type->name }}
                </button>
            @endforeach
        </div>

        <!-- "PLAY MY JOURNEY" Button -->
        <div class="shrink-0 flex items-center gap-3">
            <button 
                type="button" 
                wire:click="togglePlay"
                class="inline-flex items-center gap-2 px-5 py-2 rounded-full font-mono text-xs uppercase tracking-wider font-semibold border transition-all duration-300 {{ $isPlaying ? 'bg-[#E47A2E] text-black border-white shadow-lg shadow-[#E47A2E]/40 animate-pulse' : 'bg-[#1E1A17] hover:bg-[#C45A19] text-[#F5F1EA] border-[#2A2520] hover:border-[#E47A2E]' }}"
            >
                @if($isPlaying)
                    <span>⏸ PAUSE JOURNEY</span>
                @else
                    <span>▶ PLAY MY JOURNEY</span>
                @endif
            </button>
        </div>
    </div>

    <!-- Active Autoplay Player HUD (Sticky when playing) -->
    @if($isPlaying && $experiences->isNotEmpty())
        <div class="sticky top-20 z-30 p-4 rounded-2xl bg-[#0E0D0C]/95 backdrop-blur-xl border border-[#C45A19] shadow-2xl shadow-[#C45A19]/15 flex items-center justify-between gap-4">
            <div class="flex items-center gap-3 truncate">
                <span class="w-3 h-3 rounded-full bg-[#E47A2E] animate-ping shrink-0"></span>
                <div class="truncate">
                    <span class="text-[10px] font-mono text-[#70685F] uppercase block">
                        Milestone {{ $currentIndex + 1 }} of {{ $totalCount }}
                    </span>
                    <span class="text-sm font-heading font-bold text-[#F5F1EA] truncate block">
                        {{ $experiences[$currentIndex]->title ?? 'Milestone' }}
                    </span>
                </div>
            </div>

            <!-- Player Controls -->
            <div class="flex items-center gap-2 shrink-0">
                <button 
                    wire:click="prevMilestone" 
                    type="button" 
                    class="p-2 rounded-full bg-[#151311] hover:bg-[#1E1A17] border border-[#2A2520] text-xs font-mono text-[#F5F1EA]"
                    title="Previous"
                >
                    ⏮
                </button>
                <button 
                    wire:click="nextMilestone" 
                    type="button" 
                    class="p-2 rounded-full bg-[#151311] hover:bg-[#1E1A17] border border-[#2A2520] text-xs font-mono text-[#F5F1EA]"
                    title="Next"
                >
                    ⏭
                </button>
                <button 
                    wire:click="stopPlay" 
                    type="button" 
                    class="px-3 py-1.5 rounded-full bg-rose-950/60 hover:bg-rose-900 border border-rose-800/40 text-xs font-mono text-rose-300"
                    title="Exit Play Mode"
                >
                    ✕ Exit
                </button>
            </div>
        </div>
    @endif

    <!-- Vertical Timeline with Scroll Progression -->
    <div class="relative space-y-8 before:absolute before:inset-0 before:left-8 md:before:left-32 before:w-0.5 before:bg-[#2A2520] before:pointer-events-none">
        @forelse($experiences as $index => $exp)
            <div 
                id="milestone-{{ $index }}"
                class="relative transition-all duration-500 {{ $isPlaying && $currentIndex === $index ? 'ring-2 ring-[#C45A19] rounded-3xl p-1 bg-[#C45A19]/10 shadow-2xl' : '' }}"
            >
                <x-experience-card :experience="$exp" />
            </div>
        @empty
            <div class="text-center py-16 border border-dashed border-[#2A2520] rounded-3xl p-8">
                <p class="text-[#70685F] font-mono">No experiences matching the selected filter.</p>
                <button 
                    wire:click="setFilter('all')" 
                    class="mt-3 text-xs font-mono text-[#E47A2E] hover:underline"
                >
                    Reset Filter
                </button>
            </div>
        @endforelse
    </div>
</div>
