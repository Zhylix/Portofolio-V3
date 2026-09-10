<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Certificate;
use App\Models\Service;
use App\Services\ProfileService;
use App\Services\ProjectService;
use App\Services\SkillService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(
        ProfileService $profileService,
        ProjectService $projectService,
        SkillService $skillService
    ): View {
        $profile = $profileService->getProfile();
        $featuredProjects = $projectService->getFeaturedProjects()->take(4);
        $featuredSkills = $skillService->getFeaturedSkills()->take(8);
        $featuredAchievements = Achievement::featured()->ordered()->take(3)->get();
        $featuredCertificates = Certificate::featured()->ordered()->take(3)->get();
        $services = Service::featured()->ordered()->get();
        $socialLinks = $profileService->getSocialLinks();

        return view('pages.home', compact(
            'profile',
            'featuredProjects',
            'featuredSkills',
            'featuredAchievements',
            'featuredCertificates',
            'services',
            'socialLinks'
        ));
    }
}
