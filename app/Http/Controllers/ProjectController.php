<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request, ProjectService $projectService): View
    {
        $categorySlug = $request->query('category');
        $projects = $projectService->getPaginatedProjects($categorySlug, 9);
        $categories = $projectService->getCategories();

        return view('pages.projects.index', compact('projects', 'categories', 'categorySlug'));
    }

    public function show(string $slug, ProjectService $projectService): View
    {
        $project = $projectService->findBySlug($slug);

        if (! $project) {
            abort(404);
        }

        return view('pages.projects.show', compact('project'));
    }
}
