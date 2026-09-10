@props([
    'certificate',
])

@php
    $modalId = 'cert-modal-' . $certificate->id;
    $mediaUrl = $certificate->getFirstMediaUrl('image', 'preview')
        ?: ($certificate->getFirstMediaUrl('image')
        ?: ($certificate->getFirstMediaUrl('certificate_file') ?: $certificate->image_url));
    $issuedDate = $certificate->issued_at ? $certificate->issued_at->format('F Y') : 'N/A';
@endphp

<div x-data class="relative">
    <div data-cursor="explore" class="p-6 rounded-2xl bg-[#151311] border border-[#2A2520] hover:border-[#C45A19]/50 transition-all duration-300 flex flex-col justify-between h-full group hover:shadow-xl hover:shadow-[#C45A19]/5">
        <div class="space-y-4">
            <!-- Header with Issuer Badge -->
            <div class="flex items-start justify-between gap-3">
                <span class="px-2.5 py-1 rounded-full text-xs font-mono uppercase tracking-wider bg-[#1E1A17] text-[#E47A2E] border border-[#2A2520]">
                    {{ $certificate->issuer }}
                </span>

                @if($certificate->featured)
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-mono uppercase tracking-wider bg-[#C45A19]/20 text-[#E47A2E] border border-[#C45A19]/30">
                        Top Credential
                    </span>
                @endif
            </div>

            <!-- Title & ID -->
            <div>
                <h4 class="text-lg font-heading font-bold text-[#F5F1EA] group-hover:text-[#E47A2E] transition-colors leading-snug">
                    {{ $certificate->title }}
                </h4>
                @if($certificate->credential_id)
                    <p class="text-xs font-mono text-[#70685F] mt-1 truncate">
                        ID: {{ $certificate->credential_id }}
                    </p>
                @endif
            </div>

            <p class="text-xs text-[#9E958B] leading-relaxed line-clamp-2">
                {{ $certificate->description }}
            </p>
        </div>

        <!-- Footer Meta & Actions -->
        <div class="mt-6 pt-4 border-t border-[#2A2520] flex items-center justify-between text-xs font-mono">
            <span class="text-[#70685F]">{{ $issuedDate }}</span>

            <div class="flex items-center gap-3">
                @if($certificate->credential_url)
                    <a 
                        href="{{ $certificate->credential_url }}" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="text-[#9E958B] hover:text-[#F5F1EA] transition-colors inline-flex items-center gap-0.5"
                        title="Verify credential online"
                    >
                        <span>Verify</span>
                        <span>&nearr;</span>
                    </a>
                @endif

                <button 
                    type="button" 
                    @click="$dispatch('open-modal', '{{ $modalId }}')"
                    class="inline-flex items-center gap-1 text-[#E47A2E] hover:text-[#F5F1EA] transition-colors font-medium"
                >
                    <span>See Details</span>
                    <span>&rarr;</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal for Certificate Details & Verification -->
    <x-modal :name="$modalId" :title="$certificate->title">
        <div class="space-y-6 text-left">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-xl bg-[#151311] border border-[#2A2520] text-xs font-mono">
                <div>
                    <span class="text-[#70685F] block">Issuing Body</span>
                    <span class="text-[#F5F1EA] font-semibold text-sm">{{ $certificate->issuer }}</span>
                </div>
                <div>
                    <span class="text-[#70685F] block">Issue Date</span>
                    <span class="text-[#F5F1EA] font-semibold text-sm">{{ $issuedDate }}</span>
                </div>
                @if($certificate->credential_id)
                    <div class="sm:col-span-2">
                        <span class="text-[#70685F] block">Credential License ID</span>
                        <span class="text-[#E47A2E] select-all">{{ $certificate->credential_id }}</span>
                    </div>
                @endif
            </div>

            @if($certificate->description)
                <div>
                    <h5 class="text-xs font-mono uppercase tracking-widest text-[#70685F] mb-1">Competency Summary</h5>
                    <p class="text-sm text-[#9E958B] leading-relaxed">
                        {{ $certificate->description }}
                    </p>
                </div>
            @endif

            @if($mediaUrl)
                <div class="rounded-xl overflow-hidden border border-[#2A2520] bg-[#0E0D0C]">
                    <img src="{{ $mediaUrl }}" alt="{{ $certificate->title }}" loading="lazy" decoding="async" width="800" height="560" class="w-full max-h-80 object-contain">
                </div>
            @endif

            <div class="pt-4 border-t border-[#2A2520] flex items-center justify-between">
                @if($certificate->credential_url)
                    <a 
                        href="{{ $certificate->credential_url }}" 
                        target="_blank" 
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-[#C45A19] hover:bg-[#E47A2E] text-white font-mono text-xs font-medium transition shadow-lg shadow-[#C45A19]/20"
                    >
                        <span>Verify Credential Online</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                @else
                    <span class="text-xs font-mono text-[#70685F]">Verified by internal records</span>
                @endif
            </div>
        </div>
    </x-modal>
</div>
