<?php

namespace App\Enums;

enum ExperienceTypeEnum: string
{
    case WORK = 'work';
    case INTERNSHIP = 'internship';
    case FREELANCE = 'freelance';
    case CLIENT_PROJECT = 'client_project';
    case PERSONAL_PROJECT = 'personal_project';
    case SCHOOL_PROJECT = 'school_project';
    case ORGANIZATION = 'organization';
    case LEADERSHIP = 'leadership';
    case VOLUNTEER = 'volunteer';
    case COMPETITION = 'competition';
    case HACKATHON = 'hackathon';
    case TRAINING = 'training';
    case CERTIFICATION = 'certification';
    case RESEARCH = 'research';
    case OPEN_SOURCE = 'open_source';
    case EVENT = 'event';
    case SPEAKING = 'speaking';
    case MENTORING = 'mentoring';
    case COMMUNITY = 'community';
    case OTHER = 'other';

    public function label(): string
    {
        return match ($this) {
            self::WORK => 'Work Experience',
            self::INTERNSHIP => 'Internship',
            self::FREELANCE => 'Freelance & Contract',
            self::CLIENT_PROJECT => 'Client Project',
            self::PERSONAL_PROJECT => 'Personal Project',
            self::SCHOOL_PROJECT => 'Academic & School Project',
            self::ORGANIZATION => 'Organization',
            self::LEADERSHIP => 'Leadership & Governance',
            self::VOLUNTEER => 'Volunteer Service',
            self::COMPETITION => 'Competition',
            self::HACKATHON => 'Hackathon',
            self::TRAINING => 'Training & Bootcamp',
            self::CERTIFICATION => 'Certification',
            self::RESEARCH => 'Research & Publications',
            self::OPEN_SOURCE => 'Open Source Contribution',
            self::EVENT => 'Event & Conference',
            self::SPEAKING => 'Public Speaking & Workshop',
            self::MENTORING => 'Mentoring & Teaching',
            self::COMMUNITY => 'Community Building',
            self::OTHER => 'Other Experience',
        };
    }
}
