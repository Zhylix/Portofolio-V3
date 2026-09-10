<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Certificate extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Searchable;

    protected $fillable = [
        'title',
        'slug',
        'issuer',
        'credential_id',
        'description',
        'issued_at',
        'expires_at',
        'credential_url',
        'image',
        'featured',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'issued_at' => 'date',
            'expires_at' => 'date',
            'featured' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'application/pdf']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(280)
            ->format('webp')
            ->nonQueued()
            ->performOnCollections('image');

        $this->addMediaConversion('preview')
            ->width(800)
            ->height(560)
            ->format('webp')
            ->nonQueued()
            ->performOnCollections('image');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('image', 'preview')
            ?: ($this->getFirstMediaUrl('image')
            ?: ($this->image ? asset($this->image) : null));
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'issuer' => $this->issuer,
            'description' => $this->description,
            'credential_id' => $this->credential_id,
        ];
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'certificate_skill');
    }

    public function experiences(): BelongsToMany
    {
        return $this->belongsToMany(Experience::class, 'experience_certificate');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderByDesc('issued_at')->orderBy('sort_order');
    }
}
