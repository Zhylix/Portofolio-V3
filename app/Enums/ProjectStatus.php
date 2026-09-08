<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProjectStatus: string implements HasColor, HasLabel
{
    case PLANNING = 'planning';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case MAINTAINED = 'maintained';
    case ARCHIVED = 'archived';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PLANNING => 'Planning',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETED => 'Completed',
            self::MAINTAINED => 'Active Maintenance',
            self::ARCHIVED => 'Archived',
        };
    }

    public function label(): string
    {
        return $this->getLabel() ?? '';
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::COMPLETED => 'success',
            self::IN_PROGRESS => 'info',
            self::MAINTAINED => 'primary',
            self::PLANNING => 'warning',
            self::ARCHIVED => 'danger',
        };
    }
}
