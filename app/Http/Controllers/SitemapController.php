<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $staticRoutes = [
            ['url' => route('home'), 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => route('about'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('projects.index'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('skills.index'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('certificates.index'), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => route('achievements.index'), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => route('contact.index'), 'priority' => '0.6', 'changefreq' => 'monthly'],
        ];

        $projects = Project::select('slug', 'updated_at')->get();

        $content = view('sitemap', compact('staticRoutes', 'projects'))->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}
