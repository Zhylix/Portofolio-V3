<?php

namespace Database\Factories;

use App\Models\SeoMetadata;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SeoMetadata>
 */
class SeoMetadataFactory extends Factory
{
    protected $model = SeoMetadata::class;

    public function definition(): array
    {
        return [
            'seomodel_type' => null,
            'seomodel_id' => null,
            'meta_title' => fake()->sentence(4),
            'meta_description' => fake()->paragraph(),
            'keywords' => 'laravel, php, portfolio, system architecture',
            'og_title' => fake()->sentence(4),
            'og_description' => fake()->paragraph(),
            'og_image' => null,
            'canonical_url' => fake()->url(),
            'robots' => 'index, follow',
        ];
    }
}
