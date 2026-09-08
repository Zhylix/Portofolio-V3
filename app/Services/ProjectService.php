<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    public function getFeaturedProjects(): Collection
    {
        return Project::with(['category', 'technologies', 'skills'])
            ->featured()
            ->ordered()
            ->get();
    }

    public function getAllProjects(?string $categorySlug = null): Collection
    {
        $query = Project::with(['category', 'technologies', 'skills', 'experiences'])
            ->ordered();

        if ($categorySlug) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $categorySlug));
        }

        return $query->get();
    }

    public function getCategories(): Collection
    {
        return ProjectCategory::ordered()->withCount('projects')->get();
    }

    public function findBySlug(string $slug): ?Project
    {
        return Project::with(['category', 'technologies', 'skills', 'experiences', 'achievements'])
            ->where('slug', $slug)
            ->first();
    }
}
