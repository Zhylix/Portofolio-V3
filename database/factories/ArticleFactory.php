<?php

namespace Database\Factories;

use App\Enums\ContentStatus;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        $title = fake()->sentence(5);

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(100, 999),
            'excerpt' => fake()->paragraph(),
            'content' => fake()->paragraphs(5, true),
            'thumbnail' => null,
            'category' => fake()->randomElement(['Architecture', 'Performance', 'Laravel', 'Databases']),
            'status' => ContentStatus::PUBLISHED->value,
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
