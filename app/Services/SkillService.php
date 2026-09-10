<?php

namespace App\Services;

use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class SkillService
{
    public function getSkillsByCategory(): Collection
    {
        $skills = Cache::rememberForever('portfolio.grouped_skills', function () {
            return SkillCategory::with([
                'skills' => function ($query) {
                    $query->with(['category', 'projects', 'experiences.organization', 'certificates', 'achievements'])
                        ->withCount(['projects', 'experiences', 'certificates'])
                        ->ordered();
                },
            ])->ordered()->get();
        });

        if ($skills instanceof \__PHP_Incomplete_Class) {
            Cache::forget('portfolio.grouped_skills');

            return SkillCategory::with([
                'skills' => function ($query) {
                    $query->with(['category', 'projects', 'experiences.organization', 'certificates', 'achievements'])
                        ->withCount(['projects', 'experiences', 'certificates'])
                        ->ordered();
                },
            ])->ordered()->get();
        }

        return $skills;
    }

    public function getFeaturedSkills(): Collection
    {
        $featured = Cache::rememberForever('portfolio.featured_skills', function () {
            return Skill::with(['category', 'projects', 'experiences.organization', 'certificates', 'achievements'])
                ->withCount(['projects', 'experiences', 'certificates'])
                ->featured()
                ->ordered()
                ->get();
        });

        if ($featured instanceof \__PHP_Incomplete_Class) {
            Cache::forget('portfolio.featured_skills');

            return Skill::with(['category', 'projects', 'experiences.organization', 'certificates', 'achievements'])
                ->withCount(['projects', 'experiences', 'certificates'])
                ->featured()
                ->ordered()
                ->get();
        }

        return $featured;
    }
}
