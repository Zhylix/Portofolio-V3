<x-filament-widgets::widget>
    <div class="bg-[#151311] border border-[#2A2520] rounded-2xl p-5 sm:p-6 flex flex-col justify-between h-full">
        <div>
            {{-- Header --}}
            <div class="flex items-center justify-between pb-4 border-b border-[#2A2520]">
                <div>
                    <span class="font-mono text-[10px] uppercase tracking-wider text-[#C45A19] block font-medium">Projects</span>
                    <h2 class="font-heading text-lg font-bold text-[#F5F1EA]">Recent Projects</h2>
                    <p class="text-xs text-[#9E958B] mt-0.5">Manage semua project portfolio kamu.</p>
                </div>
                <a href="{{ \App\Filament\Resources\Projects\ProjectResource::getUrl('index') }}" 
                   class="text-xs font-mono text-[#9E958B] hover:text-[#E47A2E] flex items-center gap-1 transition-colors">
                    <span>View all</span> &rarr;
                </a>
            </div>

            {{-- Projects List --}}
            <div class="divide-y divide-[#2A2520]/60 mt-2">
                @forelse ($this->getProjects() as $project)
                    <div class="py-3.5 flex items-center justify-between gap-3 group">
                        <div class="min-w-0 flex-1 space-y-1">
                            <div class="flex items-center gap-2 flex-wrap">
                                <a href="{{ \App\Filament\Resources\Projects\ProjectResource::getUrl('edit', ['record' => $project]) }}" 
                                   class="font-medium text-sm text-[#F5F1EA] hover:text-[#E47A2E] transition-colors truncate">
                                    {{ $project->title }}
                                </a>
                                @if ($project->category)
                                    <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-[#1E1A17] text-[#9E958B] border border-[#2A2520]">
                                        {{ $project->category->name }}
                                    </span>
                                @endif
                                @php
                                    $statusVal = $project->status instanceof \BackedEnum ? $project->status->value : (string) ($project->status ?? 'active');
                                @endphp
                                <span class="text-[10px] font-mono px-2 py-0.5 rounded {{ in_array($statusVal, ['completed', 'published']) ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-amber-500/10 text-amber-400 border border-amber-500/20' }}">
                                    {{ ucfirst($statusVal) }}
                                </span>
                            </div>

                            <div class="flex items-center gap-3 text-xs font-mono text-[#70685F]">
                                @if ($project->technologies->isNotEmpty())
                                    <span class="truncate max-w-[200px] text-[#9E958B]">
                                        {{ $project->technologies->pluck('name')->take(3)->implode(' · ') }}
                                    </span>
                                    <span>&bull;</span>
                                @endif
                                <span>Updated {{ $project->updated_at?->diffForHumans() }}</span>
                            </div>
                        </div>

                        <a href="{{ \App\Filament\Resources\Projects\ProjectResource::getUrl('edit', ['record' => $project]) }}"
                           class="opacity-70 group-hover:opacity-100 text-xs font-mono px-2.5 py-1 rounded-lg bg-[#1E1A17] hover:bg-[#2A2520] text-[#F5F1EA] border border-[#2A2520] transition-all shrink-0">
                            Edit
                        </a>
                    </div>
                @empty
                    <div class="py-8 text-center space-y-2.5">
                        <p class="text-sm font-semibold text-[#F5F1EA]">No Projects Yet</p>
                        <p class="text-xs text-[#9E958B]">Belum ada project yang ditambahkan.<br>Start by creating your first project.</p>
                        <a href="{{ \App\Filament\Resources\Projects\ProjectResource::getUrl('create') }}" 
                           class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-mono font-medium bg-[#C45A19] text-[#F5F1EA] hover:bg-[#E47A2E] transition-colors mt-2">
                            <span>+ Add Project</span>
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
