<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

// 1. Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. About
Route::get('/about', [AboutController::class, 'index'])->name('about');

// 3. Projects
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');

// 4. Skills & Evidence
Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');

// 5. Certificates
Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');

// 6. Achievements
Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');

// 7. Contact (with rate limiting: max 5 submissions per minute)
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

// 8. Global Search (with rate limiting: max 30 queries per minute)
Route::get('/search', [SearchController::class, 'index'])
    ->middleware('throttle:30,1')
    ->name('search');

// 9. Dynamic XML Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
