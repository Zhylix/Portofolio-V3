<?php

namespace App\Filament\Widgets;

use App\Models\Achievement;
use App\Models\Certificate;
use App\Models\ContactMessage;
use App\Models\Organization;
use App\Models\Project;
use App\Models\Skill;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PortfolioStatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $unreadMessages = ContactMessage::unread()->count();

        return [
            Stat::make('PROJECTS', (string) Project::count())
                ->description('Active projects yang sedang ditampilkan.')
                ->descriptionIcon('heroicon-m-rectangle-stack')
                ->color('primary'),

            Stat::make('SKILLS', (string) Skill::count())
                ->description('Technical stack & skills terdaftar.')
                ->descriptionIcon('heroicon-m-code-bracket')
                ->color('primary'),

            Stat::make('CERTIFICATES', (string) Certificate::count())
                ->description('Certificates yang sudah tersimpan.')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('primary'),

            Stat::make('ACHIEVEMENTS', (string) Achievement::count())
                ->description('Honors & kompetisi yang diraih.')
                ->descriptionIcon('heroicon-m-trophy')
                ->color('primary'),

            Stat::make('MESSAGES', (string) ContactMessage::count())
                ->description($unreadMessages > 0 ? $unreadMessages.' inquiries baru belum dibaca' : 'Inbox kamu sudah rapi & clear')
                ->descriptionIcon('heroicon-m-envelope')
                ->color($unreadMessages > 0 ? 'danger' : 'primary'),

            Stat::make('ORGANIZATIONS', (string) Organization::count())
                ->description('Affiliations & riwayat institusi.')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('primary'),
        ];
    }
}
