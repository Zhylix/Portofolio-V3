<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $title = fake()->words(3, true).' System';

        return [
            'category_id' => ProjectCategory::factory(),
            'title' => ucwords($title),
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(100, 999),
            'short_description' => fake()->sentence(15),
            'description' => fake()->paragraphs(3, true),
            'problem' => fake()->paragraph(),
            'solution' => fake()->paragraph(),
            'features' => ['High Throughput', 'Role-Based Access', 'API Gateway', 'Real-time WebSocket'],
            'architecture' => 'Domain-Driven Design (DDD) with Clean Architecture and CQRS.',
            'role' => 'Lead Backend Engineer',
            'started_at' => fake()->dateTimeBetween('-2 years', '-6 months')->format('Y-m-d'),
            'ended_at' => null,
            'status' => 'completed',
            'github_url' => 'https://github.com/helmyyunan/'.Str::slug($title),
            'demo_url' => fake()->url(),
            'featured' => fake()->boolean(40),
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
