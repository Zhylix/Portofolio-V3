<?php

namespace Database\Factories;

use App\Enums\ContentStatus;
use App\Enums\VisibilityStatus;
use App\Models\Experience;
use App\Models\ExperienceType;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Experience>
 */
class ExperienceFactory extends Factory
{
    protected $model = Experience::class;

    public function definition(): array
    {
        $title = fake()->jobTitle();

        return [
            'experience_type_id' => ExperienceType::factory(),
            'organization_id' => Organization::factory(),
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(100, 999),
            'role' => fake()->jobTitle(),
            'summary' => fake()->sentence(12),
            'description' => fake()->paragraphs(3, true),
            'contribution' => fake()->paragraph(),
            'challenge' => fake()->sentence(),
            'solution' => fake()->sentence(),
            'outcome' => fake()->sentence(),
            'location' => fake()->city().', '.fake()->country(),
            'started_at' => fake()->dateTimeBetween('-4 years', '-1 years')->format('Y-m-d'),
            'ended_at' => null,
            'is_current' => true,
            'featured' => fake()->boolean(40),
            'status' => ContentStatus::PUBLISHED->value,
            'sort_order' => fake()->numberBetween(0, 20),
            'visibility' => VisibilityStatus::PUBLIC->value,
        ];
    }
}
