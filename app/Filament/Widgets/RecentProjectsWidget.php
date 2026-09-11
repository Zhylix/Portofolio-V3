<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\Widget;

class RecentProjectsWidget extends Widget
{
    protected static ?int $sort = 3;

    protected string $view = 'filament.widgets.recent-projects-widget';

    protected int|string|array $columnSpan = [
        'sm' => 'full',
        'lg' => 1,
    ];

    public function getProjects()
    {
        return Project::query()
            ->with(['category', 'technologies'])
            ->latest('updated_at')
            ->take(4)
            ->get();
    }
}
