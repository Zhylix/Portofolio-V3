<x-layouts.app title="Contact & Inquiries — Helmy Yunan Nasution">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
        <header class="space-y-3">
            <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Initiate Collaboration</h1>
            <p class="text-zinc-400 text-base leading-relaxed">
                Whether you have an enterprise engineering challenge, consulting inquiry, or technical speaking opportunity, reach out directly.
            </p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Sidebar / Details -->
            <div class="space-y-6">
                <div class="p-6 rounded-2xl bg-zinc-900/40 border border-zinc-800 space-y-4">
                    <h2 class="font-bold text-white text-base">Direct Channels</h2>
                    @if($profile?->email)
                        <div>
                            <div class="text-xs text-zinc-500">Email</div>
                            <a href="mailto:{{ $profile->email }}" class="text-sm text-indigo-400 hover:underline break-all font-mono">{{ $profile->email }}</a>
                        </div>
                    @endif
                    @if($profile?->location)
                        <div>
                            <div class="text-xs text-zinc-500">Location</div>
                            <div class="text-sm text-zinc-300">{{ $profile->location }}</div>
                        </div>
                    @endif
                </div>

                @if($socialLinks->isNotEmpty())
                    <div class="p-6 rounded-2xl bg-zinc-900/40 border border-zinc-800 space-y-3">
                        <h2 class="font-bold text-white text-base">Professional Profiles</h2>
                        <div class="space-y-2">
                            @foreach($socialLinks as $link)
                                <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between text-xs text-zinc-400 hover:text-white transition">
                                    <span>{{ ucfirst($link->platform) }}</span>
                                    <span class="font-mono text-zinc-600">&rarr;</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Contact Form -->
            <div class="md:col-span-2 p-8 rounded-2xl bg-zinc-900/40 border border-zinc-800">
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Name *</label>
                        <input type="text" name="name" id="name" required value="{{ old('name') }}" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        @error('name') <span class="text-xs text-red-400 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Email Address *</label>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        @error('email') <span class="text-xs text-red-400 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Nature of Inquiry</label>
                        <select name="type" id="type" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                            <option value="inquiry" @selected(old('type') == 'inquiry')>Project Inquiry / Consulting</option>
                            <option value="hiring" @selected(old('type') == 'hiring')>Job Offer / Contract</option>
                            <option value="collaboration" @selected(old('type') == 'collaboration')>Open Source / Collaboration</option>
                            <option value="general" @selected(old('type') == 'general')>General Discussion</option>
                        </select>
                        @error('type') <span class="text-xs text-red-400 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="subject" class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Subject</label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        @error('subject') <span class="text-xs text-red-400 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Message *</label>
                        <textarea name="message" id="message" rows="5" required class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">{{ old('message') }}</textarea>
                        @error('message') <span class="text-xs text-red-400 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full py-3 px-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-medium text-sm transition shadow-lg shadow-indigo-600/25">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
