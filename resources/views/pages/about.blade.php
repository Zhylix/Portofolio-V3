<x-layouts.app title="About & Engineering Philosophy">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumb / Preheading -->
        <x-section-heading 
            label="// IDENTITY & ARCHITECTURE"
            title="About Helmy Yunan Nasution"
            description="A rigorous approach to backend engineering, relational systems, and scalable digital architectures."
        />

        <!-- Main Narrative Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mb-20">
            <!-- Left 2 Cols: Comprehensive Narrative -->
            <div class="lg:col-span-2 space-y-6 text-[#9E958B] leading-relaxed text-base">
                <div class="p-8 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-4">
                    <h3 class="text-2xl font-heading font-bold text-[#F5F1EA]">
                        {{ $profile->headline ?? 'Software Engineer & Web Developer' }}
                    </h3>
                    <p class="font-sans">
                        Saya suka building things that are useful, scalable, and visually clean. Fokus utama saya adalah arsitektur web modern, API design, dan performa backend yang solid.
                    </p>
                    <p>
                        {{ $profile->bio ?? 'Dengan pengalaman langsung dalam perancangan dan implementasi aplikasi web, saya memprioritaskan kesederhanaan kode, tipe data yang ketat, serta pengujian otomatis agar setiap sistem dapat berjalan dengan andal di lingkungan produksi.' }}
                    </p>
                </div>

                <!-- Interactive Philosophy Tabs -->
                <div 
                    x-data="{ activeTab: 'code' }"
                    class="bg-[#151311] border border-[#2A2520] rounded-3xl p-6 sm:p-8"
                >
                    <div class="flex flex-wrap gap-2 pb-4 border-b border-[#2A2520] mb-6">
                        <button 
                            type="button" 
                            @click="activeTab = 'code'"
                            :class="activeTab === 'code' ? 'bg-[#C45A19] text-[#F5F1EA] border-[#E47A2E]' : 'bg-[#0E0D0C] text-[#9E958B] hover:text-[#F5F1EA] border-[#2A2520]'"
                            class="px-4 py-2 rounded-full text-xs font-mono uppercase tracking-wider font-semibold border transition"
                        >
                            [ CODE ]
                        </button>
                        <button 
                            type="button" 
                            @click="activeTab = 'build'"
                            :class="activeTab === 'build' ? 'bg-[#C45A19] text-[#F5F1EA] border-[#E47A2E]' : 'bg-[#0E0D0C] text-[#9E958B] hover:text-[#F5F1EA] border-[#2A2520]'"
                            class="px-4 py-2 rounded-full text-xs font-mono uppercase tracking-wider font-semibold border transition"
                        >
                            [ BUILD ]
                        </button>
                        <button 
                            type="button" 
                            @click="activeTab = 'design'"
                            :class="activeTab === 'design' ? 'bg-[#C45A19] text-[#F5F1EA] border-[#E47A2E]' : 'bg-[#0E0D0C] text-[#9E958B] hover:text-[#F5F1EA] border-[#2A2520]'"
                            class="px-4 py-2 rounded-full text-xs font-mono uppercase tracking-wider font-semibold border transition"
                        >
                            [ DESIGN ]
                        </button>
                        <button 
                            type="button" 
                            @click="activeTab = 'learn'"
                            :class="activeTab === 'learn' ? 'bg-[#C45A19] text-[#F5F1EA] border-[#E47A2E]' : 'bg-[#0E0D0C] text-[#9E958B] hover:text-[#F5F1EA] border-[#2A2520]'"
                            class="px-4 py-2 rounded-full text-xs font-mono uppercase tracking-wider font-semibold border transition"
                        >
                            [ LEARN ]
                        </button>
                    </div>

                    <div>
                        <div x-show="activeTab === 'code'" class="space-y-3">
                            <h4 class="text-lg font-heading font-bold text-[#F5F1EA]">Defensive Code & Domain Clarity</h4>
                            <p class="text-sm text-[#9E958B]">
                                Every class and method should have a singular responsibility. Writing explicit contracts, exhaustive unit tests, and maintainable data models minimizes regressions and technical debt.
                            </p>
                        </div>
                        <div x-show="activeTab === 'build'" style="display: none;" class="space-y-3">
                            <h4 class="text-lg font-heading font-bold text-[#F5F1EA]">Scalability & High Concurrency</h4>
                            <p class="text-sm text-[#9E958B]">
                                Systems must fail gracefully. Using Redis queues, asynchronous worker pools, structured logging, and zero-downtime deployment strategies to handle surges in traffic seamlessly.
                            </p>
                        </div>
                        <div x-show="activeTab === 'design'" style="display: none;" class="space-y-3">
                            <h4 class="text-lg font-heading font-bold text-[#F5F1EA]">Design Systems & User Focus</h4>
                            <p class="text-sm text-[#9E958B]">
                                Clean visual hierarchy, sensible contrast, dark mode excellence, and micro-interactions ensure the user interface serves the developer and customer alike.
                            </p>
                        </div>
                        <div x-show="activeTab === 'learn'" style="display: none;" class="space-y-3">
                            <h4 class="text-lg font-heading font-bold text-[#F5F1EA]">Continuous Knowledge Exploration</h4>
                            <p class="text-sm text-[#9E958B]">
                                Constant study of emerging database mechanics, distributed consensus protocols, and software architecture keeps my work aligned with global standards.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Col: Profile Meta & Quick Stats -->
            <div class="space-y-6">
                <!-- Location & Contact Card -->
                <div class="p-6 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-4">
                    <div class="flex items-center gap-4 pb-3 border-b border-[#2A2520]">
                        <div class="w-14 h-14 rounded-2xl bg-[#0E0D0C] border border-[#2A2520] overflow-hidden flex items-center justify-center shrink-0">
                            @if($profile && $profile->avatar_url)
                                <img 
                                    src="{{ $profile->avatar_url }}" 
                                    alt="{{ $profile->full_name }}" 
                                    width="56" 
                                    height="56" 
                                    loading="lazy" 
                                    decoding="async" 
                                    class="w-full h-full object-cover"
                                />
                            @else
                                <span class="font-mono text-sm font-bold text-[#E47A2E]">HY</span>
                            @endif
                        </div>
                        <div>
                            <h4 class="text-xs font-mono uppercase tracking-widest text-[#E47A2E]">Specifications</h4>
                            <p class="text-sm font-heading font-bold text-[#F5F1EA]">{{ $profile->full_name ?? 'Helmy Yunan Nasution' }}</p>
                        </div>
                    </div>
                    <dl class="space-y-3 text-xs font-mono">
                        <div class="flex items-center justify-between pb-2 border-b border-[#2A2520]">
                            <dt class="text-[#70685F]">Location</dt>
                            <dd class="text-[#F5F1EA] font-semibold">{{ $profile->location ?? 'Jakarta, Indonesia' }}</dd>
                        </div>
                        <div class="flex items-center justify-between pb-2 border-b border-[#2A2520]">
                            <dt class="text-[#70685F]">Availability</dt>
                            <dd class="text-emerald-400 font-semibold">{{ $profile->availability_status ?? 'Open to Projects' }}</dd>
                        </div>
                        <div class="flex items-center justify-between {{ ($profile && $profile->resume_url) ? 'pb-2 border-b border-[#2A2520]' : '' }}">
                            <dt class="text-[#70685F]">Specialization</dt>
                            <dd class="text-[#E47A2E] font-semibold">Backend & Architecture</dd>
                        </div>
                        @if($profile && $profile->resume_url)
                            <div class="pt-2">
                                <a 
                                    href="{{ $profile->resume_url }}" 
                                    target="_blank" 
                                    rel="noopener noreferrer"
                                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-[#1E1A17] hover:bg-[#C45A19] text-[#F5F1EA] border border-[#2A2520] hover:border-[#E47A2E] text-xs font-mono transition"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <span>Download Resume (PDF)</span>
                                </a>
                            </div>
                        @endif
                    </dl>
                </div>

                <!-- Services Offered -->
                @if($services->isNotEmpty())
                    <div class="p-6 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-3">
                        <h4 class="text-xs font-mono uppercase tracking-widest text-[#E47A2E]">Core Services</h4>
                        <ul class="space-y-2 text-sm text-[#9E958B]">
                            @foreach($services as $service)
                                <li class="flex items-start gap-2">
                                    <span class="text-[#E47A2E] mt-0.5">&bull;</span>
                                    <div>
                                        <strong class="text-[#F5F1EA] font-heading block">{{ $service->title }}</strong>
                                        <span class="text-xs text-[#70685F]">{{ $service->description }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <!-- Formal Education Timeline -->
        @if($educations->isNotEmpty())
            <div class="pt-12 border-t border-[#2A2520] mb-20">
                <x-section-heading 
                    label="// ACADEMIC BACKGROUND"
                    title="Formal Education"
                    description="Academic foundations in computer science, software engineering, and analytical theory."
                />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($educations as $edu)
                        <div class="p-6 rounded-2xl bg-[#151311] border border-[#2A2520] space-y-2">
                            <div class="flex items-center justify-between text-xs font-mono text-[#E47A2E]">
                                <span>{{ $edu->started_at ? $edu->started_at->format('Y') : '' }} — {{ $edu->ended_at ? $edu->ended_at->format('Y') : 'Present' }}</span>
                            </div>
                            <h4 class="text-xl font-heading font-bold text-[#F5F1EA]">{{ $edu->institution }}</h4>
                            <p class="text-sm font-mono text-[#9E958B]">{{ $edu->degree }} in {{ $edu->major }}</p>
                            @if($edu->description)
                                <p class="text-xs text-[#70685F] pt-2">{{ $edu->description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Action Callout -->
        <div class="p-8 sm:p-12 rounded-3xl bg-[#151311] border border-[#2A2520] text-center max-w-3xl mx-auto space-y-6">
            <h3 class="text-2xl font-heading font-bold text-[#F5F1EA]">
                Interested in Working Together?
            </h3>
            <p class="text-sm text-[#9E958B]">
                I am actively taking on strategic software engineering initiatives, technical architecture consultancies, and collaborative endeavors.
            </p>
            <div class="flex items-center justify-center gap-4">
                <x-button href="{{ route('contact.index') }}" variant="primary" size="lg">
                    <span>GET IN TOUCH</span>
                    <span>&rarr;</span>
                </x-button>
                <x-button href="{{ route('projects.index') }}" variant="secondary" size="lg">
                    <span>EXPLORE PROJECTS</span>
                </x-button>
            </div>
        </div>
    </div>
</x-layouts.app>
