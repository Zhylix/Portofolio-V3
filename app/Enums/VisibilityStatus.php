<?php

namespace App\Enums;

enum VisibilityStatus: string
{
    case PUBLIC = 'public';
    case UNLISTED = 'unlisted';
    case PRIVATE = 'private';

    public function label(): string
    {
        return match ($this) {
            self::PUBLIC => 'Public',
            self::UNLISTED => 'Unlisted',
            self::PRIVATE => 'Private',
        };
    }
}
