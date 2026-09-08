<?php

namespace Database\Factories;

use App\Models\Education;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Education>
 */
class EducationFactory extends Factory
{
    protected $model = Education::class;

    public function definition(): array
    {
        $school = fake()->company().' University';

        return [
            'institution' => $school,
            'slug' => Str::slug($school).'-'.fake()->unique()->numberBetween(100, 999),
            'degree' => "Bachelor's Degree",
            'major' => 'Computer Science',
            'description' => fake()->paragraph(),
            'started_at' => fake()->dateTimeBetween('-8 years', '-4 years')->format('Y-m-d'),
            'ended_at' => fake()->dateTimeBetween('-4 years', 'now')->format('Y-m-d'),
            'is_current' => false,
            'logo' => null,
            'sort_order' => 0,
        ];
    }
}
