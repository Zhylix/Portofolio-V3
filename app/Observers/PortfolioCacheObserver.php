<?php

namespace App\Observers;

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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PortfolioCacheObserver
{
    public function saved(Model $model): void
    {
        $this->clearModelCache($model);
    }

    public function deleted(Model $model): void
    {
        $this->clearModelCache($model);
    }

    protected function clearModelCache(Model $model): void
    {
        if ($model instanceof Profile) {
            Cache::forget('portfolio.profile');
        } elseif ($model instanceof SocialLink) {
            Cache::forget('portfolio.social_links');
        } elseif ($model instanceof Setting) {
            Cache::forget('portfolio.settings');
        } elseif ($model instanceof Project || $model instanceof ProjectCategory) {
            Cache::forget('portfolio.featured_projects');
            Cache::forget('portfolio.project_categories');
            Cache::forget('palette.projects');
        } elseif ($model instanceof Skill || $model instanceof SkillCategory) {
            Cache::forget('portfolio.featured_skills');
            Cache::forget('portfolio.grouped_skills');
        } elseif ($model instanceof Experience || $model instanceof ExperienceType) {
            Cache::forget('portfolio.featured_experiences');
            Cache::forget('portfolio.experience_types');
        } elseif ($model instanceof Certificate) {
            Cache::forget('portfolio.featured_certificates');
        } elseif ($model instanceof Achievement) {
            Cache::forget('portfolio.featured_achievements');
        } elseif ($model instanceof Article) {
            Cache::forget('palette.articles');
        }
    }
}
