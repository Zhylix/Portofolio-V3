<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Profile>
 */
class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'name' => 'Helmy Yunan Nasution',
            'headline' => 'Software Engineer & System Architect',
            'short_bio' => 'Engineering reliable, high-performance backends and scalable modern web architectures.',
            'long_bio' => 'Passionate software architect with extensive expertise across modern PHP, Laravel ecosystems, distributed databases, cloud architecture, and clean code principles.',
            'location' => 'Jakarta / Remote, Indonesia',
            'email' => 'contact@helmyyunan.dev',
            'avatar' => null,
            'resume' => '/assets/resume.pdf',
            'availability' => 'Available for Architecture Consulting & Select Projects',
            'hero_label' => 'Software Engineer & System Architect',
            'hero_description' => 'Architecting robust systems and elegant solutions with Laravel 13, MySQL, and modern tooling.',
        ];
    }
}
