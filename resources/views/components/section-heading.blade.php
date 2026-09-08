@props([
    'label' => null,
    'title',
    'description' => null,
    'align' => 'left',
])

@php
    $alignmentClasses = match($align) {
        'center' => 'text-center items-center mx-auto',
        default => 'text-left items-start',
    };
@endphp

<div class="flex flex-col {{ $alignmentClasses }} max-w-3xl mb-12 sm:mb-16">
    @if($label)
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#151311] border border-[#2A2520] text-[#E47A2E] text-xs font-mono tracking-widest uppercase mb-4">
            <span class="w-1.5 h-1.5 rounded-full bg-[#C45A19]"></span>
            <span>{{ $label }}</span>
        </div>
    @endif

    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-bold text-[#F5F1EA] tracking-tight leading-tight">
        {{ $title }}
    </h2>

    @if($description)
        <p class="mt-4 text-base sm:text-lg text-[#9E958B] leading-relaxed font-sans">
            {{ $description }}
        </p>
    @endif
</div>
