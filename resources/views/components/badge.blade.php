@props([
    'variant' => 'neutral',
    'size' => 'sm',
    'dot' => false,
])

@php
    $baseStyles = 'inline-flex items-center font-mono font-medium rounded-full uppercase tracking-wider transition-colors';

    $sizeStyles = match($size) {
        'md' => 'text-xs px-3 py-1 gap-1.5',
        default => 'text-[10px] sm:text-xs px-2.5 py-0.5 gap-1',
    };

    $variantStyles = match($variant) {
        'accent' => 'bg-[#C45A19]/15 text-[#E47A2E] border border-[#C45A19]/30',
        'surface' => 'bg-[#151311] text-[#F5F1EA] border border-[#2A2520]',
        'success' => 'bg-emerald-950/40 text-emerald-400 border border-emerald-800/40',
        'warning' => 'bg-amber-950/40 text-amber-400 border border-amber-800/40',
        default => 'bg-[#1E1A17] text-[#9E958B] border border-[#2A2520]',
    };

    $dotColors = match($variant) {
        'accent' => 'bg-[#E47A2E]',
        'success' => 'bg-emerald-400',
        'warning' => 'bg-amber-400',
        default => 'bg-[#9E958B]',
    };

    $classes = "{$baseStyles} {$sizeStyles} {$variantStyles}";
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    @if($dot)
        <span class="w-1.5 h-1.5 rounded-full {{ $dotColors }}"></span>
    @endif
    {{ $slot }}
</span>
