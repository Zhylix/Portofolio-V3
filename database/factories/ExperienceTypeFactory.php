<?php

namespace Database\Factories;

use App\Models\ExperienceType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<ExperienceType>
 */
class ExperienceTypeFactory extends Factory
{
    protected $model = ExperienceType::class;

    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'name' => ucwords($name),
            'code' => Str::slug($name, '_'),
            'description' => fake()->sentence(),
            'icon' => 'briefcase',
            'is_active' => true,
            'sort_order' => fake()->numberBetween(0, 50),
        ];
    }
}
