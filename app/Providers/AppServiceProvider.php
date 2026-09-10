<?php

namespace App\Providers;

use App\Models\Achievement;
use App\Models\Article;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\ExperienceType;
use App\Models\Profile;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\SocialLink;
use App\Observers\PortfolioCacheObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Profile::observe(PortfolioCacheObserver::class);
        SocialLink::observe(PortfolioCacheObserver::class);
        Setting::observe(PortfolioCacheObserver::class);
        Project::observe(PortfolioCacheObserver::class);
        ProjectCategory::observe(PortfolioCacheObserver::class);
        Skill::observe(PortfolioCacheObserver::class);
        SkillCategory::observe(PortfolioCacheObserver::class);
        Experience::observe(PortfolioCacheObserver::class);
        ExperienceType::observe(PortfolioCacheObserver::class);
        Certificate::observe(PortfolioCacheObserver::class);
        Achievement::observe(PortfolioCacheObserver::class);
        Article::observe(PortfolioCacheObserver::class);
    }
}
