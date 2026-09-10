<?php

namespace Tests\Feature;

use App\Filament\Resources\Achievements\Pages\CreateAchievement;
use App\Filament\Resources\Certificates\Pages\CreateCertificate;
use App\Models\Achievement;
use App\Models\Article;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Project;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PhaseSixFinalPolishTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_404_error_page_renders_custom_developer_layout(): void
    {
        $response = $this->get('/unmapped-system-route-diagnostic-test');

        $response->assertStatus(404);
        $response->assertSee('404');
        $response->assertSee('Route Unmapped in System Cluster');
        $response->assertSee('ERR_ROUTE_NOT_FOUND');
        $response->assertSee('Return to Home');
    }

    public function test_error_views_render_cleanly(): void
    {
        $view403 = view('errors.403')->render();
        $this->assertStringContainsString('403', $view403);
        $this->assertStringContainsString('Subsystem Access Restricted', $view403);

        $view419 = view('errors.419')->render();
        $this->assertStringContainsString('419', $view419);
        $this->assertStringContainsString('Security Token Expired', $view419);
        $this->assertStringContainsString('Reload Session', $view419);

        $view429 = view('errors.429')->render();
        $this->assertStringContainsString('429', $view429);
        $this->assertStringContainsString('Traffic Rate Limit Triggered', $view429);

        $view500 = view('errors.500')->render();
        $this->assertStringContainsString('500', $view500);
        $this->assertStringContainsString('Internal Server State Anomaly', $view500);
    }

    public function test_empty_states_render_gracefully_without_crashing(): void
    {
        // Clear projects and check index
        Project::query()->delete();
        $projectsResponse = $this->get('/projects');
        $projectsResponse->assertStatus(200);
        $projectsResponse->assertSee('No Projects Found');

        // Clear certificates and check index
        Certificate::query()->delete();
        $certsResponse = $this->get('/certificates');
        $certsResponse->assertStatus(200);
        $certsResponse->assertSee('No certificates loaded in database');

        // Clear achievements and check index
        Achievement::query()->delete();
        $achResponse = $this->get('/achievements');
        $achResponse->assertStatus(200);
        $achResponse->assertSee('No achievements currently recorded in database');
    }

    public function test_project_detail_page_renders_with_relations(): void
    {
        $project = Project::firstOrFail();

        $response = $this->get('/projects/'.$project->slug);

        $response->assertStatus(200);
        $response->assertSee($project->title);
        if ($project->category) {
            $response->assertSee($project->category->name);
        }
    }

    public function test_decommissioned_journey_detail_page_returns_404(): void
    {
        $experience = Experience::firstOrFail();

        $response = $this->get('/journey/'.$experience->slug);

        $response->assertStatus(404);
    }

    public function test_decommissioned_article_detail_page_returns_404(): void
    {
        $article = Article::firstOrFail();

        $response = $this->get('/articles/'.$article->slug);

        $response->assertStatus(404);
    }

    public function test_admin_can_create_certificate_via_filament(): void
    {
        $user = User::first() ?? User::factory()->create();
        $this->actingAs($user);
        Filament::setCurrentPanel(Filament::getPanel('admin'));

        Livewire::test(CreateCertificate::class)
            ->fillForm([
                'title' => 'CKA Certified Kubernetes Administrator',
                'slug' => 'cka-certified-kubernetes-administrator',
                'issuer' => 'Linux Foundation',
                'credential_id' => 'CKA-99410-X',
                'issued_at' => '2025-06-01',
                'featured' => true,
                'sort_order' => 1,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('certificates', [
            'slug' => 'cka-certified-kubernetes-administrator',
            'issuer' => 'Linux Foundation',
        ]);
    }

    public function test_admin_can_create_achievement_via_filament(): void
    {
        $user = User::first() ?? User::factory()->create();
        $this->actingAs($user);
        Filament::setCurrentPanel(Filament::getPanel('admin'));

        Livewire::test(CreateAchievement::class)
            ->fillForm([
                'title' => '1st Place National Distributed Systems Hackathon',
                'slug' => '1st-place-national-distributed-systems',
                'organization' => 'National Ministry of Communication & Tech',
                'featured' => true,
                'sort_order' => 1,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('achievements', [
            'slug' => '1st-place-national-distributed-systems',
            'organization' => 'National Ministry of Communication & Tech',
        ]);
    }
}
