<?php

namespace App\Http\Controllers;

use App\Services\SkillService;
use Illuminate\Contracts\View\View;

class SkillController extends Controller
{
    public function index(SkillService $skillService): View
    {
        $categories = $skillService->getSkillsByCategory();

        return view('pages.skills.index', compact('categories'));
    }
}
