<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomepageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_homepage_returns_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Helmy Yunan Nasution');
        $response->assertSee('PROJECTS');
        $response->assertDontSee('MY JOURNEY');
    }

    public function test_all_placeholder_pages_return_successful_response(): void
    {
        $this->get('/about')->assertStatus(200);
        $this->get('/projects')->assertStatus(200);
        $this->get('/skills')->assertStatus(200);
        $this->get('/certificates')->assertStatus(200);
        $this->get('/achievements')->assertStatus(200);
        $this->get('/contact')->assertStatus(200);
        $this->get('/search?q=Laravel')->assertStatus(200);

        // Journey and Articles are decommissioned and return 404
        $this->get('/journey')->assertStatus(404);
        $this->get('/articles')->assertStatus(404);
    }
}
