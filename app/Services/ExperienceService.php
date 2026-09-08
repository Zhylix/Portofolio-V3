<?php

namespace App\Services;

use App\Models\Experience;
use App\Models\ExperienceType;
use Illuminate\Database\Eloquent\Collection;

class ExperienceService
{
    public function getActiveExperienceTypes(): Collection
    {
        return ExperienceType::active()->ordered()->get();
    }

    public function getTimeline(): Collection
    {
        return Experience::with(['experienceType', 'organization', 'skills', 'projects', 'certificates', 'achievements', 'events'])
            ->whereHas('experienceType', fn ($query) => $query->where('is_active', true))
            ->published()
            ->visible()
            ->ordered()
            ->get();
    }

    public function getFeatured(): Collection
    {
        return Experience::with(['experienceType', 'organization', 'skills'])
            ->whereHas('experienceType', fn ($query) => $query->where('is_active', true))
            ->published()
            ->visible()
            ->featured()
            ->ordered()
            ->get();
    }

    public function findBySlug(string $slug): ?Experience
    {
        return Experience::with(['experienceType', 'organization', 'skills', 'projects', 'certificates', 'achievements', 'events'])
            ->where('slug', $slug)
            ->first();
    }
}
