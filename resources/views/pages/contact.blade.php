<x-layouts.app title="Contact & Conversational Collaboration">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Header -->
        <x-section-heading 
            label="// CONNECT & COLLABORATE"
            title="Start a Conversation"
            description="Whether you have an enterprise system to build, an architectural challenge to solve, or just want to connect, feel free to reach out."
        />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Left Col: Profile & Reach Out Info -->
            <div class="space-y-8">
                <!-- Status Card -->
                <div class="p-6 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-4">
                    <div class="flex items-center gap-2">
                        @if($profile && $profile->is_available)
                            <span class="relative flex h-2.5 w-2.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#E47A2E] opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-[#C45A19]"></span>
                            </span>
                            <span class="text-xs font-mono uppercase tracking-widest text-[#E47A2E]">
                                {{ $profile->availability_status ?? 'Available for Collaboration' }}
                            </span>
                        @else
                            <span class="inline-flex rounded-full h-2.5 w-2.5 bg-[#9E958B]"></span>
                            <span class="text-xs font-mono uppercase tracking-widest text-[#9E958B]">
                                Limited Availability
                            </span>
                        @endif
                    </div>
                    <p class="text-xs text-[#9E958B] leading-relaxed">
                        Currently responding to new project inquiries and architectural consultation requests within 24-48 business hours.
                    </p>
                </div>

                <!-- Direct Contact Details -->
                <div class="p-6 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-4 text-xs font-mono">
                    <h4 class="text-[#E47A2E] uppercase tracking-widest">Direct Channels</h4>
                    <div class="space-y-3">
                        <div>
                            <span class="text-[#70685F] block">Primary Email</span>
                            <a href="mailto:{{ $profile->email ?? 'helmy@helmyyunan.dev' }}" class="text-[#F5F1EA] hover:text-[#E47A2E] transition-colors">
                                {{ $profile->email ?? 'helmy@helmyyunan.dev' }}
                            </a>
                        </div>
                        <div>
                            <span class="text-[#70685F] block">Location</span>
                            <span class="text-[#F5F1EA]">{{ $profile->location ?? 'Jakarta, Indonesia (UTC+7)' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Social Links -->
                @if($socialLinks->isNotEmpty())
                    <div class="p-6 rounded-3xl bg-[#151311] border border-[#2A2520] space-y-3">
                        <h4 class="text-xs font-mono uppercase tracking-widest text-[#E47A2E]">Professional Networks</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($socialLinks as $link)
                                <a 
                                    href="{{ $link->url }}" 
                                    target="_blank" 
                                    rel="noopener noreferrer"
                                    class="px-3 py-1.5 rounded-full bg-[#1E1A17] border border-[#2A2520] text-xs font-mono text-[#9E958B] hover:text-[#E47A2E] hover:border-[#C45A19] transition"
                                >
                                    {{ $link->platform }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right 2 Cols: Conversational Multi-Step Form -->
            <div class="lg:col-span-2">
                <div 
                    x-data="contactForm({
                        step: {{ $errors->any() ? 3 : 1 }},
                        type: {{ \Illuminate\Support\Js::from(old('type', 'project')) }},
                        subject: {{ \Illuminate\Support\Js::from(old('subject', '')) }},
                        name: {{ \Illuminate\Support\Js::from(old('name', '')) }},
                        email: {{ \Illuminate\Support\Js::from(old('email', '')) }},
                        message: {{ \Illuminate\Support\Js::from(old('message', '')) }}
                    })"
                    class="p-8 sm:p-10 rounded-3xl bg-[#151311] border border-[#2A2520] shadow-2xl relative"
                >
                    <!-- Success Banner -->
                    @if(session('success'))
                        <div class="mb-8 p-4 rounded-2xl bg-emerald-950/60 border border-emerald-800/60 text-emerald-300 text-sm flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Validation Errors Banner -->
                    @if($errors->any())
                        <div class="mb-8 p-4 rounded-2xl bg-rose-950/60 border border-rose-800/60 text-rose-300 text-sm space-y-1">
                            <p class="font-semibold">Please check the following fields:</p>
                            <ul class="list-disc list-inside text-xs">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Step Progress Indicator -->
                    <div class="flex items-center justify-between mb-8 pb-4 border-b border-[#2A2520] text-xs font-mono">
                        <div class="flex items-center gap-3">
                            <span 
                                class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold transition-colors"
                                :class="step >= 1 ? 'bg-[#C45A19] text-white' : 'bg-[#1E1A17] text-[#70685F]'"
                            >1</span>
                            <span class="w-6 h-0.5" :class="step >= 2 ? 'bg-[#C45A19]' : 'bg-[#2A2520]'"></span>
                            <span 
                                class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold transition-colors"
                                :class="step >= 2 ? 'bg-[#C45A19] text-white' : 'bg-[#1E1A17] text-[#70685F]'"
                            >2</span>
                            <span class="w-6 h-0.5" :class="step >= 3 ? 'bg-[#C45A19]' : 'bg-[#2A2520]'"></span>
                            <span 
                                class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold transition-colors"
                                :class="step === 3 ? 'bg-[#C45A19] text-white' : 'bg-[#1E1A17] text-[#70685F]'"
                            >3</span>
                        </div>
                        <span class="text-[#70685F]">Conversational Flow</span>
                    </div>

                    <form 
                        action="{{ route('contact.store') }}" 
                        method="POST"
                        class="space-y-8"
                    >
                        @csrf

                        {{-- Honeypot anti-spam protection --}}
                        <div style="position: absolute; left: -9999px; opacity: 0; pointer-events: none;" aria-hidden="true">
                            <input type="text" name="website_hp" tabindex="-1" autocomplete="off">
                        </div>

                        <input type="hidden" name="type" :value="selectedType">

                        <!-- STEP 1: What are you looking for? -->
                        <div x-show="step === 1" x-transition:enter="transition duration-200 ease-out" class="space-y-6">
                            <div class="space-y-1">
                                <span class="text-xs font-mono uppercase tracking-widest text-[#E47A2E]">Step 1 of 3</span>
                                <h3 class="text-2xl font-heading font-bold text-[#F5F1EA]">What are you looking for?</h3>
                                <p class="text-sm text-[#9E958B]">Select the nature of your inquiry to tailor the conversation.</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                                @php
                                    $options = [
                                        'website' => ['label' => 'Website', 'desc' => 'High-performance web applications & platforms'],
                                        'collaboration' => ['label' => 'Collaboration', 'desc' => 'Joint engineering or open source synergy'],
                                        'freelance' => ['label' => 'Freelance', 'desc' => 'Targeted contract or consulting scope'],
                                        'project' => ['label' => 'Project', 'desc' => 'Full-lifecycle software architecture initiative'],
                                        'just_say_hi' => ['label' => 'Just Say Hi', 'desc' => 'Tech networking & casual greeting'],
                                    ];
                                @endphp

                                @foreach($options as $val => $info)
                                    <button 
                                        type="button" 
                                        @click="selectedType = '{{ $val }}'"
                                        :class="selectedType === '{{ $val }}' ? 'border-[#C45A19] bg-[#1E1A17] ring-1 ring-[#C45A19] shadow-lg shadow-[#C45A19]/15' : 'border-[#2A2520] bg-[#0E0D0C] hover:border-[#3D352E] hover:bg-[#151311]'"
                                        class="p-4 rounded-2xl border text-left transition-all duration-200 group"
                                    >
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-sm font-heading font-bold text-[#F5F1EA] group-hover:text-[#E47A2E]">
                                                {{ $info['label'] }}
                                            </span>
                                            <span 
                                                class="w-3 h-3 rounded-full border border-[#2A2520]"
                                                :class="selectedType === '{{ $val }}' ? 'bg-[#C45A19] border-[#E47A2E]' : ''"
                                            ></span>
                                        </div>
                                        <p class="text-xs text-[#9E958B]">{{ $info['desc'] }}</p>
                                    </button>
                                @endforeach
                            </div>

                            <div class="pt-4 flex justify-end">
                                <button 
                                    type="button" 
                                    @click="step = 2"
                                    class="px-6 py-2.5 rounded-full bg-[#C45A19] hover:bg-[#E47A2E] text-white font-mono text-xs uppercase tracking-wider font-semibold transition inline-flex items-center gap-2 shadow-lg shadow-[#C45A19]/25"
                                >
                                    <span>Next Step</span>
                                    <span>&rarr;</span>
                                </button>
                            </div>
                        </div>

                        <!-- STEP 2: What's your project about? -->
                        <div x-show="step === 2" x-transition:enter="transition duration-200 ease-out" style="display: none;" class="space-y-6">
                            <div class="space-y-1">
                                <span class="text-xs font-mono uppercase tracking-widest text-[#E47A2E]">Step 2 of 3</span>
                                <h3 class="text-2xl font-heading font-bold text-[#F5F1EA]">What's your project about?</h3>
                                <p class="text-sm text-[#9E958B]">A short phrase or title defining the initiative or goal.</p>
                            </div>

                            <div class="space-y-3">
                                <input 
                                    type="text" 
                                    id="subject" 
                                    name="subject" 
                                    x-model="subject"
                                    placeholder="e.g. Enterprise Cloud Database Migration or API Architecture..."
                                    class="w-full px-5 py-4 rounded-2xl bg-[#0E0D0C] border border-[#2A2520] focus:border-[#C45A19] focus:ring-1 focus:ring-[#C45A19] text-[#F5F1EA] placeholder-[#70685F] text-sm font-sans outline-none transition"
                                >

                                <!-- Quick Suggestions -->
                                <div class="pt-2">
                                    <span class="text-[11px] font-mono text-[#70685F] block mb-2">Suggestions (Click to insert):</span>
                                    <div class="flex flex-wrap gap-2">
                                        <button type="button" @click="subject = 'Scalable Multi-Tenant Architecture'" class="px-2.5 py-1 rounded-full bg-[#0E0D0C] hover:bg-[#1E1A17] border border-[#2A2520] text-[11px] font-mono text-[#9E958B]">Multi-Tenant Architecture</button>
                                        <button type="button" @click="subject = 'High-Concurrency Database Optimization'" class="px-2.5 py-1 rounded-full bg-[#0E0D0C] hover:bg-[#1E1A17] border border-[#2A2520] text-[11px] font-mono text-[#9E958B]">Database Optimization</button>
                                        <button type="button" @click="subject = 'Contract Engineering Leadership'" class="px-2.5 py-1 rounded-full bg-[#0E0D0C] hover:bg-[#1E1A17] border border-[#2A2520] text-[11px] font-mono text-[#9E958B]">Engineering Leadership</button>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 flex items-center justify-between">
                                <button 
                                    type="button" 
                                    @click="step = 1"
                                    class="px-5 py-2.5 rounded-full bg-[#151311] hover:bg-[#1E1A17] border border-[#2A2520] text-[#9E958B] hover:text-[#F5F1EA] font-mono text-xs uppercase tracking-wider transition"
                                >
                                    &larr; Back
                                </button>
                                <button 
                                    type="button" 
                                    @click="step = 3"
                                    class="px-6 py-2.5 rounded-full bg-[#C45A19] hover:bg-[#E47A2E] text-white font-mono text-xs uppercase tracking-wider font-semibold transition inline-flex items-center gap-2 shadow-lg shadow-[#C45A19]/25"
                                >
                                    <span>Next Step</span>
                                    <span>&rarr;</span>
                                </button>
                            </div>
                        </div>

                        <!-- STEP 3: Name, Email & Message -->
                        <div x-show="step === 3" x-transition:enter="transition duration-200 ease-out" style="display: none;" class="space-y-6">
                            <div class="space-y-1">
                                <span class="text-xs font-mono uppercase tracking-widest text-[#E47A2E]">Step 3 of 3</span>
                                <h3 class="text-2xl font-heading font-bold text-[#F5F1EA]">How can I reach you?</h3>
                                <p class="text-sm text-[#9E958B]">Provide your contact information and detailed project requirements.</p>
                            </div>

                            <!-- Summary Pill -->
                            <div class="p-3.5 rounded-xl bg-[#0E0D0C] border border-[#2A2520] flex items-center justify-between text-xs font-mono text-[#9E958B]">
                                <div class="truncate">
                                    <span class="text-[#E47A2E]" x-text="typeLabels[selectedType] || selectedType"></span>
                                    <span x-show="subject" x-text="' &bull; ' + subject"></span>
                                </div>
                                <button type="button" @click="step = 1" class="text-xs text-[#70685F] hover:text-[#E47A2E] shrink-0 ml-2">Edit</button>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label for="name" class="text-xs font-mono uppercase tracking-wider text-[#F5F1EA] block">
                                        Your Name <span class="text-[#E47A2E]">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="name" 
                                        name="name" 
                                        x-model="name"
                                        required 
                                        placeholder="e.g. Sarah Connor"
                                        class="w-full px-4 py-3 rounded-xl bg-[#0E0D0C] border border-[#2A2520] focus:border-[#C45A19] focus:ring-1 focus:ring-[#C45A19] text-[#F5F1EA] placeholder-[#70685F] text-sm font-sans outline-none transition"
                                    >
                                </div>

                                <div class="space-y-1.5">
                                    <label for="email" class="text-xs font-mono uppercase tracking-wider text-[#F5F1EA] block">
                                        Email Address <span class="text-[#E47A2E]">*</span>
                                    </label>
                                    <input 
                                        type="email" 
                                        id="email" 
                                        name="email" 
                                        x-model="email"
                                        required 
                                        placeholder="sarah@organization.com"
                                        class="w-full px-4 py-3 rounded-xl bg-[#0E0D0C] border border-[#2A2520] focus:border-[#C45A19] focus:ring-1 focus:ring-[#C45A19] text-[#F5F1EA] placeholder-[#70685F] text-sm font-sans outline-none transition"
                                    >
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label for="message" class="text-xs font-mono uppercase tracking-wider text-[#F5F1EA] block">
                                    Message <span class="text-[#E47A2E]">*</span>
                                </label>
                                <textarea 
                                    id="message" 
                                    name="message" 
                                    x-model="message"
                                    rows="4" 
                                    required 
                                    minlength="10"
                                    placeholder="Share details regarding scope, timeline, engineering requirements, or key deliverables..."
                                    class="w-full px-4 py-3 rounded-xl bg-[#0E0D0C] border border-[#2A2520] focus:border-[#C45A19] focus:ring-1 focus:ring-[#C45A19] text-[#F5F1EA] placeholder-[#70685F] text-sm font-sans outline-none transition resize-y"
                                ></textarea>
                            </div>

                            <div class="pt-4 flex items-center justify-between">
                                <button 
                                    type="button" 
                                    @click="step = 2"
                                    class="px-5 py-2.5 rounded-full bg-[#151311] hover:bg-[#1E1A17] border border-[#2A2520] text-[#9E958B] hover:text-[#F5F1EA] font-mono text-xs uppercase tracking-wider transition"
                                >
                                    &larr; Back
                                </button>

                                <button 
                                    type="submit" 
                                    class="px-8 py-3 rounded-full bg-gradient-to-r from-[#C45A19] to-[#E47A2E] hover:from-[#E47A2E] hover:to-[#C45A19] text-white font-mono text-xs uppercase tracking-wider font-semibold transition inline-flex items-center gap-2 shadow-lg shadow-[#C45A19]/30"
                                >
                                    <span>TRANSMIT MESSAGE</span>
                                    <span>&rarr;</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-layouts.app>
