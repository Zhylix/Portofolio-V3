<?php

namespace Tests\Feature;

use App\Filament\Pages\Auth\Login;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
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

    public function test_login_page_renders_premium_branding_and_technical_metadata(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
        $response->assertSee('ZEPHYR');
        $response->assertSee('SYSTEM');
        $response->assertSee('Manage the things behind the portfolio.');
        $response->assertSee('PORTFOLIO CMS');
        $response->assertSee('ONLINE');
        $response->assertSee('Welcome back.');
        $response->assertSee('Sign In');
    }

    public function test_login_failure_displays_custom_subtle_error(): void
    {
        Livewire::test(Login::class)
            ->fillForm([
                'email' => 'wrong@example.com',
                'password' => 'invalid-password',
            ])
            ->call('authenticate')
            ->assertHasErrors(['data.email' => 'Invalid credentials. Email atau password yang kamu masukkan tidak sesuai. Please try again.']);
    }
}
