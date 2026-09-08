<?php

namespace App\Enums;

enum ContactMessageType: string
{
    case GENERAL = 'general';
    case INQUIRY = 'inquiry';
    case COLLABORATION = 'collaboration';
    case HIRING = 'hiring';

    public function label(): string
    {
        return match ($this) {
            self::GENERAL => 'General Question',
            self::INQUIRY => 'Project Inquiry',
            self::COLLABORATION => 'Collaboration Opportunity',
            self::HIRING => 'Job / Contract Offer',
        };
    }
}
