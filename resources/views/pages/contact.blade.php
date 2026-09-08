<x-layouts.app title="Contact & Collaboration">
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

            <!-- Right 2 Cols: Interactive Contact Form -->
            <div class="lg:col-span-2">
                <div class="p-8 sm:p-10 rounded-3xl bg-[#151311] border border-[#2A2520] shadow-2xl relative">
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

                    <form 
                        action="{{ route('contact.store') }}" 
                        method="POST"
                        x-data="{ selectedType: '{{ old('type', 'project') }}' }"
                        class="space-y-8"
                    >
                        @csrf

                        <!-- 1. What are you looking for? -->
                        <div class="space-y-3">
                            <label class="text-xs font-mono uppercase tracking-wider text-[#F5F1EA] block">
                                What are you looking for? <span class="text-[#E47A2E]">*</span>
                            </label>

                            <input type="hidden" name="type" :value="selectedType">

                            <div class="flex flex-wrap gap-2.5">
                                @php
                                    $options = [
                                        'website' => 'Website',
                                        'collaboration' => 'Collaboration',
                                        'freelance' => 'Freelance',
                                        'project' => 'Project',
                                        'just_say_hi' => 'Just Say Hi',
                                    ];
                                @endphp

                                @foreach($options as $val => $label)
                                    <button 
                                        type="button" 
                                        @click="selectedType = '{{ $val }}'"
                                        :class="selectedType === '{{ $val }}' ? 'bg-[#C45A19] text-white border-[#E47A2E] shadow-md shadow-[#C45A19]/20 font-semibold' : 'bg-[#0E0D0C] text-[#9E958B] hover:text-[#F5F1EA] border-[#2A2520] hover:bg-[#1E1A17]'"
                                        class="px-4 py-2 rounded-full text-xs font-mono uppercase tracking-wider border transition-all duration-200"
                                    >
                                        {{ $label }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- 2. Personal Information (Name & Email) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="name" class="text-xs font-mono uppercase tracking-wider text-[#F5F1EA] block">
                                    Your Name <span class="text-[#E47A2E]">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    required 
                                    placeholder="e.g. Sarah Connor"
                                    class="w-full px-4 py-3 rounded-xl bg-[#0E0D0C] border border-[#2A2520] focus:border-[#C45A19] focus:ring-1 focus:ring-[#C45A19] text-[#F5F1EA] placeholder-[#70685F] text-sm font-sans transition outline-none"
                                >
                            </div>

                            <div class="space-y-2">
                                <label for="email" class="text-xs font-mono uppercase tracking-wider text-[#F5F1EA] block">
                                    Email Address <span class="text-[#E47A2E]">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    placeholder="sarah@organization.com"
                                    class="w-full px-4 py-3 rounded-xl bg-[#0E0D0C] border border-[#2A2520] focus:border-[#C45A19] focus:ring-1 focus:ring-[#C45A19] text-[#F5F1EA] placeholder-[#70685F] text-sm font-sans transition outline-none"
                                >
                            </div>
                        </div>

                        <!-- 3. Subject (Optional) -->
                        <div class="space-y-2">
                            <label for="subject" class="text-xs font-mono uppercase tracking-wider text-[#F5F1EA] block">
                                Subject / Initiative
                            </label>
                            <input 
                                type="text" 
                                id="subject" 
                                name="subject" 
                                value="{{ old('subject') }}" 
                                placeholder="Brief overview of what you'd like to discuss..."
                                class="w-full px-4 py-3 rounded-xl bg-[#0E0D0C] border border-[#2A2520] focus:border-[#C45A19] focus:ring-1 focus:ring-[#C45A19] text-[#F5F1EA] placeholder-[#70685F] text-sm font-sans transition outline-none"
                            >
                        </div>

                        <!-- 4. Message Content -->
                        <div class="space-y-2">
                            <label for="message" class="text-xs font-mono uppercase tracking-wider text-[#F5F1EA] block">
                                Message <span class="text-[#E47A2E]">*</span>
                            </label>
                            <textarea 
                                id="message" 
                                name="message" 
                                rows="5" 
                                required 
                                minlength="10"
                                placeholder="Share details about project scope, timelines, architectural requirements, or inquiries..."
                                class="w-full px-4 py-3 rounded-xl bg-[#0E0D0C] border border-[#2A2520] focus:border-[#C45A19] focus:ring-1 focus:ring-[#C45A19] text-[#F5F1EA] placeholder-[#70685F] text-sm font-sans transition outline-none resize-y"
                            >{{ old('message') }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <x-button type="submit" variant="primary" size="lg" class="w-full sm:w-auto">
                                <span>TRANSMIT MESSAGE</span>
                                <span>&rarr;</span>
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-layouts.app>
