<?php

namespace App\Services;

use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Database\Eloquent\Collection;

class SkillService
{
    public function getSkillsByCategory(): Collection
    {
        return SkillCategory::with([
            'skills' => function ($query) {
                $query->with(['category', 'projects', 'experiences.organization', 'certificates', 'achievements'])
                    ->withCount(['projects', 'experiences', 'certificates'])
                    ->ordered();
            },
        ])->ordered()->get();
    }

    public function getFeaturedSkills(): Collection
    {
        return Skill::with(['category', 'projects', 'experiences.organization', 'certificates', 'achievements'])
            ->withCount(['projects', 'experiences', 'certificates'])
            ->featured()
            ->ordered()
            ->get();
    }
}
