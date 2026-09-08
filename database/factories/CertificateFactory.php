<?php

namespace Database\Factories;

use App\Models\Certificate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Certificate>
 */
class CertificateFactory extends Factory
{
    protected $model = Certificate::class;

    public function definition(): array
    {
        $title = fake()->words(3, true).' Certification';

        return [
            'title' => ucwords($title),
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(100, 999),
            'issuer' => fake()->company(),
            'credential_id' => fake()->uuid(),
            'description' => fake()->paragraph(),
            'issued_at' => fake()->dateTimeBetween('-3 years', 'now')->format('Y-m-d'),
            'expires_at' => null,
            'credential_url' => fake()->url(),
            'image' => null,
            'featured' => fake()->boolean(40),
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
