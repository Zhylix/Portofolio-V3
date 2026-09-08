<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::with(['skills', 'projects'])->published()->ordered()->get();

        return view('pages.articles.index', compact('articles'));
    }

    public function show(string $slug): View
    {
        $article = Article::with(['skills', 'projects', 'experiences'])
            ->where('slug', $slug)
            ->first();

        if (! $article) {
            abort(404);
        }

        return view('pages.articles.show', compact('article'));
    }
}
