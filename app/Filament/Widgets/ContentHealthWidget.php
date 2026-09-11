<?php

namespace App\Filament\Widgets;

use App\Models\Achievement;
use App\Models\Certificate;
use App\Models\Profile;
use App\Models\Project;
use App\Models\SeoMetadata;
use App\Models\Skill;
use App\Models\SocialLink;
use Filament\Widgets\Widget;

class ContentHealthWidget extends Widget
{
    protected static ?int $sort = 4;

    protected string $view = 'filament.widgets.content-health-widget';

    protected int|string|array $columnSpan = [
        'sm' => 'full',
        'lg' => 1,
    ];

    public function getHealthData(): array
    {
        $profile = Profile::first();
        $socialLinksCount = SocialLink::count();

        $checklist = [
            'name' => [
                'label' => 'Full Name',
                'complete' => filled($profile?->name),
            ],
            'headline' => [
                'label' => 'Professional Headline',
                'complete' => filled($profile?->headline),
            ],
            'bio' => [
                'label' => 'Short Bio & Description',
                'complete' => filled($profile?->short_bio),
            ],
            'email' => [
                'label' => 'Contact Email',
                'complete' => filled($profile?->email),
            ],
            'location' => [
                'label' => 'Location / Timezone',
                'complete' => filled($profile?->location),
            ],
            'avatar' => [
                'label' => 'Profile Photo / Avatar',
                'complete' => filled($profile?->avatar) || ($profile && $profile->hasMedia('avatar')),
            ],
            'resume' => [
                'label' => 'Resume / Curriculum Vitae',
                'complete' => filled($profile?->resume) || ($profile && $profile->hasMedia('resume')),
            ],
            'social' => [
                'label' => 'Connected Social Links',
                'complete' => $socialLinksCount > 0,
            ],
        ];

        $completedCount = collect($checklist)->where('complete', true)->count();
        $totalItems = count($checklist);
        $completionPercentage = (int) round(($completedCount / $totalItems) * 100);

        $seoCount = SeoMetadata::count();
        $seoStatus = $seoCount >= 1 ? 'Complete' : 'Needs attention';

        return [
            'completionPercentage' => $completionPercentage,
            'checklist' => $checklist,
            'missingItems' => collect($checklist)->where('complete', false)->pluck('label')->all(),
            'seoStatus' => $seoStatus,
            'profileStatus' => $completionPercentage >= 85 ? 'Complete' : 'In Progress',
            'counts' => [
                'projects' => Project::count(),
                'skills' => Skill::count(),
                'certificates' => Certificate::count(),
                'achievements' => Achievement::count(),
            ],
        ];
    }
}
