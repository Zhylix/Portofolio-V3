<x-layouts.app title="Certifications & Verified Credentials">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Header -->
        <x-section-heading 
            label="// INDUSTRY CREDENTIALS"
            title="Certifications & Licensing"
            description="Verified professional certifications demonstrating domain mastery in cloud architecture, framework engineering, and database systems."
        />

        <!-- Certificate Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($certificates as $certificate)
                <x-certificate-card :certificate="$certificate" />
            @empty
                <div class="col-span-3 text-center py-16 border border-dashed border-[#2A2520] rounded-3xl p-8">
                    <p class="text-[#70685F] font-mono">No certificates loaded in database.</p>
                </div>
            @endforelse
        </div>

    </div>
</x-layouts.app>
