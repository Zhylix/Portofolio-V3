<?php

namespace App\Filament\Widgets;

use App\Models\Achievement;
use App\Models\Article;
use App\Models\Certificate;
use App\Models\ContactMessage;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PortfolioStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $unreadMessages = ContactMessage::unread()->count();

        return [
            Stat::make('Total Projects', (string) Project::count())
                ->description(Project::featured()->count().' featured case studies')
                ->descriptionIcon('heroicon-m-computer-desktop')
                ->color('indigo'),

            Stat::make('Experiences', (string) Experience::count())
                ->description(Experience::published()->count().' public timeline milestones')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('success'),

            Stat::make('Skills Matrix', (string) Skill::count())
                ->description('Validated with evidence counts')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('primary'),

            Stat::make('Certificates', (string) Certificate::count())
                ->description('Verified cloud & backend credentials')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('info'),

            Stat::make('Achievements', (string) Achievement::count())
                ->description('National hackathons & honors')
                ->descriptionIcon('heroicon-m-trophy')
                ->color('warning'),

            Stat::make('Articles', (string) Article::published()->count())
                ->description('Published technical writings')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('gray'),

            Stat::make('Unread Inquiries', (string) $unreadMessages)
                ->description($unreadMessages > 0 ? 'Action required on incoming messages' : 'Inbox is all caught up')
                ->descriptionIcon('heroicon-m-envelope')
                ->color($unreadMessages > 0 ? 'danger' : 'success'),
        ];
    }
}
