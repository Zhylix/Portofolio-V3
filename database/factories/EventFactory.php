<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $name = fake()->catchPhrase().' Conference';

        return [
            'name' => $name,
            'slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(100, 999),
            'type' => fake()->randomElement(['Conference', 'Hackathon', 'Meetup', 'Summit']),
            'organizer' => fake()->company(),
            'description' => fake()->paragraph(),
            'date' => fake()->date(),
            'location' => fake()->city(),
            'url' => fake()->url(),
            'image' => null,
        ];
    }
}
