<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\Experience;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Skill;
use App\Models\Technology;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_project_has_all_defined_relationships(): void
    {
        $category = ProjectCategory::factory()->create();
        $technology = Technology::factory()->create();
        $skill = Skill::factory()->create();
        $achievement = Achievement::factory()->create();
        $experience = Experience::factory()->create();

        $project = Project::factory()->create([
            'category_id' => $category->id,
            'slug' => 'test-project-sample',
        ]);

        $project->technologies()->attach($technology);
        $project->skills()->attach($skill);
        $project->achievements()->attach($achievement);
        $project->experiences()->attach($experience);

        // Assert relationships
        $this->assertEquals($category->id, $project->category->id);
        $this->assertTrue($project->technologies->contains($technology));
        $this->assertTrue($project->skills->contains($skill));
        $this->assertTrue($project->achievements->contains($achievement));
        $this->assertTrue($project->experiences->contains($experience));

        // Test route with slug
        $response = $this->get('/projects/'.$project->slug);
        $response->assertStatus(200);
        $response->assertSee($project->title);
    }
}
