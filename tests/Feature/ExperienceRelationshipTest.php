<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\Certificate;
use App\Models\Event;
use App\Models\Experience;
use App\Models\ExperienceType;
use App\Models\Organization;
use App\Models\Project;
use App\Models\Skill;
use App\Services\ExperienceService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExperienceRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_experience_has_all_defined_relationships(): void
    {
        $type = ExperienceType::factory()->create(['is_active' => true]);
        $org = Organization::factory()->create();
        $project = Project::factory()->create();
        $skill = Skill::factory()->create();
        $achievement = Achievement::factory()->create();
        $certificate = Certificate::factory()->create();
        $event = Event::factory()->create();

        $experience = Experience::factory()->create([
            'experience_type_id' => $type->id,
            'organization_id' => $org->id,
            'slug' => 'test-experience-slug',
        ]);

        $experience->projects()->attach($project);
        $experience->skills()->attach($skill);
        $experience->achievements()->attach($achievement);
        $experience->certificates()->attach($certificate);
        $experience->events()->attach($event);

        // Assert relationships
        $this->assertEquals($type->id, $experience->experienceType->id);
        $this->assertEquals($org->id, $experience->organization->id);
        $this->assertTrue($experience->projects->contains($project));
        $this->assertTrue($experience->skills->contains($skill));
        $this->assertTrue($experience->achievements->contains($achievement));
        $this->assertTrue($experience->certificates->contains($certificate));
        $this->assertTrue($experience->events->contains($event));

        // Assert decommissioned public route returns 404
        $response = $this->get('/journey/'.$experience->slug);
        $response->assertStatus(404);
    }

    public function test_admin_can_toggle_experience_type_visibility(): void
    {
        $activeType = ExperienceType::factory()->create(['is_active' => true]);
        $inactiveType = ExperienceType::factory()->create(['is_active' => false]);

        $exp1 = Experience::factory()->create(['experience_type_id' => $activeType->id]);
        $exp2 = Experience::factory()->create(['experience_type_id' => $inactiveType->id]);

        $service = app(ExperienceService::class);
        $timeline = $service->getTimeline();

        $this->assertTrue($timeline->pluck('id')->contains($exp1->id));
        $this->assertFalse($timeline->pluck('id')->contains($exp2->id));
    }
}
