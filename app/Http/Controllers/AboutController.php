<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Service;
use App\Services\ProfileService;
use App\Services\SkillService;
use Illuminate\Contracts\View\View;

class AboutController extends Controller
{
    public function index(ProfileService $profileService, SkillService $skillService): View
    {
        $profile = $profileService->getProfile();
        $educations = Education::ordered()->get();
        $socialLinks = $profileService->getSocialLinks();
        $services = Service::ordered()->get();
        $skills = $skillService->getFeaturedSkills();

        return view('pages.about', compact('profile', 'educations', 'socialLinks', 'services', 'skills'));
    }
}
