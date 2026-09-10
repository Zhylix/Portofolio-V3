<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Certificate;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $query = trim((string) $request->query('q', ''));
        $type = (string) $request->query('type', 'all');

        $projects = collect();
        $skills = collect();
        $certificates = collect();
        $achievements = collect();
        $paginatedResults = null;

        if ($query !== '') {
            if ($type === 'all') {
                $projects = Project::search($query)->query(fn ($q) => $q->with(['category', 'technologies']))->take(6)->get();
                $skills = Skill::search($query)->query(fn ($q) => $q->with('category'))->take(8)->get();
                $certificates = Certificate::search($query)->take(4)->get();
                $achievements = Achievement::search($query)->take(4)->get();
            } elseif ($type === 'projects') {
                $paginatedResults = Project::search($query)->query(fn ($q) => $q->with(['category', 'technologies']))->paginate(10)->withQueryString();
            } elseif ($type === 'skills') {
                $paginatedResults = Skill::search($query)->query(fn ($q) => $q->with('category'))->paginate(15)->withQueryString();
            } elseif ($type === 'certificates') {
                $paginatedResults = Certificate::search($query)->paginate(12)->withQueryString();
            } elseif ($type === 'achievements') {
                $paginatedResults = Achievement::search($query)->paginate(12)->withQueryString();
            }
        }

        return view('pages.search', compact(
            'query',
            'type',
            'projects',
            'skills',
            'certificates',
            'achievements',
            'paginatedResults'
        ));
    }
}
