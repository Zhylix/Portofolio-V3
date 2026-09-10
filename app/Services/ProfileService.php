<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\Setting;
use App\Models\SocialLink;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ProfileService
{
    public function getProfile(): ?Profile
    {
        $profile = Cache::rememberForever('portfolio.profile', fn () => Profile::first());

        if ($profile instanceof \__PHP_Incomplete_Class) {
            Cache::forget('portfolio.profile');

            return Profile::first();
        }

        return $profile;
    }

    public function getSocialLinks(): Collection
    {
        $socialLinks = Cache::rememberForever('portfolio.social_links', fn () => SocialLink::ordered()->get());

        if ($socialLinks instanceof \__PHP_Incomplete_Class) {
            Cache::forget('portfolio.social_links');

            return SocialLink::ordered()->get();
        }

        return $socialLinks;
    }

    public function getSettings(): array
    {
        $settings = Cache::rememberForever('portfolio.settings', fn () => Setting::all()->pluck('value', 'key')->toArray());

        if (! is_array($settings)) {
            Cache::forget('portfolio.settings');

            return Setting::all()->pluck('value', 'key')->toArray();
        }

        return $settings;
    }
}
