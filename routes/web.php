<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JourneyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

// 1. Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. About
Route::get('/about', [AboutController::class, 'index'])->name('about');

// 3. Projects
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');

// 4. Professional Journey & Experiences
Route::get('/journey', [JourneyController::class, 'index'])->name('journey.index');
Route::get('/journey/{slug}', [JourneyController::class, 'show'])->name('journey.show');

// 5. Skills & Evidence
Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');

// 6. Certificates
Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');

// 7. Achievements & Honors
Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');

// 8. Articles & Publications
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// 9. Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// 10. Global Search
Route::get('/search', [SearchController::class, 'index'])->name('search');
