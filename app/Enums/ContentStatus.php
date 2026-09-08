<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ContentStatus: string implements HasColor, HasLabel
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::PUBLISHED => 'Published',
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
            self::PUBLISHED => 'success',
            self::DRAFT => 'warning',
            self::ARCHIVED => 'danger',
        };
    }
}
