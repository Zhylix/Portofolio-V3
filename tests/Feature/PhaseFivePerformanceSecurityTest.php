<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Services\ProfileService;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class PhaseFivePerformanceSecurityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_security_headers_are_present_on_web_requests(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('X-XSS-Protection', '1; mode=block');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
    }

    public function test_contact_form_blocks_honeypot_bot_submissions(): void
    {
        $botPayload = [
            'name' => 'Spam Bot',
            'email' => 'spambot@example.com',
            'subject' => 'Buy Crypto Cheap',
            'message' => 'Visit my scam link now for free coins!',
            'website_hp' => 'http://spam-link.com', // Honeypot filled by bot
        ];

        $response = $this->post('/contact', $botPayload);

        $response->assertSessionHasErrors(['website_hp']);
        $this->assertDatabaseMissing('contact_messages', [
            'email' => 'spambot@example.com',
        ]);
    }

    public function test_dynamic_sitemap_xml_generation(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml');

        $content = $response->getContent();
        $this->assertStringContainsString('<?xml version="1.0" encoding="UTF-8"?>', $content);
        $this->assertStringContainsString('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', $content);
        $this->assertStringContainsString(route('home'), $content);
        $this->assertStringContainsString(route('projects.index'), $content);
        $this->assertStringContainsString(route('skills.index'), $content);
        $this->assertStringContainsString(route('certificates.index'), $content);
        $this->assertStringContainsString(route('achievements.index'), $content);
        $this->assertStringNotContainsString('/journey', $content);
        $this->assertStringNotContainsString('/articles', $content);
    }

    public function test_structured_data_json_ld_is_rendered(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('application/ld+json', false);
        $response->assertSee('"@type": "Person"', false);
        $response->assertSee('"@type": "WebSite"', false);
        $response->assertSee('Helmy Yunan Nasution', false);
    }

    public function test_search_scout_across_multiple_domains(): void
    {
        $response = $this->get('/search?q=Helmy');

        $response->assertStatus(200);
        $response->assertViewHas('projects');
        $response->assertViewHas('skills');
        $response->assertViewHas('certificates');
        $response->assertViewHas('achievements');
    }

    public function test_search_type_filtering_and_pagination(): void
    {
        $response = $this->get('/search?q=Helmy&type=projects');

        $response->assertStatus(200);
        $response->assertViewHas('paginatedResults');
    }

    public function test_cache_invalidation_on_profile_update(): void
    {
        // Cache the profile
        $profileService = app(ProfileService::class);
        $cachedProfile = $profileService->getProfile();
        $this->assertNotNull($cachedProfile);
        $this->assertTrue(Cache::has('portfolio.profile'));

        // Update profile
        $cachedProfile->update(['headline' => 'Updated Chief Architect']);

        // Cache must be invalidated
        $this->assertFalse(Cache::has('portfolio.profile'));
    }

    public function test_profile_service_heals_incomplete_class_in_cache(): void
    {
        $incompleteClass = unserialize(serialize(new \stdClass), ['allowed_classes' => false]);
        $this->assertInstanceOf(\__PHP_Incomplete_Class::class, $incompleteClass);

        Cache::put('portfolio.profile', $incompleteClass);

        $profileService = app(ProfileService::class);
        $profile = $profileService->getProfile();

        $this->assertInstanceOf(Profile::class, $profile);
        $this->assertFalse(Cache::get('portfolio.profile') instanceof \__PHP_Incomplete_Class);
    }

    public function test_cache_serializable_classes_allows_domain_models(): void
    {
        config(['cache.default' => 'database']);
        Cache::purge('database');

        $profile = Profile::first();
        Cache::driver('database')->put('test.profile', $profile, 60);

        $retrieved = Cache::driver('database')->get('test.profile');
        $this->assertInstanceOf(Profile::class, $retrieved);
        $this->assertSame($profile->id, $retrieved->id);
    }

    public function test_public_projects_index_is_paginated(): void
    {
        $response = $this->get('/projects');

        $response->assertStatus(200);
        $response->assertViewHas('projects');
        $projects = $response->viewData('projects');
        $this->assertInstanceOf(LengthAwarePaginator::class, $projects);
    }

    public function test_decommissioned_articles_and_journey_routes_return_404(): void
    {
        $this->get('/articles')->assertStatus(404);
        $this->get('/journey')->assertStatus(404);
    }

    public function test_public_certificates_index_is_paginated(): void
    {
        $response = $this->get('/certificates');

        $response->assertStatus(200);
        $response->assertViewHas('certificates');
        $certificates = $response->viewData('certificates');
        $this->assertInstanceOf(LengthAwarePaginator::class, $certificates);
    }

    public function test_public_achievements_index_is_paginated(): void
    {
        $response = $this->get('/achievements');

        $response->assertStatus(200);
        $response->assertViewHas('achievements');
        $achievements = $response->viewData('achievements');
        $this->assertInstanceOf(LengthAwarePaginator::class, $achievements);
    }
}
