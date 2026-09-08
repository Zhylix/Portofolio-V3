<x-layouts.app title="Certificates & Credentials — Helmy Yunan Nasution">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
        <header class="max-w-3xl space-y-3">
            <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Certifications & Licenses</h1>
            <p class="text-zinc-400 text-base leading-relaxed">
                Verified professional certifications demonstrating domain mastery in cloud architecture, engineering practices, and framework ecosystems.
            </p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($certificates as $cert)
                <div class="p-6 rounded-2xl bg-zinc-900/40 border border-zinc-800/80 hover:border-zinc-700 transition flex flex-col justify-between space-y-4">
                    <div>
                        <div class="flex items-center justify-between text-xs text-zinc-500 mb-2">
                            <span class="text-indigo-400 font-semibold">{{ $cert->issuer }}</span>
                            @if($cert->issued_at)
                                <span class="font-mono">Issued {{ $cert->issued_at->format('M Y') }}</span>
                            @endif
                        </div>

                        <h2 class="text-xl font-bold text-white">{{ $cert->title }}</h2>

                        @if($cert->credential_id)
                            <div class="text-xs font-mono text-zinc-500 mt-1">ID: {{ $cert->credential_id }}</div>
                        @endif

                        @if($cert->description)
                            <p class="text-sm text-zinc-400 mt-3 leading-relaxed">{{ $cert->description }}</p>
                        @endif
                    </div>

                    <div class="pt-4 border-t border-zinc-800/60 flex items-center justify-between text-xs">
                        @if($cert->skills->isNotEmpty())
                            <div class="flex flex-wrap gap-1">
                                @foreach($cert->skills->take(3) as $skill)
                                    <span class="px-2 py-0.5 rounded bg-zinc-800 text-zinc-400 font-mono text-[10px]">{{ $skill->name }}</span>
                                @endforeach
                            </div>
                        @else
                            <span></span>
                        @endif

                        @if($cert->credential_url)
                            <a href="{{ $cert->credential_url }}" target="_blank" rel="noopener noreferrer" class="text-indigo-400 hover:text-indigo-300 font-semibold">
                                Verify Credential &rarr;
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-sm text-zinc-500 col-span-full">No certificates found.</p>
            @endforelse
        </div>
    </div>
</x-layouts.app>
