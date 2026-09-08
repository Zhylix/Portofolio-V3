<x-layouts.app title="About — Helmy Yunan Nasution">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-16">
        <header class="space-y-4">
            <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">About Helmy Yunan Nasution</h1>
            <p class="text-lg text-zinc-400 leading-relaxed">
                {{ $profile?->headline }}
            </p>
        </header>

        <section class="space-y-6 border-t border-zinc-900 pt-8">
            <h2 class="text-xl font-bold text-white">Professional Biography</h2>
            <div class="prose prose-invert max-w-none text-zinc-300 leading-relaxed space-y-4 text-base">
                {!! nl2br(e($profile?->long_bio ?? $profile?->short_bio)) !!}
            </div>
        </section>

        <!-- Education History -->
        <section class="space-y-6 border-t border-zinc-900 pt-8">
            <h2 class="text-xl font-bold text-white">Formal Education</h2>
            <div class="space-y-4">
                @forelse($educations as $edu)
                    <div class="p-5 rounded-xl bg-zinc-900/40 border border-zinc-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h3 class="font-bold text-white text-lg">{{ $edu->institution }}</h3>
                            <p class="text-sm text-indigo-400 font-medium">{{ $edu->degree }} - {{ $edu->major }}</p>
                            @if($edu->description)
                                <p class="text-xs text-zinc-400 mt-2">{{ $edu->description }}</p>
                            @endif
                        </div>
                        <div class="text-xs font-mono text-zinc-500 sm:text-right shrink-0">
                            {{ $edu->started_at?->format('Y') }} - {{ $edu->is_current ? 'Present' : ($edu->ended_at?->format('Y') ?? 'Present') }}
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-zinc-500">Education details will be populated soon.</p>
                @endforelse
            </div>
        </section>
    </div>
</x-layouts.app>
