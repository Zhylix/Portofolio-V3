<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $query = trim((string) $request->query('q', ''));

        $projects = collect();
        $experiences = collect();
        $skills = collect();
        $articles = collect();

        if ($query !== '') {
            $projects = Project::where('title', 'like', "%{$query}%")
                ->orWhere('short_description', 'like', "%{$query}%")
                ->take(6)->get();

            $experiences = Experience::where('title', 'like', "%{$query}%")
                ->orWhere('role', 'like', "%{$query}%")
                ->orWhere('summary', 'like', "%{$query}%")
                ->take(6)->get();

            $skills = Skill::where('name', 'like', "%{$query}%")
                ->take(8)->get();

            $articles = Article::published()
                ->where('title', 'like', "%{$query}%")
                ->take(4)->get();
        }

        return view('pages.search', compact('query', 'projects', 'experiences', 'skills', 'articles'));
    }
}
