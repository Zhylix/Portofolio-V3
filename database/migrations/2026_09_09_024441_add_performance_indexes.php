<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Pivot table reverse lookups
        Schema::table('experience_project', function (Blueprint $table) {
            $table->index('project_id');
        });

        Schema::table('experience_skill', function (Blueprint $table) {
            $table->index('skill_id');
        });

        Schema::table('experience_achievement', function (Blueprint $table) {
            $table->index('achievement_id');
        });

        Schema::table('experience_certificate', function (Blueprint $table) {
            $table->index('certificate_id');
        });

        Schema::table('experience_event', function (Blueprint $table) {
            $table->index('event_id');
        });

        Schema::table('project_technology', function (Blueprint $table) {
            $table->index('technology_id');
        });

        Schema::table('project_skill', function (Blueprint $table) {
            $table->index('skill_id');
        });

        Schema::table('project_achievement', function (Blueprint $table) {
            $table->index('achievement_id');
        });

        Schema::table('achievement_skill', function (Blueprint $table) {
            $table->index('skill_id');
        });

        Schema::table('certificate_skill', function (Blueprint $table) {
            $table->index('skill_id');
        });

        Schema::table('article_skill', function (Blueprint $table) {
            $table->index('skill_id');
        });

        Schema::table('article_project', function (Blueprint $table) {
            $table->index('project_id');
        });

        Schema::table('article_experience', function (Blueprint $table) {
            $table->index('experience_id');
        });

        // Composite performance indexes
        Schema::table('articles', function (Blueprint $table) {
            $table->index(['status', 'published_at']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->index(['featured', 'sort_order']);
        });

        Schema::table('experiences', function (Blueprint $table) {
            $table->index(['featured', 'sort_order']);
        });

        Schema::table('skills', function (Blueprint $table) {
            $table->index(['featured', 'sort_order']);
        });

        Schema::table('certificates', function (Blueprint $table) {
            $table->index(['featured', 'sort_order']);
        });

        Schema::table('achievements', function (Blueprint $table) {
            $table->index(['featured', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('achievements', fn (Blueprint $table) => $table->dropIndex(['featured', 'sort_order']));
        Schema::table('certificates', fn (Blueprint $table) => $table->dropIndex(['featured', 'sort_order']));
        Schema::table('skills', fn (Blueprint $table) => $table->dropIndex(['featured', 'sort_order']));
        Schema::table('experiences', fn (Blueprint $table) => $table->dropIndex(['featured', 'sort_order']));
        Schema::table('projects', fn (Blueprint $table) => $table->dropIndex(['featured', 'sort_order']));
        Schema::table('articles', fn (Blueprint $table) => $table->dropIndex(['status', 'published_at']));

        Schema::table('article_experience', fn (Blueprint $table) => $table->dropIndex(['experience_id']));
        Schema::table('article_project', fn (Blueprint $table) => $table->dropIndex(['project_id']));
        Schema::table('article_skill', fn (Blueprint $table) => $table->dropIndex(['skill_id']));
        Schema::table('certificate_skill', fn (Blueprint $table) => $table->dropIndex(['skill_id']));
        Schema::table('achievement_skill', fn (Blueprint $table) => $table->dropIndex(['skill_id']));
        Schema::table('project_achievement', fn (Blueprint $table) => $table->dropIndex(['achievement_id']));
        Schema::table('project_skill', fn (Blueprint $table) => $table->dropIndex(['skill_id']));
        Schema::table('project_technology', fn (Blueprint $table) => $table->dropIndex(['technology_id']));
        Schema::table('experience_event', fn (Blueprint $table) => $table->dropIndex(['event_id']));
        Schema::table('experience_certificate', fn (Blueprint $table) => $table->dropIndex(['certificate_id']));
        Schema::table('experience_achievement', fn (Blueprint $table) => $table->dropIndex(['achievement_id']));
        Schema::table('experience_skill', fn (Blueprint $table) => $table->dropIndex(['skill_id']));
        Schema::table('experience_project', fn (Blueprint $table) => $table->dropIndex(['project_id']));
    }
};
