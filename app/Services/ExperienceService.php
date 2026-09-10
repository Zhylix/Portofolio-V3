<?php

namespace App\Services;

use App\Models\Experience;
use App\Models\ExperienceType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ExperienceService
{
    public function getActiveExperienceTypes(): Collection
    {
        $types = Cache::rememberForever('portfolio.experience_types', fn () => ExperienceType::active()->ordered()->get());

        if ($types instanceof \__PHP_Incomplete_Class) {
            Cache::forget('portfolio.experience_types');

            return ExperienceType::active()->ordered()->get();
        }

        return $types;
    }

    public function getTimeline(): Collection
    {
        return Experience::with(['experienceType', 'organization', 'skills'])
            ->whereHas('experienceType', fn ($query) => $query->where('is_active', true))
            ->published()
            ->visible()
            ->ordered()
            ->get();
    }

    public function getFeatured(): Collection
    {
        $featured = Cache::rememberForever('portfolio.featured_experiences', function () {
            return Experience::with(['experienceType', 'organization', 'skills'])
                ->whereHas('experienceType', fn ($query) => $query->where('is_active', true))
                ->published()
                ->visible()
                ->featured()
                ->ordered()
                ->get();
        });

        if ($featured instanceof \__PHP_Incomplete_Class) {
            Cache::forget('portfolio.featured_experiences');

            return Experience::with(['experienceType', 'organization', 'skills'])
                ->whereHas('experienceType', fn ($query) => $query->where('is_active', true))
                ->published()
                ->visible()
                ->featured()
                ->ordered()
                ->get();
        }

        return $featured;
    }

    public function findBySlug(string $slug): ?Experience
    {
        return Experience::with(['experienceType', 'organization', 'skills', 'projects', 'certificates', 'achievements', 'events'])
            ->where('slug', $slug)
            ->first();
    }
}
