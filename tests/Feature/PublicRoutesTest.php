<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Experience;
use App\Models\Project;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_all_twelve_public_routes_return_successful_response(): void
    {
        $project = Project::firstOrFail();
        $experience = Experience::firstOrFail();
        $article = Article::firstOrFail();

        // 1. Homepage
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Helmy Yunan Nasution');
        $homeResponse->assertSee('PROJECTS');
        $homeResponse->assertDontSee('MY JOURNEY');

        // 2. About
        $aboutResponse = $this->get('/about');
        $aboutResponse->assertStatus(200);
        $aboutResponse->assertSee('Helmy Yunan Nasution');

        // 3. Projects Index
        $projectsResponse = $this->get('/projects');
        $projectsResponse->assertStatus(200);
        $projectsResponse->assertSee($project->title);

        // 4. Projects Show
        $projectShowResponse = $this->get('/projects/'.$project->slug);
        $projectShowResponse->assertStatus(200);
        $projectShowResponse->assertSee($project->title);

        // 5. Skills Index
        $skillsResponse = $this->get('/skills');
        $skillsResponse->assertStatus(200);

        // 6. Certificates Index
        $certsResponse = $this->get('/certificates');
        $certsResponse->assertStatus(200);

        // 7. Achievements Index
        $achResponse = $this->get('/achievements');
        $achResponse->assertStatus(200);

        // 8. Contact Index
        $contactResponse = $this->get('/contact');
        $contactResponse->assertStatus(200);
        $contactResponse->assertSee('What are you looking for?');
        $contactResponse->assertSee('Collaboration');

        // 9. Decommissioned routes strictly return 404
        $this->get('/journey')->assertStatus(404);
        $this->get('/journey/'.$experience->slug)->assertStatus(404);
        $this->get('/articles')->assertStatus(404);
        $this->get('/articles/'.$article->slug)->assertStatus(404);
    }

    public function test_contact_form_submission_with_new_type_options(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Edward Tech Lead',
            'email' => 'edward@enterprise.org',
            'type' => 'website',
            'subject' => 'New Scalable Cloud Architecture',
            'message' => 'We are interested in your engineering services for an upcoming high-scale cloud project.',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'edward@enterprise.org',
            'type' => 'website',
        ]);
    }
}
