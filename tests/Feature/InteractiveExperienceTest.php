<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InteractiveExperienceTest extends TestCase
{
    use RefreshDatabase;

    public function test_conversational_contact_form_submits_successfully(): void
    {
        $payload = [
            'type' => 'project',
            'subject' => 'Scalable Cloud Architecture',
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'message' => 'We are looking to scale our microservices system with Laravel and Redis.',
        ];

        $response = $this->post(route('contact.store'), $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'type' => 'project',
            'subject' => 'Scalable Cloud Architecture',
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);
    }

    public function test_command_palette_and_interactive_elements_present_on_pages(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('id="scroll-progress"', false);
        $response->assertSee('id="cursor-dot"', false);
        $response->assertSee('id="cursor-ring"', false);
        $response->assertSee('open-command-palette', false);
    }

    public function test_project_show_renders_interactive_details(): void
    {
        $project = Project::factory()->create([
            'title' => 'Distributed Cache Gateway',
            'slug' => 'distributed-cache-gateway',
            'description' => 'Detailed architecture for high-throughput distributed caching.',
        ]);

        $response = $this->get(route('projects.show', $project->slug));

        $response->assertStatus(200);
        $response->assertSee('Distributed Cache Gateway');
        $response->assertSee('Detailed architecture for high-throughput distributed caching.');
    }

    public function test_journey_routes_are_decommissioned_and_return_404(): void
    {
        $response = $this->get('/journey');
        $response->assertStatus(404);

        $responseSlug = $this->get('/journey/some-experience-slug');
        $responseSlug->assertStatus(404);
    }
}
