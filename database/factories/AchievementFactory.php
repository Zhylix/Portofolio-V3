<?php

namespace Database\Factories;

use App\Models\Achievement;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Achievement>
 */
class AchievementFactory extends Factory
{
    protected $model = Achievement::class;

    public function definition(): array
    {
        $title = fake()->words(3, true).' Award';

        return [
            'title' => ucwords($title),
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(100, 999),
            'description' => fake()->paragraph(),
            'organization' => fake()->company(),
            'date' => fake()->date(),
            'rank' => '1st Place Winner',
            'result' => 'Gold Medal & Trophy',
            'image' => null,
            'url' => fake()->url(),
            'featured' => fake()->boolean(50),
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
