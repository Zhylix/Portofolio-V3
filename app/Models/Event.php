<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(250)
            ->format('webp')
            ->nonQueued()
            ->performOnCollections('image');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('image', 'thumb')
            ?: ($this->getFirstMediaUrl('image')
            ?: ($this->image ? asset($this->image) : null));
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
