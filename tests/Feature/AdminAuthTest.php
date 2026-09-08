<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->user = User::first() ?? User::factory()->create();
    }

    public function test_guest_is_redirected_to_filament_login(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/admin/login');
    }

    public function test_guest_cannot_access_admin_resources(): void
    {
        $this->get('/admin/projects')->assertRedirect('/admin/login');
        $this->get('/admin/experiences')->assertRedirect('/admin/login');
        $this->get('/admin/skills')->assertRedirect('/admin/login');
        $this->get('/admin/articles')->assertRedirect('/admin/login');
        $this->get('/admin/contact-messages')->assertRedirect('/admin/login');
    }

    public function test_authenticated_admin_can_access_filament_dashboard(): void
    {
        $response = $this->actingAs($this->user)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }

    public function test_authenticated_admin_can_access_all_resource_index_pages(): void
    {
        $routes = [
            '/admin/profiles',
            '/admin/experiences',
            '/admin/experience-types',
            '/admin/organizations',
            '/admin/events',
            '/admin/projects',
            '/admin/project-categories',
            '/admin/technologies',
            '/admin/skills',
            '/admin/skill-categories',
            '/admin/education',
            '/admin/certificates',
            '/admin/achievements',
            '/admin/articles',
            '/admin/services',
            '/admin/social-links',
            '/admin/seo-metadata',
            '/admin/settings',
            '/admin/contact-messages',
        ];

        foreach ($routes as $route) {
            $response = $this->actingAs($this->user)->get($route);
            $response->assertStatus(200);
        }
    }

    public function test_authenticated_admin_can_access_resource_create_pages(): void
    {
        $createRoutes = [
            '/admin/projects/create',
            '/admin/experiences/create',
            '/admin/skills/create',
            '/admin/articles/create',
            '/admin/certificates/create',
            '/admin/achievements/create',
        ];

        foreach ($createRoutes as $route) {
            $response = $this->actingAs($this->user)->get($route);
            $response->assertStatus(200);
        }
    }
}
