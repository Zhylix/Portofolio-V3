<x-filament-widgets::widget>
    <div class="bg-[#151311] border border-[#2A2520] rounded-2xl p-5 sm:p-6 flex flex-col justify-between h-full">
        <div>
            {{-- Header --}}
            <div class="flex items-center justify-between pb-4 border-b border-[#2A2520]">
                <div>
                    <span class="font-mono text-[10px] uppercase tracking-wider text-[#C45A19] block font-medium">Activity</span>
                    <h2 class="font-heading text-lg font-bold text-[#F5F1EA]">Recent Activity</h2>
                    <p class="text-xs text-[#9E958B] mt-0.5">Aktivitas update terbaru di portfolio kamu.</p>
                </div>
                <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-[#1E1A17] text-[#9E958B] border border-[#2A2520]">
                    Live Updates
                </span>
            </div>

            {{-- Activity Stream --}}
            <div class="mt-3 divide-y divide-[#2A2520]/50">
                @forelse ($this->getRecentActivities() as $activity)
                    <div class="py-3 flex items-start gap-3 group">
                        <div class="mt-1 w-2 h-2 rounded-full bg-[#C45A19] shrink-0"></div>

                        <div class="min-w-0 flex-1 space-y-0.5">
                            <div class="flex items-center justify-between gap-2">
                                <span class="font-mono text-[10px] uppercase tracking-wider text-[#9E958B]">
                                    {{ $activity['type'] }}
                                </span>
                                <span class="font-mono text-[10px] text-[#70685F] shrink-0">
                                    {{ $activity['timestamp']?->diffForHumans() }}
                                </span>
                            </div>

                            <a href="{{ $activity['url'] }}" 
                               class="font-medium text-xs text-[#F5F1EA] hover:text-[#E47A2E] transition-colors block truncate">
                                {{ $activity['title'] }}
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center text-xs font-mono text-[#9E958B]">
                        Belum ada aktivitas terbaru yang tercatat.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
