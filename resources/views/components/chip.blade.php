@props([
    'active' => false,
    'href' => null,
    'count' => null,
])

@php
    $baseStyles = 'inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-mono uppercase tracking-wider transition-all duration-200 cursor-pointer';
    
    $stateStyles = $active 
        ? 'bg-[#C45A19] text-[#F5F1EA] font-semibold border border-[#E47A2E] shadow-md shadow-[#C45A19]/20'
        : 'bg-[#151311] text-[#9E958B] hover:text-[#F5F1EA] hover:bg-[#1E1A17] border border-[#2A2520] hover:border-[#3D352E]';

    $classes = "{$baseStyles} {$stateStyles}";
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        <span>{{ $slot }}</span>
        @if(!is_null($count))
            <span class="text-[10px] px-1.5 py-0.2 rounded-full {{ $active ? 'bg-black/30 text-white' : 'bg-[#1E1A17] text-[#9E958B]' }}">
                {{ $count }}
            </span>
        @endif
    </a>
@else
    <button type="button" {{ $attributes->merge(['class' => $classes]) }}>
        <span>{{ $slot }}</span>
        @if(!is_null($count))
            <span class="text-[10px] px-1.5 py-0.2 rounded-full {{ $active ? 'bg-black/30 text-white' : 'bg-[#1E1A17] text-[#9E958B]' }}">
                {{ $count }}
            </span>
        @endif
    </button>
@endif
