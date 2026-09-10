@props([
    'article' => null,
    'breadcrumbs' => null,
])

@php
    $profileService = app(\App\Services\ProfileService::class);
    $profile = $profileService->getProfile();
    $socialLinks = $profileService->getSocialLinks();

    $personSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Person',
        'name' => $profile->full_name ?? 'Helmy Yunan Nasution',
        'jobTitle' => $profile->headline ?? 'Lead Software Engineer & System Architect',
        'url' => route('home'),
        'sameAs' => $socialLinks->pluck('url')->values()->toArray(),
    ];

    if ($profile && $profile->getFirstMediaUrl('avatar')) {
        $personSchema['image'] = $profile->getFirstMediaUrl('avatar');
    }

    $websiteSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => 'Helmy Yunan Nasution — System Architecture & Portfolio',
        'url' => url('/'),
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => [
                '@type' => 'EntryPoint',
                'urlTemplate' => url('/search') . '?q={search_term_string}',
            ],
            'query-input' => 'required name=search_term_string',
        ],
    ];

    $articleSchema = null;
    if ($article) {
        $articleSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $article->title,
            'description' => $article->excerpt ?? '',
            'url' => \Illuminate\Support\Facades\Route::has('articles.show') ? route('articles.show', $article->slug) : url('/'),
            'datePublished' => $article->published_at ? $article->published_at->toIso8601String() : $article->created_at?->toIso8601String(),
            'dateModified' => $article->updated_at ? $article->updated_at->toIso8601String() : null,
            'author' => [
                '@type' => 'Person',
                'name' => $profile->full_name ?? 'Helmy Yunan Nasution',
            ],
        ];

        if ($article->getFirstMediaUrl('thumbnail')) {
            $articleSchema['image'] = $article->getFirstMediaUrl('thumbnail');
        }
    }

    $breadcrumbSchema = null;
    if (!empty($breadcrumbs) && is_array($breadcrumbs)) {
        $breadcrumbSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => collect($breadcrumbs)->values()->map(function ($item, $index) {
                return [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => $item['name'] ?? '',
                    'item' => $item['url'] ?? '',
                ];
            })->toArray(),
        ];
    }
@endphp

<script type="application/ld+json">
{!! json_encode($personSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>

<script type="application/ld+json">
{!! json_encode($websiteSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>

@if($articleSchema)
<script type="application/ld+json">
{!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

@if($breadcrumbSchema)
<script type="application/ld+json">
{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif
