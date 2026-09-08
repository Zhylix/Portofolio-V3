<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'organizer',
        'description',
        'date',
        'location',
        'url',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function experiences(): BelongsToMany
    {
        return $this->belongsToMany(Experience::class, 'experience_event');
    }

    public function scopeLatestDate(Builder $query): Builder
    {
        return $query->orderByDesc('date');
    }
}
