<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Profile;
use App\Models\Service;
use App\Models\Skill;
use App\Models\SocialLink;
use Illuminate\Contracts\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $profile = Profile::first();
        $educations = Education::ordered()->get();
        $socialLinks = SocialLink::ordered()->get();
        $services = Service::ordered()->get();
        $skills = Skill::with('category')->featured()->ordered()->get();

        return view('pages.about', compact('profile', 'educations', 'socialLinks', 'services', 'skills'));
    }
}
