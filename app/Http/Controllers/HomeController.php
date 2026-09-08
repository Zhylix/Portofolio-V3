<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Service;
use App\Models\SocialLink;
use App\Services\ExperienceService;
use App\Services\SkillService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(ExperienceService $experienceService, SkillService $skillService): View
    {
        $profile = Profile::first();
        $featuredProjects = Project::with(['category', 'technologies'])->featured()->ordered()->take(4)->get();
        $featuredExperiences = $experienceService->getFeatured()->take(4);
        $featuredSkills = $skillService->getFeaturedSkills()->take(8);
        $services = Service::featured()->ordered()->get();
        $articles = Article::published()->ordered()->take(3)->get();
        $socialLinks = SocialLink::ordered()->get();

        return view('pages.home', compact(
            'profile',
            'featuredProjects',
            'featuredExperiences',
            'featuredSkills',
            'services',
            'articles',
            'socialLinks'
        ));
    }
}
