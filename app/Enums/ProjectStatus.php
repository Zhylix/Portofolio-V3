<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case PLANNING = 'planning';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case MAINTAINED = 'maintained';
    case ARCHIVED = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::PLANNING => 'Planning',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETED => 'Completed',
            self::MAINTAINED => 'Active Maintenance',
            self::ARCHIVED => 'Archived',
        };
    }
}
