<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

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

    public function getFullNameAttribute(): string
    {
        return $this->name ?? 'Helmy Yunan Nasution';
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
