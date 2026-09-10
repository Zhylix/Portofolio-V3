@props([
    'name',
    'title' => null,
    'maxWidth' => '2xl',
])

@php
    $maxWidthClass = match($maxWidth) {
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '3xl' => 'sm:max-w-3xl',
        default => 'sm:max-w-2xl',
    };
@endphp

<div
    x-data="{ show: false }"
    x-init="$watch('show', value => { document.body.style.overflow = value ? 'hidden' : '' })"
    x-show="show"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:keydown.escape.window="show = false"
    style="display: none;"
    class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center"
    role="dialog"
    aria-modal="true"
>
    <!-- Backdrop -->
    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="show = false"
        class="fixed inset-0 bg-black/80 backdrop-blur-md"
        aria-hidden="true"
    ></div>

    <!-- Modal Dialog Window -->
    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="relative bg-[#0E0D0C] border border-[#2A2520] rounded-2xl overflow-hidden shadow-2xl transform transition-all w-full {{ $maxWidthClass }} p-6 sm:p-8 z-10"
    >
        <div class="flex items-center justify-between pb-4 border-b border-[#2A2520] mb-6">
            @if($title)
                <h3 class="text-xl font-heading font-bold text-[#F5F1EA]">
                    {{ $title }}
                </h3>
            @else
                <div></div>
            @endif

            <button
                @click="show = false"
                type="button"
                class="p-2 rounded-full text-[#9E958B] hover:text-[#F5F1EA] hover:bg-[#151311] border border-transparent hover:border-[#2A2520] transition"
                aria-label="Close modal"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div>
            {{ $slot }}
        </div>
    </div>
</div>
