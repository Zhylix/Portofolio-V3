<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\ExperienceType;
use App\Models\Organization;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SkillCategory;
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

    public function test_journey_case_study_renders_connected_evidence_and_artifacts(): void
    {
        $type = ExperienceType::factory()->create(['is_active' => true]);
        $org = Organization::factory()->create();

        $experience = Experience::factory()->create([
            'experience_type_id' => $type->id,
            'organization_id' => $org->id,
            'title' => 'Chief Architect at ScaleCorp',
            'slug' => 'chief-architect-scalecorp',
            'status' => 'published',
            'visibility' => 'public',
        ]);

        $cat = SkillCategory::factory()->create();
        $skill = Skill::factory()->create(['skill_category_id' => $cat->id, 'name' => 'Kubernetes Clustering']);
        $project = Project::factory()->create(['title' => 'Distributed Cache Gateway', 'slug' => 'distributed-cache-gateway']);
        $cert = Certificate::factory()->create(['title' => 'AWS Solutions Architect Professional']);
        $ach = Achievement::factory()->create(['title' => 'National Hackathon Champion']);

        $experience->skills()->attach($skill);
        $experience->projects()->attach($project);
        $experience->certificates()->attach($cert);
        $experience->achievements()->attach($ach);

        $response = $this->get(route('journey.show', $experience->slug));

        $response->assertStatus(200);
        $response->assertSee('Chief Architect at ScaleCorp');
        $response->assertSee('Kubernetes Clustering');
        $response->assertSee('Distributed Cache Gateway');
        $response->assertSee('AWS Solutions Architect Professional');
        $response->assertSee('National Hackathon Champion');
        $response->assertSee('data-cursor="view"', false);
        $response->assertSee('data-cursor="explore"', false);
    }
}
