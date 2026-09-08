<?php

namespace App\Enums;

enum ContactMessageStatus: string
{
    case UNREAD = 'unread';
    case READ = 'read';
    case REPLIED = 'replied';
    case ARCHIVED = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::UNREAD => 'Unread',
            self::READ => 'Read',
            self::REPLIED => 'Replied',
            self::ARCHIVED => 'Archived',
        };
    }
}
