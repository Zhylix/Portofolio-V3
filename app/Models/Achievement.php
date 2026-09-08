<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'organization',
        'date',
        'rank',
        'result',
        'image',
        'url',
        'featured',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'featured' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'achievement_skill');
    }

    public function experiences(): BelongsToMany
    {
        return $this->belongsToMany(Experience::class, 'experience_achievement');
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_achievement');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderByDesc('date')->orderBy('sort_order');
    }
}
