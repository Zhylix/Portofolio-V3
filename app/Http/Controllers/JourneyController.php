<?php

namespace App\Http\Controllers;

use App\Services\ExperienceService;
use Illuminate\Contracts\View\View;

class JourneyController extends Controller
{
    public function index(ExperienceService $experienceService): View
    {
        $experiences = $experienceService->getTimeline();
        $types = $experienceService->getActiveExperienceTypes();

        return view('pages.journey.index', compact('experiences', 'types'));
    }

    public function show(string $slug, ExperienceService $experienceService): View
    {
        $experience = $experienceService->findBySlug($slug);

        if (! $experience) {
            abort(404);
        }

        return view('pages.journey.show', compact('experience'));
    }
}
