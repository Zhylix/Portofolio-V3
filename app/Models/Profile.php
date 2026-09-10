<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Profile extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'headline',
        'short_bio',
        'long_bio',
        'location',
        'email',
        'avatar',
        'resume',
        'availability',
        'hero_label',
        'hero_description',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('resume')
            ->singleFile()
            ->acceptsMimeTypes(['application/pdf']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->format('webp')
            ->nonQueued()
            ->performOnCollections('avatar');

        $this->addMediaConversion('medium')
            ->width(350)
            ->height(350)
            ->format('webp')
            ->nonQueued()
            ->performOnCollections('avatar');
    }

    public function getFullNameAttribute(): string
    {
        return $this->name ?? 'Helmy Yunan Nasution';
    }

    public function getAvatarUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('avatar', 'medium')
            ?: ($this->getFirstMediaUrl('avatar')
            ?: ($this->avatar ? asset($this->avatar) : null));
    }

    public function getResumeUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('resume')
            ?: ($this->resume ? asset($this->resume) : null);
    }

    public function getIsAvailableAttribute(): bool
    {
        return ! empty($this->availability);
    }

    public function getAvailabilityStatusAttribute(): ?string
    {
        return $this->availability ?? 'Available for Collaboration';
    }

    public function getBioAttribute(): ?string
    {
        return $this->short_bio ?? $this->long_bio;
    }
}
