<?php

namespace Database\Factories;

use App\Models\SocialLink;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SocialLink>
 */
class SocialLinkFactory extends Factory
{
    protected $model = SocialLink::class;

    public function definition(): array
    {
        $platform = fake()->randomElement(['github', 'linkedin', 'twitter', 'discord', 'email']);

        return [
            'platform' => $platform,
            'username' => fake()->userName(),
            'url' => fake()->url(),
            'icon' => null,
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
