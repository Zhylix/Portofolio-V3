@php
    try {
        $paletteProjects = \Illuminate\Support\Facades\Cache::remember('palette.projects', 3600, fn () => \App\Models\Project::ordered()->take(6)->get(['id', 'title', 'slug', 'short_description']));
    } catch (\Throwable) {
        $paletteProjects = collect();
    }

    $navItems = [
        ['title' => 'Home', 'subtitle' => 'Overview & system landing', 'url' => route('home'), 'badge' => 'Nav'],
        ['title' => 'About', 'subtitle' => 'Developer identity & background', 'url' => route('about'), 'badge' => 'Bio'],
        ['title' => 'Projects', 'subtitle' => 'Case studies & production systems', 'url' => route('projects.index'), 'badge' => 'Work'],
        ['title' => 'Skills', 'subtitle' => 'Capabilities & technical competencies', 'url' => route('skills.index'), 'badge' => 'Stack'],
        ['title' => 'Achievements', 'subtitle' => 'Distinctions, awards & honors', 'url' => route('achievements.index'), 'badge' => 'Honors'],
        ['title' => 'Certificates', 'subtitle' => 'Verified licenses & certifications', 'url' => route('certificates.index'), 'badge' => 'Certs'],
        ['title' => 'Contact', 'subtitle' => 'Start an inquiry or technical collaboration', 'url' => route('contact.index'), 'badge' => 'Contact'],
    ];
@endphp

<div 
    x-data="commandPalette({ navItems: {{ \Illuminate\Support\Js::from($navItems) }} })"
    x-on:open-command-palette.window="open()"
    x-on:keydown.escape.window="close()"
    style="display: none;"
    x-show="isOpen"
    class="fixed inset-0 z-50 overflow-y-auto p-4 sm:p-6 lg:p-20 flex items-start justify-center"
    role="dialog"
    aria-modal="true"
>
    <!-- Backdrop Blur -->
    <div 
        x-show="isOpen"
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="close()" 
        class="fixed inset-0 bg-black/80 backdrop-blur-md transition-opacity"
        aria-hidden="true"
    ></div>

    <!-- Dialog Window -->
    <div 
        x-show="isOpen"
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 -translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 -translate-y-4"
        class="relative w-full max-w-2xl bg-[#0E0D0C] border border-[#2A2520] rounded-3xl shadow-2xl overflow-hidden z-10 my-auto"
    >
        <!-- Search Input Bar -->
        <div class="relative flex items-center px-4 border-b border-[#2A2520]">
            <svg class="w-5 h-5 text-[#9E958B] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>

            <input 
                x-ref="searchInput"
                x-model="search"
                type="text" 
                placeholder="Type a command, project, or search query... (try 'terminal')"
                @input="handleSearchInput()"
                x-on:keydown.arrow-down.prevent="navigateDown()"
                x-on:keydown.arrow-up.prevent="navigateUp()"
                x-on:keydown.enter.prevent="handleEnter()"
                class="w-full bg-transparent px-4 py-4 text-sm font-sans text-[#F5F1EA] placeholder-[#70685F] focus:outline-none"
            >

            <button 
                type="button"
                @click="close()"
                class="px-2 py-1 rounded bg-[#1E1A17] border border-[#2A2520] text-[10px] font-mono text-[#9E958B] hover:text-[#F5F1EA]"
            >
                ESC
            </button>
        </div>

        <!-- Terminal Easter Egg HUD -->
        <div x-show="easterEgg" class="p-5 bg-black/95 font-mono text-xs text-emerald-400 space-y-3 max-h-96 overflow-y-auto border-b border-[#2A2520]">
            <div class="flex items-center justify-between pb-2 border-b border-emerald-950 text-[11px] text-[#E47A2E]">
                <span>[ DEVELOPER EASTER EGG // HELMY CONSOLE ]</span>
                <button type="button" @click="easterEgg = false" class="text-rose-400 hover:underline">close</button>
            </div>
            <template x-for="(line, idx) in terminalOutput" :key="idx">
                <p class="leading-relaxed select-all" x-text="line"></p>
            </template>
            <form @submit.prevent="handleTerminalCommand" class="flex items-center gap-2 pt-2">
                <span class="text-[#E47A2E] font-bold">&gt;</span>
                <input 
                    type="text" 
                    x-model="terminalInput" 
                    placeholder="type neofetch or help..." 
                    class="w-full bg-transparent text-emerald-300 outline-none text-xs"
                >
            </form>
        </div>

        <!-- Results / Suggestions Container -->
        <div 
            class="max-h-[60vh] overflow-y-auto p-4 space-y-6"
            x-on:keydown.arrow-down.prevent="navigateDown()"
            x-on:keydown.arrow-up.prevent="navigateUp()"
        >
            <!-- Navigation Links -->
            <div class="space-y-1">
                <p class="text-[10px] font-mono uppercase tracking-widest text-[#70685F] px-3 mb-2">Navigation</p>
                <template x-for="item in navItems.filter(i => !search || i.title.toLowerCase().includes(search.toLowerCase()) || i.subtitle.toLowerCase().includes(search.toLowerCase()))" :key="item.title">
                    <a 
                        :href="item.url" 
                        tabindex="0"
                        class="palette-item flex items-center justify-between p-2.5 rounded-xl hover:bg-[#151311] focus:bg-[#1E1A17] border border-transparent hover:border-[#2A2520] focus:border-[#C45A19] focus:outline-none transition group"
                    >
                        <div class="flex items-center gap-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C45A19] group-hover:scale-125 transition-transform"></span>
                            <div>
                                <p class="text-sm font-semibold text-[#F5F1EA] group-hover:text-[#E47A2E] group-focus:text-[#E47A2E] transition-colors" x-text="item.title"></p>
                                <p class="text-xs text-[#9E958B]" x-text="item.subtitle"></p>
                            </div>
                        </div>
                        <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-[#1E1A17] text-[#9E958B] border border-[#2A2520]" x-text="item.badge"></span>
                    </a>
                </template>
            </div>

            <!-- Projects Live Suggestions -->
            @if($paletteProjects->isNotEmpty())
                <div class="space-y-1 pt-2 border-t border-[#2A2520]">
                    <p class="text-[10px] font-mono uppercase tracking-widest text-[#70685F] px-3 mb-2">Featured Projects</p>
                    @foreach($paletteProjects as $proj)
                        <a 
                            href="{{ route('projects.show', $proj->slug) }}" 
                            tabindex="0"
                            class="palette-item flex items-center justify-between p-2.5 rounded-xl hover:bg-[#151311] focus:bg-[#1E1A17] border border-transparent hover:border-[#2A2520] focus:border-[#C45A19] focus:outline-none transition group"
                        >
                            <div class="truncate max-w-md">
                                <p class="text-sm font-semibold text-[#F5F1EA] group-hover:text-[#E47A2E] group-focus:text-[#E47A2E] transition-colors truncate">
                                    {{ $proj->title }}
                                </p>
                                <p class="text-xs text-[#9E958B] truncate">{{ $proj->short_description }}</p>
                            </div>
                            <span class="text-xs font-mono text-[#E47A2E] shrink-0">&rarr;</span>
                        </a>
                    @endforeach
                </div>
            @endif

        </div>

        <!-- Palette Footer Keybinds -->
        <div class="px-5 py-3 bg-[#080808] border-t border-[#2A2520] flex items-center justify-between text-[11px] font-mono text-[#70685F]">
            <div class="flex items-center gap-4">
                <span><kbd class="px-1.5 py-0.5 rounded bg-[#1E1A17] border border-[#2A2520] text-[#F5F1EA]">↵</kbd> select</span>
                <span><kbd class="px-1.5 py-0.5 rounded bg-[#1E1A17] border border-[#2A2520] text-[#F5F1EA]">esc</kbd> close</span>
            </div>
            <span class="text-[#E47A2E]">Zephyr System</span>
        </div>
    </div>
</div>
