<?php

namespace Tests\Feature;

use App\Livewire\JourneyTimeline;
use App\Models\Experience;
use App\Models\ExperienceType;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class JourneyTimelineTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_journey_timeline_component_mounts_successfully(): void
    {
        $type = ExperienceType::factory()->create([
            'name' => 'Full-Time Engineering',
            'code' => 'full-time',
            'is_active' => true,
        ]);

        $org = Organization::factory()->create();

        Experience::factory()->create([
            'experience_type_id' => $type->id,
            'organization_id' => $org->id,
            'title' => 'Senior Backend Architect',
            'slug' => 'senior-backend-architect',
            'status' => 'published',
            'visibility' => 'public',
        ]);

        Livewire::test(JourneyTimeline::class)
            ->assertStatus(200)
            ->assertSee('Full-Time Engineering')
            ->assertSee('Senior Backend Architect')
            ->assertSee('PLAY MY JOURNEY');
    }

    public function test_journey_timeline_filters_by_experience_type(): void
    {
        $typeWork = ExperienceType::factory()->create([
            'name' => 'Work Experience',
            'code' => 'work',
            'is_active' => true,
        ]);

        $typeOrg = ExperienceType::factory()->create([
            'name' => 'Organization Leadership',
            'code' => 'org',
            'is_active' => true,
        ]);

        $org = Organization::factory()->create();

        Experience::factory()->create([
            'experience_type_id' => $typeWork->id,
            'organization_id' => $org->id,
            'title' => 'Work Role Milestone',
            'status' => 'published',
            'visibility' => 'public',
        ]);

        Experience::factory()->create([
            'experience_type_id' => $typeOrg->id,
            'organization_id' => $org->id,
            'title' => 'Leadership Role Milestone',
            'status' => 'published',
            'visibility' => 'public',
        ]);

        Livewire::test(JourneyTimeline::class)
            ->call('setFilter', 'work')
            ->assertSet('activeFilter', 'work')
            ->assertSee('Work Role Milestone')
            ->assertDontSee('Leadership Role Milestone');
    }

    public function test_journey_timeline_autoplay_and_navigation_controls(): void
    {
        $type = ExperienceType::factory()->create(['is_active' => true]);
        $org = Organization::factory()->create();

        Experience::factory()->count(3)->create([
            'experience_type_id' => $type->id,
            'organization_id' => $org->id,
            'status' => 'published',
            'visibility' => 'public',
        ]);

        Livewire::test(JourneyTimeline::class)
            ->assertSet('isPlaying', false)
            ->call('togglePlay')
            ->assertSet('isPlaying', true)
            ->assertSee('PAUSE JOURNEY')
            ->call('nextMilestone')
            ->assertSet('currentIndex', 1)
            ->call('nextMilestone')
            ->assertSet('currentIndex', 2)
            ->call('prevMilestone')
            ->assertSet('currentIndex', 1)
            ->call('stopPlay')
            ->assertSet('isPlaying', false)
            ->assertSet('currentIndex', 0);
    }
}
