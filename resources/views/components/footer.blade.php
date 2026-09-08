@php
    $profile = \App\Models\Profile::first();
    $name = $profile ? $profile->full_name : 'Helmy Yunan Nasution';
    $tagline = $profile ? ($profile->headline ?? 'Software Engineer & System Architect') : 'Software Engineer & System Architect';
    $socialLinks = \App\Models\SocialLink::ordered()->get();
@endphp

<footer class="mt-auto border-t border-[#2A2520] bg-[#0E0D0C]/90 backdrop-blur-md relative z-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-12">
            <!-- Col 1: Bio / Tagline -->
            <div class="md:col-span-2 space-y-4">
                <div class="flex items-center gap-2">
                    <span class="w-7 h-7 rounded-full bg-[#151311] border border-[#2A2520] flex items-center justify-center text-xs font-mono font-bold text-[#E47A2E]">
                        HY
                    </span>
                    <span class="font-heading font-bold text-lg tracking-wide uppercase text-[#F5F1EA]">
                        {{ $name }}
                    </span>
                </div>
                <p class="text-sm text-[#9E958B] max-w-md leading-relaxed font-sans">
                    {{ $tagline }}. Engineering resilient digital architectures, enterprise systems, and high-performance applications through clean code and modern standards.
                </p>
                <div class="flex items-center gap-3 pt-2">
                    @forelse($socialLinks as $link)
                        <a 
                            href="{{ $link->url }}" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="p-2.5 rounded-full bg-[#151311] border border-[#2A2520] hover:border-[#C45A19] text-[#9E958B] hover:text-[#E47A2E] transition-colors"
                            aria-label="{{ $link->platform }}"
                            title="{{ $link->platform }}"
                        >
                            @if(stripos($link->platform, 'git') !== false)
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                            @elseif(stripos($link->platform, 'link') !== false)
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            @elseif(stripos($link->platform, 'mail') !== false)
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M0 3v18h24v-18h-24zm6.623 7.929l-4.623 5.712v-9.458l4.623 3.746zm-4.141-5.929h19.035l-9.517 7.713-9.518-7.713zm5.694 7.188l3.824 3.099 3.83-3.104 5.612 6.817h-18.779l5.513-6.812zm9.208-.423l4.616-3.736v9.447l-4.616-5.711z"/></svg>
                            @else
                                <span class="font-mono text-xs font-bold">{{ substr($link->platform, 0, 2) }}</span>
                            @endif
                        </a>
                    @empty
                        <span class="text-xs text-[#70685F] font-mono">Available across GitHub & LinkedIn</span>
                    @endforelse
                </div>
            </div>

            <!-- Col 2: Navigation -->
            <div class="space-y-3">
                <h4 class="text-xs font-mono uppercase tracking-widest text-[#F5F1EA]">Navigation</h4>
                <ul class="space-y-2 text-sm text-[#9E958B]">
                    <li><a href="{{ route('home') }}" class="hover:text-[#E47A2E] transition-colors">Home</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-[#E47A2E] transition-colors">About</a></li>
                    <li><a href="{{ route('projects.index') }}" class="hover:text-[#E47A2E] transition-colors">Projects & Systems</a></li>
                    <li><a href="{{ route('journey.index') }}" class="hover:text-[#E47A2E] transition-colors">Professional Journey</a></li>
                    <li><a href="{{ route('skills.index') }}" class="hover:text-[#E47A2E] transition-colors">Skills & Capabilities</a></li>
                </ul>
            </div>

            <!-- Col 3: Directives / Credentials -->
            <div class="space-y-3">
                <h4 class="text-xs font-mono uppercase tracking-widest text-[#F5F1EA]">Verification</h4>
                <ul class="space-y-2 text-sm text-[#9E958B]">
                    <li><a href="{{ route('certificates.index') }}" class="hover:text-[#E47A2E] transition-colors">Certifications</a></li>
                    <li><a href="{{ route('achievements.index') }}" class="hover:text-[#E47A2E] transition-colors">Achievements</a></li>
                    <li><a href="{{ route('articles.index') }}" class="hover:text-[#E47A2E] transition-colors">Technical Articles</a></li>
                    <li><a href="{{ route('contact.index') }}" class="hover:text-[#E47A2E] transition-colors">Contact</a></li>
                    <li><a href="/admin" class="hover:text-[#E47A2E] transition-colors text-xs font-mono text-[#70685F]">Admin Portal</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-[#2A2520] flex flex-col sm:flex-row items-center justify-between text-xs text-[#70685F] font-mono gap-4">
            <p>&copy; {{ date('Y') }} {{ $name }}. All rights reserved.</p>
            <p>Crafted with Laravel 13, Filament 5, & Tailwind CSS 4.</p>
        </div>
    </div>
</footer>
