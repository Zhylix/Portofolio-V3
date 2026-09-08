<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\Article;
use App\Models\Certificate;
use App\Models\Education;
use App\Models\Event;
use App\Models\Experience;
use App\Models\ExperienceType;
use App\Models\Organization;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\SocialLink;
use App\Models\Technology;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeededDataAvailabilityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_seeded_data_fulfills_all_phase_1_requirements(): void
    {
        // 1. Profile
        $this->assertGreaterThanOrEqual(1, Profile::count());
        $profile = Profile::first();
        $this->assertEquals('Helmy Yunan Nasution', $profile->name);

        // 2. Skills & Technologies
        $this->assertGreaterThanOrEqual(5, Skill::count());
        $this->assertGreaterThanOrEqual(5, Technology::count());

        // 3. Projects
        $this->assertGreaterThanOrEqual(5, Project::count());

        // 4. Experiences & Experience Types
        $this->assertGreaterThanOrEqual(5, Experience::count());
        $this->assertEquals(20, ExperienceType::count());

        // 5. Achievements, Certificates & Education
        $this->assertGreaterThanOrEqual(2, Achievement::count());
        $this->assertGreaterThanOrEqual(2, Certificate::count());
        $this->assertGreaterThanOrEqual(2, Education::count());

        // 6. Organizations & Events
        $this->assertGreaterThanOrEqual(2, Organization::count());
        $this->assertGreaterThanOrEqual(2, Event::count());

        // 7. Articles & Services
        $this->assertGreaterThanOrEqual(3, Article::count());
        $this->assertGreaterThanOrEqual(3, Service::count());

        // 8. Social links & settings
        $this->assertGreaterThanOrEqual(3, SocialLink::count());
        $this->assertNotEmpty(Setting::get('site_name'));

        // 9. Ensure no Lorem Ipsum was seeded in projects or articles
        $this->assertStringNotContainsStringIgnoringCase('lorem ipsum', $profile->long_bio);
        foreach (Project::all() as $project) {
            $this->assertStringNotContainsStringIgnoringCase('lorem ipsum', $project->description);
        }
        foreach (Article::all() as $article) {
            $this->assertStringNotContainsStringIgnoringCase('lorem ipsum', $article->content);
        }
    }
}
