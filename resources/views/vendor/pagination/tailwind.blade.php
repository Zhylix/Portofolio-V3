@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between font-mono text-xs">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-[#70685F] bg-[#0E0D0C] border border-[#2A2520] cursor-not-allowed rounded-xl">
                    &larr; Prev
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 text-[#9E958B] hover:text-[#F5F1EA] bg-[#151311] hover:bg-[#1E1A17] border border-[#2A2520] hover:border-[#C45A19] rounded-xl transition">
                    &larr; Prev
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 text-[#9E958B] hover:text-[#F5F1EA] bg-[#151311] hover:bg-[#1E1A17] border border-[#2A2520] hover:border-[#C45A19] rounded-xl transition">
                    Next &rarr;
                </a>
            @else
                <span class="px-4 py-2 text-[#70685F] bg-[#0E0D0C] border border-[#2A2520] cursor-not-allowed rounded-xl">
                    Next &rarr;
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-xs text-[#70685F]">
                    Showing
                    @if ($paginator->firstItem())
                        <span class="font-semibold text-[#F5F1EA]">{{ $paginator->firstItem() }}</span>
                        to
                        <span class="font-semibold text-[#F5F1EA]">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    of
                    <span class="font-semibold text-[#F5F1EA]">{{ $paginator->total() }}</span>
                    entries
                </p>
            </div>

            <div>
                <span class="inline-flex gap-1.5 rounded-xl">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="inline-flex items-center px-3 py-2 text-[#70685F] bg-[#0E0D0C] border border-[#2A2520] cursor-not-allowed rounded-xl" aria-hidden="true">
                                &larr;
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center px-3 py-2 text-[#9E958B] hover:text-[#F5F1EA] bg-[#151311] hover:bg-[#1E1A17] border border-[#2A2520] hover:border-[#C45A19] rounded-xl transition" aria-label="{{ __('pagination.previous') }}">
                            &larr;
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="inline-flex items-center px-3 py-2 text-[#70685F] bg-[#0E0D0C] border border-[#2A2520] rounded-xl">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="inline-flex items-center px-3.5 py-2 font-semibold text-[#F5F1EA] bg-[#C45A19] border border-[#E47A2E] rounded-xl shadow-md shadow-[#C45A19]/20">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="inline-flex items-center px-3.5 py-2 text-[#9E958B] hover:text-[#F5F1EA] bg-[#151311] hover:bg-[#1E1A17] border border-[#2A2520] hover:border-[#C45A19] rounded-xl transition" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center px-3 py-2 text-[#9E958B] hover:text-[#F5F1EA] bg-[#151311] hover:bg-[#1E1A17] border border-[#2A2520] hover:border-[#C45A19] rounded-xl transition" aria-label="{{ __('pagination.next') }}">
                            &rarr;
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="inline-flex items-center px-3 py-2 text-[#70685F] bg-[#0E0D0C] border border-[#2A2520] cursor-not-allowed rounded-xl" aria-hidden="true">
                                &rarr;
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
