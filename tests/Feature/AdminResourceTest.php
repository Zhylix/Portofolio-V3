<?php

namespace Tests\Feature;

use App\Enums\ContentStatus;
use App\Enums\ProjectStatus;
use App\Filament\Resources\Articles\Pages\CreateArticle;
use App\Filament\Resources\Experiences\Pages\CreateExperience;
use App\Filament\Resources\Projects\Pages\CreateProject;
use App\Filament\Resources\Projects\Pages\EditProject;
use App\Filament\Resources\Skills\Pages\CreateSkill;
use App\Filament\Widgets\ContentHealthWidget;
use App\Filament\Widgets\DashboardHeroWidget;
use App\Filament\Widgets\LatestContactMessagesWidget;
use App\Filament\Widgets\PortfolioStatsOverview;
use App\Filament\Widgets\RecentActivityWidget;
use App\Filament\Widgets\RecentProjectsWidget;
use App\Models\ContactMessage;
use App\Models\ExperienceType;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\SkillCategory;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminResourceTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->user = User::first() ?? User::factory()->create();
        $this->actingAs($this->user);
        Filament::setCurrentPanel(Filament::getPanel('admin'));
    }

    public function test_can_create_project_via_filament_form(): void
    {
        $category = ProjectCategory::first();

        Livewire::test(CreateProject::class)
            ->fillForm([
                'title' => 'Filament 5 Automated Architecture',
                'slug' => 'filament-5-automated-architecture',
                'short_description' => 'Executive summary of project.',
                'description' => 'Full architectural breakdown and documentation.',
                'category_id' => $category->id,
                'status' => ProjectStatus::COMPLETED->value,
                'featured' => true,
                'sort_order' => 1,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('projects', [
            'slug' => 'filament-5-automated-architecture',
            'title' => 'Filament 5 Automated Architecture',
            'featured' => 1,
        ]);
    }

    public function test_can_update_project_via_filament_form(): void
    {
        $project = Project::first();

        Livewire::test(EditProject::class, ['record' => $project->getKey()])
            ->fillForm([
                'title' => 'Updated Project Title via Admin',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'title' => 'Updated Project Title via Admin',
        ]);
    }

    public function test_can_create_experience_via_filament_form(): void
    {
        $type = ExperienceType::first();

        Livewire::test(CreateExperience::class)
            ->fillForm([
                'experience_type_id' => $type->id,
                'title' => 'Principal Systems Architect',
                'slug' => 'principal-systems-architect-tech',
                'role' => 'Lead Architect',
                'summary' => 'Directing system evolution and microservices.',
                'description' => 'Detailed technical architecture review and outcomes.',
                'location' => 'Jakarta, Indonesia',
                'started_at' => '2025-01-01',
                'is_current' => true,
                'status' => ContentStatus::PUBLISHED->value,
                'visibility' => 'public',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('experiences', [
            'slug' => 'principal-systems-architect-tech',
            'role' => 'Lead Architect',
        ]);
    }

    public function test_can_create_skill_via_filament_form(): void
    {
        $category = SkillCategory::first();

        Livewire::test(CreateSkill::class)
            ->fillForm([
                'skill_category_id' => $category->id,
                'name' => 'Filament Admin Architecture',
                'slug' => 'filament-admin-architecture',
                'description' => 'Expertise in building scalable CMS panels with Filament 5.',
                'featured' => true,
                'sort_order' => 1,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('skills', [
            'slug' => 'filament-admin-architecture',
            'featured' => 1,
        ]);
    }

    public function test_can_create_article_via_filament_form(): void
    {
        Livewire::test(CreateArticle::class)
            ->fillForm([
                'title' => 'Mastering Filament 5 and Laravel 13',
                'slug' => 'mastering-filament-5-laravel-13',
                'excerpt' => 'A comprehensive guide to building modular portfolio CMS.',
                'content' => 'Deep dive into Filament 5 schemas, relations, and Spatie Media Library.',
                'category' => 'Engineering',
                'status' => ContentStatus::PUBLISHED->value,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('articles', [
            'slug' => 'mastering-filament-5-laravel-13',
            'category' => 'Engineering',
        ]);
    }

    public function test_admin_can_view_contact_messages_and_dashboard_widgets(): void
    {
        ContactMessage::create([
            'name' => 'Alice Recruiter',
            'email' => 'alice@recruiting.com',
            'subject' => 'Executive Opportunity',
            'message' => 'Hello Helmy, we would love to discuss a leadership role.',
            'status' => 'unread',
        ]);

        $response = $this->get('/admin/contact-messages');
        $response->assertStatus(200);
        $response->assertSee('Alice Recruiter');
        $response->assertSee('alice@recruiting.com');

        Livewire::test(PortfolioStatsOverview::class)
            ->assertSuccessful();

        Livewire::test(LatestContactMessagesWidget::class)
            ->assertSuccessful()
            ->assertSee('Alice Recruiter');

        Livewire::test(DashboardHeroWidget::class)
            ->assertSuccessful()
            ->assertSee('Welcome back');

        Livewire::test(RecentProjectsWidget::class)
            ->assertSuccessful()
            ->assertSee('Recent Projects');

        Livewire::test(ContentHealthWidget::class)
            ->assertSuccessful()
            ->assertSee('Content Health');

        Livewire::test(RecentActivityWidget::class)
            ->assertSuccessful()
            ->assertSee('Recent Activity');
    }
}
