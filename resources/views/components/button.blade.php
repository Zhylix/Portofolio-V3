@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'type' => 'button',
])

@php
    $baseStyles = 'inline-flex items-center justify-center font-mono font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#C45A19] focus:ring-offset-2 focus:ring-offset-[#080808] disabled:opacity-50 disabled:cursor-not-allowed group';

    $sizeStyles = match($size) {
        'sm' => 'text-xs px-3 py-1.5 rounded-full gap-1.5',
        'lg' => 'text-sm sm:text-base px-6 py-3.5 rounded-full gap-2.5',
        default => 'text-xs sm:text-sm px-5 py-2.5 rounded-full gap-2',
    };

    $variantStyles = match($variant) {
        'secondary' => 'bg-[#151311] hover:bg-[#1E1A17] text-[#F5F1EA] border border-[#2A2520] hover:border-[#C45A19] shadow-sm',
        'ghost' => 'bg-transparent hover:bg-[#151311] text-[#9E958B] hover:text-[#F5F1EA]',
        default => 'bg-gradient-to-r from-[#C45A19] to-[#E47A2E] hover:from-[#E47A2E] hover:to-[#C45A19] text-[#F5F1EA] shadow-lg shadow-[#C45A19]/25 hover:shadow-[#C45A19]/40 border border-[#E47A2E]/30',
    };

    $classes = "{$baseStyles} {$sizeStyles} {$variantStyles}";
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
