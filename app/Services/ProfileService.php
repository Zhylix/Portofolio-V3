<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\Setting;
use App\Models\SocialLink;
use Illuminate\Database\Eloquent\Collection;

class ProfileService
{
    public function getProfile(): ?Profile
    {
        return Profile::first();
    }

    public function getSocialLinks(): Collection
    {
        return SocialLink::ordered()->get();
    }

    public function getSettings(): array
    {
        return Setting::all()->pluck('value', 'key')->toArray();
    }
}
