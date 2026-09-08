<?php

namespace App\Enums;

enum ContactMessageType: string
{
    case WEBSITE = 'website';
    case COLLABORATION = 'collaboration';
    case FREELANCE = 'freelance';
    case PROJECT = 'project';
    case JUST_SAY_HI = 'just_say_hi';
    case GENERAL = 'general';
    case INQUIRY = 'inquiry';
    case HIRING = 'hiring';

    public function label(): string
    {
        return match ($this) {
            self::WEBSITE => 'Website Project',
            self::COLLABORATION => 'Collaboration',
            self::FREELANCE => 'Freelance Contract',
            self::PROJECT => 'System Engineering',
            self::JUST_SAY_HI => 'Just Say Hi',
            self::GENERAL => 'General Question',
            self::INQUIRY => 'Project Inquiry',
            self::HIRING => 'Job / Contract Offer',
        };
    }
}
