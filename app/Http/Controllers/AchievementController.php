<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Contracts\View\View;

class AchievementController extends Controller
{
    public function index(): View
    {
        $achievements = Achievement::with(['skills', 'experiences', 'projects'])->ordered()->paginate(12)->withQueryString();

        return view('pages.achievements.index', compact('achievements'));
    }
}
