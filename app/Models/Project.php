<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Searchable;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'short_description',
        'description',
        'problem',
        'solution',
        'features',
        'architecture',
        'role',
        'started_at',
        'ended_at',
        'status',
        'github_url',
        'demo_url',
        'featured',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'started_at' => 'date',
            'ended_at' => 'date',
            'featured' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'project_technology');
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'project_skill');
    }

    public function experiences(): BelongsToMany
    {
        return $this->belongsToMany(Experience::class, 'experience_project');
    }

    public function achievements(): BelongsToMany
    {
        return $this->belongsToMany(Achievement::class, 'project_achievement');
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_project');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('screenshots')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(250)
            ->format('webp')
            ->nonQueued()
            ->performOnCollections('thumbnail', 'screenshots');

        $this->addMediaConversion('medium')
            ->width(800)
            ->height(500)
            ->format('webp')
            ->nonQueued()
            ->performOnCollections('thumbnail');

        $this->addMediaConversion('large')
            ->width(1200)
            ->height(750)
            ->format('webp')
            ->nonQueued()
            ->performOnCollections('thumbnail', 'screenshots');
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMetadata::class, 'seomodel');
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'problem' => $this->problem,
            'solution' => $this->solution,
            'role' => $this->role,
        ];
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderByDesc('featured')
            ->orderBy('sort_order')
            ->orderByDesc('started_at');
    }
}
