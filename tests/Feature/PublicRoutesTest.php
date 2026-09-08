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
        $homeResponse->assertSee('FEATURED PROJECTS');
        $homeResponse->assertSee('MY JOURNEY');

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

        // 5. Journey Index
        $journeyResponse = $this->get('/journey');
        $journeyResponse->assertStatus(200);
        $journeyResponse->assertSee($experience->title);

        // 6. Journey Show
        $journeyShowResponse = $this->get('/journey/'.$experience->slug);
        $journeyShowResponse->assertStatus(200);
        $journeyShowResponse->assertSee($experience->title);

        // 7. Skills Index
        $skillsResponse = $this->get('/skills');
        $skillsResponse->assertStatus(200);

        // 8. Certificates Index
        $certsResponse = $this->get('/certificates');
        $certsResponse->assertStatus(200);

        // 9. Achievements Index
        $achResponse = $this->get('/achievements');
        $achResponse->assertStatus(200);

        // 10. Articles Index
        $articlesResponse = $this->get('/articles');
        $articlesResponse->assertStatus(200);
        $articlesResponse->assertSee($article->title);

        // 11. Articles Show
        $articleShowResponse = $this->get('/articles/'.$article->slug);
        $articleShowResponse->assertStatus(200);
        $articleShowResponse->assertSee($article->title);

        // 12. Contact Index
        $contactResponse = $this->get('/contact');
        $contactResponse->assertStatus(200);
        $contactResponse->assertSee('What are you looking for?');
        $contactResponse->assertSee('Collaboration');
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
