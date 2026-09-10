<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ProjectService
{
    public function getFeaturedProjects(): Collection
    {
        $projects = Cache::rememberForever('portfolio.featured_projects', function () {
            return Project::with(['category', 'technologies', 'skills'])
                ->featured()
                ->ordered()
                ->get();
        });

        if ($projects instanceof \__PHP_Incomplete_Class) {
            Cache::forget('portfolio.featured_projects');

            return Project::with(['category', 'technologies', 'skills'])
                ->featured()
                ->ordered()
                ->get();
        }

        return $projects;
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

    public function getPaginatedProjects(?string $categorySlug = null, int $perPage = 9): LengthAwarePaginator
    {
        $query = Project::with(['category', 'technologies', 'skills', 'experiences'])
            ->ordered();

        if ($categorySlug) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $categorySlug));
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function getCategories(): Collection
    {
        $categories = Cache::rememberForever('portfolio.project_categories', function () {
            return ProjectCategory::ordered()->withCount('projects')->get();
        });

        if ($categories instanceof \__PHP_Incomplete_Class) {
            Cache::forget('portfolio.project_categories');

            return ProjectCategory::ordered()->withCount('projects')->get();
        }

        return $categories;
    }

    public function findBySlug(string $slug): ?Project
    {
        return Project::with(['category', 'technologies', 'skills', 'experiences', 'achievements'])
            ->where('slug', $slug)
            ->first();
    }
}
