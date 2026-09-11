<x-layouts.app :title="$profile ? $profile->full_name : 'Helmy Yunan Nasution'">

    <!-- 1. HERO SECTION -->
    <section id="hero-section" class="relative min-h-[85vh] flex items-center justify-center px-4 sm:px-6 lg:px-8 py-16 sm:py-24 overflow-hidden">
        <!-- Interactive Mouse Follow Radial Glow (Desktop Only) -->
        <div id="hero-glow-follow" class="absolute w-[450px] h-[450px] rounded-full bg-[radial-gradient(circle,_rgba(196,90,25,0.18)_0%,_transparent_70%)] pointer-events-none -translate-x-1/2 -translate-y-1/2 blur-2xl opacity-0 transition-opacity duration-300 z-0 hidden lg:block" aria-hidden="true"></div>

        <div class="max-w-5xl mx-auto w-full flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-16 relative z-10">
            
            <!-- Left: Hero Text Content -->
            <div class="flex-1 text-center lg:text-left space-y-6">
                <!-- Availability Pill -->
                <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-[#151311] border border-[#2A2520] shadow-sm">
                    @if($profile && $profile->is_available)
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#E47A2E] opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-[#C45A19]"></span>
                        </span>
                        <span class="text-xs font-mono uppercase tracking-widest text-[#F5F1EA]">
                            {{ $profile->availability_status ?? 'AVAILABLE FOR COLLABORATION' }}
                        </span>
                    @else
                        <span class="inline-flex rounded-full h-2.5 w-2.5 bg-[#9E958B]"></span>
                        <span class="text-xs font-mono uppercase tracking-widest text-[#9E958B]">
                            CURRENTLY ENGAGED
                        </span>
                    @endif
                </div>

                <!-- Main Greeting & Name -->
                <div class="space-y-2">
                    <p class="text-sm sm:text-base font-mono uppercase tracking-widest text-[#E47A2E]">
                        HELLO, I'M ZEPHYR.
                    </p>
                    <h1 class="text-4xl sm:text-6xl lg:text-7xl font-heading font-extrabold text-[#F5F1EA] tracking-tight uppercase leading-none">
                        {{ $profile ? $profile->full_name : 'Helmy Yunan Nasution' }}
                    </h1>
                </div>

                <!-- Headline -->
                <p class="text-xl sm:text-2xl font-heading font-semibold text-[#E47A2E] leading-snug max-w-2xl">
                    Web Developer membangun dengan Qualitas yang Hebat
                </p>

                <!-- Bio Summary -->
                <p class="text-base sm:text-lg text-[#9E958B] leading-relaxed max-w-2xl font-sans">
                    {{ $profile ? ($profile->summary ?? $profile->bio) : 'Membangun arsitektur web modern, sistem backend yang terstruktur, dan antarmuka aplikasi yang performant, andal, serta intuitif.' }}
                </p>

                <!-- Action CTAs -->
                <div class="pt-4 flex flex-wrap items-center justify-center lg:justify-start gap-4">
                    <x-button href="#projects" variant="primary" size="lg">
                        <span>EXPLORE PROJECTS</span>
                        <svg class="w-4 h-4 transform group-hover:translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    </x-button>

                    <x-button href="{{ route('contact.index') }}" variant="secondary" size="lg">
                        <span>CONTACT ME</span>
                        <span class="text-[#E47A2E]">&rarr;</span>
                    </x-button>
                </div>
            </div>

            <!-- Right: Visual Profile Element -->
            <div class="w-64 sm:w-80 lg:w-96 shrink-0 relative">
                <div class="relative w-full aspect-square rounded-3xl p-3 bg-gradient-to-b from-[#2A2520] to-[#151311] border border-[#2A2520] shadow-2xl">
                    <div class="w-full h-full rounded-2xl overflow-hidden bg-[#0E0D0C] relative flex items-center justify-center">
                        @php
                            $avatarUrl = $profile ? ($profile->getFirstMediaUrl('avatar', 'medium') ?: ($profile->getFirstMediaUrl('avatar') ?: $profile->avatar_url)) : null;
                        @endphp

                        @if($avatarUrl)
                            <img 
                                src="{{ $avatarUrl }}" 
                                alt="{{ $profile ? $profile->full_name : 'Profile' }}" 
                                width="384"
                                height="384"
                                loading="eager"
                                decoding="async"
                                class="w-full h-full object-cover object-center"
                            />
                        @else
                            <!-- Architectural Avatar Fallback -->
                            <div class="w-full h-full flex flex-col items-center justify-center p-6 text-center relative">
                                <div class="absolute inset-0 bg-grid-subtle opacity-40"></div>
                                <span class="w-20 h-20 rounded-2xl bg-[#151311] border border-[#2A2520] flex items-center justify-center text-3xl font-mono font-bold text-[#E47A2E] mb-3 shadow-inner">
                                    HY
                                </span>
                                <span class="text-xs font-mono tracking-wider uppercase text-[#9E958B]">
                                    Systems Engineer
                                </span>
                                <span class="text-[11px] font-mono text-[#70685F] mt-1">
                                    {{ $profile ? ($profile->location ?? 'Jakarta, ID') : 'Jakarta, ID' }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Floating System Specs Pill -->
                <div class="absolute -bottom-4 -left-4 sm:-bottom-6 sm:-left-6 px-4 py-2.5 rounded-2xl bg-[#0E0D0C]/95 backdrop-blur-xl border border-[#2A2520] shadow-xl flex items-center gap-3">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <div class="text-left">
                        <p class="text-[10px] font-mono text-[#70685F] uppercase tracking-wider">Architecture State</p>
                        <p class="text-xs font-mono font-semibold text-[#F5F1EA]">Production Ready</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. ABOUT & INTERACTIVE PHILOSOPHY TABS -->
    <section class="reveal-on-scroll max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-t border-[#2A2520]">
        <x-section-heading 
            label="// TENTANG SAYA"
            title="Engineering Through Principles"
            description="Saya membangun sistem web yang efisien, terstruktur, dan scalable. Software architecture is more than just syntax; it represents methodical problem solving and user-centric ergonomics."
        />

        <!-- Interactive Tabs: CODE, BUILD, DESIGN, LEARN -->
        <div 
            x-data="{ activeTab: 'code' }"
            class="bg-[#151311] border border-[#2A2520] rounded-3xl p-6 sm:p-10 shadow-2xl"
        >
            <!-- Tab Headers -->
            <div class="flex flex-wrap gap-2 pb-6 border-b border-[#2A2520]">
                <button 
                    type="button" 
                    @click="activeTab = 'code'"
                    :class="activeTab === 'code' ? 'bg-[#C45A19] text-[#F5F1EA] border-[#E47A2E]' : 'bg-[#0E0D0C] text-[#9E958B] hover:text-[#F5F1EA] border-[#2A2520]'"
                    class="px-5 py-2.5 rounded-full text-xs font-mono uppercase tracking-widest font-semibold border transition-all duration-200"
                >
                    [ CODE ]
                </button>

                <button 
                    type="button" 
                    @click="activeTab = 'build'"
                    :class="activeTab === 'build' ? 'bg-[#C45A19] text-[#F5F1EA] border-[#E47A2E]' : 'bg-[#0E0D0C] text-[#9E958B] hover:text-[#F5F1EA] border-[#2A2520]'"
                    class="px-5 py-2.5 rounded-full text-xs font-mono uppercase tracking-widest font-semibold border transition-all duration-200"
                >
                    [ BUILD ]
                </button>

                <button 
                    type="button" 
                    @click="activeTab = 'design'"
                    :class="activeTab === 'design' ? 'bg-[#C45A19] text-[#F5F1EA] border-[#E47A2E]' : 'bg-[#0E0D0C] text-[#9E958B] hover:text-[#F5F1EA] border-[#2A2520]'"
                    class="px-5 py-2.5 rounded-full text-xs font-mono uppercase tracking-widest font-semibold border transition-all duration-200"
                >
                    [ DESIGN ]
                </button>

                <button 
                    type="button" 
                    @click="activeTab = 'learn'"
                    :class="activeTab === 'learn' ? 'bg-[#C45A19] text-[#F5F1EA] border-[#E47A2E]' : 'bg-[#0E0D0C] text-[#9E958B] hover:text-[#F5F1EA] border-[#2A2520]'"
                    class="px-5 py-2.5 rounded-full text-xs font-mono uppercase tracking-widest font-semibold border transition-all duration-200"
                >
                    [ LEARN ]
                </button>
            </div>

            <!-- Tab Content Panels -->
            <div class="pt-8">
                <!-- CODE Tab -->
                <div x-show="activeTab === 'code'" x-transition:enter="transition duration-200 ease-out" class="space-y-4">
                    <div class="inline-flex items-center gap-2 text-xs font-mono uppercase tracking-wider text-[#E47A2E]">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#E47A2E]"></span>
                        Clean Architecture & Maintainability
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-[#F5F1EA]">
                        Deterministic, Type-Safe, and Test-Driven
                    </h3>
                    <p class="text-base text-[#9E958B] leading-relaxed max-w-3xl">
                        Menulis kode dengan pendekatan yang modular dan mudah dimaintain. Mengutamakan pemisahan domain logic yang rapi, strict typing di PHP 8.4, dan automated verification suite untuk menjaga stabilitas sistem jangka panjang.
                    </p>
                    <div class="pt-4 flex flex-wrap gap-2 text-xs font-mono text-[#F5F1EA]">
                        <span class="px-3 py-1 rounded bg-[#1E1A17] border border-[#2A2520]">PHP 8.4</span>
                        <span class="px-3 py-1 rounded bg-[#1E1A17] border border-[#2A2520]">Laravel 13</span>
                        <span class="px-3 py-1 rounded bg-[#1E1A17] border border-[#2A2520]">Refactoring & SOLID</span>
                        <span class="px-3 py-1 rounded bg-[#1E1A17] border border-[#2A2520]">PHPUnit & Pest</span>
                    </div>
                </div>

                <!-- BUILD Tab -->
                <div x-show="activeTab === 'build'" x-transition:enter="transition duration-200 ease-out" style="display: none;" class="space-y-4">
                    <div class="inline-flex items-center gap-2 text-xs font-mono uppercase tracking-wider text-[#E47A2E]">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#E47A2E]"></span>
                        Systems Engineering & Infrastructure
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-[#F5F1EA]">
                        Scalable Distributed Workloads & High Concurrency
                    </h3>
                    <p class="text-base text-[#9E958B] leading-relaxed max-w-3xl">
                        Optimasi database relasional, query efficiency, caching pipeline dengan Redis, serta integrasi deployment modern agar aplikasi mampu menangani beban traffic secara konsisten dengan latency rendah.
                    </p>
                    <div class="pt-4 flex flex-wrap gap-2 text-xs font-mono text-[#F5F1EA]">
                        <span class="px-3 py-1 rounded bg-[#1E1A17] border border-[#2A2520]">MySQL Optimization</span>
                        <span class="px-3 py-1 rounded bg-[#1E1A17] border border-[#2A2520]">Redis Pipelines</span>
                        <span class="px-3 py-1 rounded bg-[#1E1A17] border border-[#2A2520]">Docker Ecosystems</span>
                        <span class="px-3 py-1 rounded bg-[#1E1A17] border border-[#2A2520]">CI/CD Automations</span>
                    </div>
                </div>

                <!-- DESIGN Tab -->
                <div x-show="activeTab === 'design'" x-transition:enter="transition duration-200 ease-out" style="display: none;" class="space-y-4">
                    <div class="inline-flex items-center gap-2 text-xs font-mono uppercase tracking-wider text-[#E47A2E]">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#E47A2E]"></span>
                        Functional Ergonomics & Interface Precision
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-[#F5F1EA]">
                        Purpose-Driven Ergonomics for Humans
                    </h3>
                    <p class="text-base text-[#9E958B] leading-relaxed max-w-3xl">
                        Desain antarmuka yang clean dan responsif. Menggabungkan Tailwind CSS 4, Alpine.js, dan reusable Blade components untuk menghasilkan pengalaman visual yang modern, cepat, dan mudah dinavigasi.
                    </p>
                    <div class="pt-4 flex flex-wrap gap-2 text-xs font-mono text-[#F5F1EA]">
                        <span class="px-3 py-1 rounded bg-[#1E1A17] border border-[#2A2520]">Design Systems</span>
                        <span class="px-3 py-1 rounded bg-[#1E1A17] border border-[#2A2520]">Tailwind CSS 4</span>
                        <span class="px-3 py-1 rounded bg-[#1E1A17] border border-[#2A2520]">Alpine.js Ergonomics</span>
                        <span class="px-3 py-1 rounded bg-[#1E1A17] border border-[#2A2520]">WCAG Accessibility</span>
                    </div>
                </div>

                <!-- LEARN Tab -->
                <div x-show="activeTab === 'learn'" x-transition:enter="transition duration-200 ease-out" style="display: none;" class="space-y-4">
                    <div class="inline-flex items-center gap-2 text-xs font-mono uppercase tracking-wider text-[#E47A2E]">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#E47A2E]"></span>
                        Continuous Research & Open Source Contribution
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-[#F5F1EA]">
                        Staying Ahead of Industrial State of the Art
                    </h3>
                    <p class="text-base text-[#9E958B] leading-relaxed max-w-3xl">
                        Selalu mengeksplorasi ekosistem web terbaru, benchmarking fitur PHP dan Laravel rilis terkini, serta mengasah pemahaman arsitektur sistem melalui riset berkelanjutan.
                    </p>
                    <div class="pt-4 flex flex-wrap gap-2 text-xs font-mono text-[#F5F1EA]">
                        <span class="px-3 py-1 rounded bg-[#1E1A17] border border-[#2A2520]">Modern Laravel</span>
                        <span class="px-3 py-1 rounded bg-[#1E1A17] border border-[#2A2520]">Open Source Tooling</span>
                        <span class="px-3 py-1 rounded bg-[#1E1A17] border border-[#2A2520]">Cloud Architecture</span>
                        <span class="px-3 py-1 rounded bg-[#1E1A17] border border-[#2A2520]">Continuous Learning</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. FEATURED PROJECTS SECTION (PRIMARY SHOWCASE) -->
    <section id="projects" class="reveal-on-scroll max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-t border-[#2A2520]">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 gap-4">
            <x-section-heading 
                label="// SELECTED PROJECTS"
                title="Featured Projects & Systems"
                description="Case studies in production web applications, architecture designs, and high-performance digital systems."
                class="mb-0"
            />
            <x-button href="{{ route('projects.index') }}" variant="secondary" size="md">
                <span>View All Projects</span>
                <span class="text-[#E47A2E]">&rarr;</span>
            </x-button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse($featuredProjects as $project)
                <x-project-card :project="$project" />
            @empty
                <div class="col-span-2 text-center py-12 border border-dashed border-[#2A2520] rounded-2xl">
                    <p class="text-[#70685F] font-mono">Belum ada project yang ditampilkan.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- 4. CAPABILITIES / SKILLS SECTION WITH MODALS -->
    <section class="reveal-on-scroll max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-t border-[#2A2520]">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 gap-4">
            <x-section-heading 
                label="// CAPABILITIES"
                title="Technical Competencies"
                description="Click any capability to inspect architectural context, production projects, and verified credentials."
                class="mb-0"
            />
            <x-button href="{{ route('skills.index') }}" variant="secondary" size="md">
                <span>All Capabilities</span>
                <span class="text-[#E47A2E]">&rarr;</span>
            </x-button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @forelse($featuredSkills as $skill)
                <x-skill-card :skill="$skill" />
            @empty
                <div class="col-span-4 text-center py-12 border border-dashed border-[#2A2520] rounded-2xl">
                    <p class="text-[#70685F] font-mono">Belum ada skill yang dimuat.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- 5. ACHIEVEMENTS & CERTIFICATES HIGHLIGHTS -->
    <section class="reveal-on-scroll max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-t border-[#2A2520]">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Achievements Column -->
            <div class="space-y-6">
                <div class="flex items-center justify-between pb-2 border-b border-[#2A2520]">
                    <div>
                        <span class="text-xs font-mono uppercase tracking-widest text-[#E47A2E]">// HONORS</span>
                        <h3 class="text-xl font-heading font-bold text-[#F5F1EA]">Recent Achievements</h3>
                    </div>
                    <a href="{{ route('achievements.index') }}" class="text-xs font-mono text-[#9E958B] hover:text-[#E47A2E] transition-colors">
                        View All &rarr;
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse($featuredAchievements as $ach)
                        <x-achievement-card :achievement="$ach" />
                    @empty
                        <div class="text-center py-8 border border-dashed border-[#2A2520] rounded-xl text-xs font-mono text-[#70685F]">
                            Belum ada achievement yang ditampilkan.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Certificates Column -->
            <div class="space-y-6">
                <div class="flex items-center justify-between pb-2 border-b border-[#2A2520]">
                    <div>
                        <span class="text-xs font-mono uppercase tracking-widest text-[#E47A2E]">// CREDENTIALS</span>
                        <h3 class="text-xl font-heading font-bold text-[#F5F1EA]">Verified Certificates</h3>
                    </div>
                    <a href="{{ route('certificates.index') }}" class="text-xs font-mono text-[#9E958B] hover:text-[#E47A2E] transition-colors">
                        View All &rarr;
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse($featuredCertificates as $cert)
                        <x-certificate-card :certificate="$cert" />
                    @empty
                        <div class="text-center py-8 border border-dashed border-[#2A2520] rounded-xl text-xs font-mono text-[#70685F]">
                            Belum ada sertifikat yang ditampilkan.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- 6. CONTACT CALL TO ACTION BANNER -->
    <section class="reveal-on-scroll max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-t border-[#2A2520]">
        <div class="p-8 sm:p-12 lg:p-16 rounded-3xl bg-gradient-to-br from-[#151311] via-[#0E0D0C] to-[#1E1A17] border border-[#2A2520] shadow-2xl relative overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-8">
            <div class="absolute inset-0 bg-grid-subtle opacity-30 pointer-events-none"></div>
            
            <div class="relative z-10 max-w-2xl space-y-4 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#080808] border border-[#2A2520] text-[#E47A2E] text-xs font-mono tracking-widest uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#C45A19] animate-ping"></span>
                    <span>Ready for New Challenges</span>
                </div>
                <h2 class="text-3xl sm:text-4xl font-heading font-bold text-[#F5F1EA]">
                    Have an Architectural Challenge or Project?
                </h2>
                <p class="text-sm sm:text-base text-[#9E958B] leading-relaxed">
                    Tertarik berkolaborasi membangun web application, arsitektur sistem, atau software engineering initiatives? Mari diskusikan ide Anda.
                </p>
            </div>

            <div class="relative z-10 shrink-0">
                <x-button href="{{ route('contact.index') }}" variant="primary" size="lg">
                    <span>START A CONVERSATION</span>
                    <span class="text-white">&rarr;</span>
                </x-button>
            </div>
        </div>
    </section>

</x-layouts.app>
