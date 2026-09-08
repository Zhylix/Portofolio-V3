@props([
    'hover' => true,
    'padding' => 'p-6',
])

@php
    $baseStyles = 'bg-[#151311]/90 backdrop-blur-md border border-[#2A2520] rounded-2xl relative overflow-hidden';
    $hoverStyles = $hover ? 'hover:border-[#C45A19]/50 hover:shadow-xl hover:shadow-[#C45A19]/5 transition-all duration-300' : '';
    $classes = "{$baseStyles} {$hoverStyles} {$padding}";
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
