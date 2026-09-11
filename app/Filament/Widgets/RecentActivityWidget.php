<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Achievements\AchievementResource;
use App\Filament\Resources\Certificates\CertificateResource;
use App\Filament\Resources\ContactMessages\ContactMessageResource;
use App\Filament\Resources\Projects\ProjectResource;
use App\Filament\Resources\Skills\SkillResource;
use App\Models\Achievement;
use App\Models\Certificate;
use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\Skill;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;

class RecentActivityWidget extends Widget
{
    protected static ?int $sort = 5;

    protected string $view = 'filament.widgets.recent-activity-widget';

    protected int|string|array $columnSpan = [
        'sm' => 'full',
        'lg' => 1,
    ];

    public function getRecentActivities(): Collection
    {
        $activities = collect();

        // Recent Projects
        Project::latest('updated_at')->take(3)->get()->each(function ($item) use ($activities) {
            $activities->push([
                'type' => 'Project updated',
                'title' => $item->title,
                'timestamp' => $item->updated_at,
                'url' => ProjectResource::getUrl('edit', ['record' => $item]),
                'badge' => 'Project',
                'icon' => 'project',
            ]);
        });

        // Recent Certificates
        Certificate::latest('updated_at')->take(2)->get()->each(function ($item) use ($activities) {
            $activities->push([
                'type' => 'Certificate updated',
                'title' => $item->title,
                'timestamp' => $item->updated_at,
                'url' => CertificateResource::getUrl('edit', ['record' => $item]),
                'badge' => 'Credential',
                'icon' => 'certificate',
            ]);
        });

        // Recent Skills
        Skill::latest('updated_at')->take(2)->get()->each(function ($item) use ($activities) {
            $activities->push([
                'type' => 'Skill updated',
                'title' => $item->name,
                'timestamp' => $item->updated_at,
                'url' => SkillResource::getUrl('edit', ['record' => $item]),
                'badge' => 'Skill',
                'icon' => 'skill',
            ]);
        });

        // Recent Achievements
        Achievement::latest('updated_at')->take(2)->get()->each(function ($item) use ($activities) {
            $activities->push([
                'type' => 'Achievement updated',
                'title' => $item->title,
                'timestamp' => $item->updated_at,
                'url' => AchievementResource::getUrl('edit', ['record' => $item]),
                'badge' => 'Honor',
                'icon' => 'achievement',
            ]);
        });

        // Recent Contact Messages
        ContactMessage::latest('created_at')->take(2)->get()->each(function ($item) use ($activities) {
            $activities->push([
                'type' => 'Inquiry received',
                'title' => $item->name.' ('.$item->subject.')',
                'timestamp' => $item->created_at,
                'url' => ContactMessageResource::getUrl('edit', ['record' => $item]),
                'badge' => 'Message',
                'icon' => 'message',
            ]);
        });

        return $activities
            ->filter(fn ($item) => ! is_null($item['timestamp']))
            ->sortByDesc('timestamp')
            ->take(5)
            ->values();
    }
}
