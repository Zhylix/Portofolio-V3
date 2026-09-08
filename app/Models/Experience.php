<?php

namespace App\Models;

use App\Enums\ContentStatus;
use App\Enums\VisibilityStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'experience_type_id',
        'organization_id',
        'title',
        'slug',
        'role',
        'summary',
        'description',
        'contribution',
        'challenge',
        'solution',
        'outcome',
        'location',
        'started_at',
        'ended_at',
        'is_current',
        'featured',
        'status',
        'sort_order',
        'visibility',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'date',
            'ended_at' => 'date',
            'is_current' => 'boolean',
            'featured' => 'boolean',
            'sort_order' => 'integer',
            'status' => ContentStatus::class,
            'visibility' => VisibilityStatus::class,
        ];
    }

    public function experienceType(): BelongsTo
    {
        return $this->belongsTo(ExperienceType::class, 'experience_type_id');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'experience_project');
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'experience_skill');
    }

    public function achievements(): BelongsToMany
    {
        return $this->belongsToMany(Achievement::class, 'experience_achievement');
    }

    public function certificates(): BelongsToMany
    {
        return $this->belongsToMany(Certificate::class, 'experience_certificate');
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'experience_event');
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_experience');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', ContentStatus::PUBLISHED->value);
    }

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('visibility', VisibilityStatus::PUBLIC->value);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderByDesc('is_current')
            ->orderByDesc('started_at')
            ->orderBy('sort_order');
    }
}
