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
        // 1. experience_project
        Schema::create('experience_project', function (Blueprint $table) {
            $table->foreignId('experience_id')->constrained('experiences')->cascadeOnDelete();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->primary(['experience_id', 'project_id']);
        });

        // 2. experience_skill
        Schema::create('experience_skill', function (Blueprint $table) {
            $table->foreignId('experience_id')->constrained('experiences')->cascadeOnDelete();
            $table->foreignId('skill_id')->constrained('skills')->cascadeOnDelete();
            $table->primary(['experience_id', 'skill_id']);
        });

        // 3. experience_achievement
        Schema::create('experience_achievement', function (Blueprint $table) {
            $table->foreignId('experience_id')->constrained('experiences')->cascadeOnDelete();
            $table->foreignId('achievement_id')->constrained('achievements')->cascadeOnDelete();
            $table->primary(['experience_id', 'achievement_id']);
        });

        // 4. experience_certificate
        Schema::create('experience_certificate', function (Blueprint $table) {
            $table->foreignId('experience_id')->constrained('experiences')->cascadeOnDelete();
            $table->foreignId('certificate_id')->constrained('certificates')->cascadeOnDelete();
            $table->primary(['experience_id', 'certificate_id']);
        });

        // 5. experience_event
        Schema::create('experience_event', function (Blueprint $table) {
            $table->foreignId('experience_id')->constrained('experiences')->cascadeOnDelete();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->primary(['experience_id', 'event_id']);
        });

        // 6. project_technology
        Schema::create('project_technology', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('technology_id')->constrained('technologies')->cascadeOnDelete();
            $table->primary(['project_id', 'technology_id']);
        });

        // 7. project_skill
        Schema::create('project_skill', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('skill_id')->constrained('skills')->cascadeOnDelete();
            $table->primary(['project_id', 'skill_id']);
        });

        // 8. project_achievement
        Schema::create('project_achievement', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('achievement_id')->constrained('achievements')->cascadeOnDelete();
            $table->primary(['project_id', 'achievement_id']);
        });

        // 9. achievement_skill
        Schema::create('achievement_skill', function (Blueprint $table) {
            $table->foreignId('achievement_id')->constrained('achievements')->cascadeOnDelete();
            $table->foreignId('skill_id')->constrained('skills')->cascadeOnDelete();
            $table->primary(['achievement_id', 'skill_id']);
        });

        // 10. certificate_skill
        Schema::create('certificate_skill', function (Blueprint $table) {
            $table->foreignId('certificate_id')->constrained('certificates')->cascadeOnDelete();
            $table->foreignId('skill_id')->constrained('skills')->cascadeOnDelete();
            $table->primary(['certificate_id', 'skill_id']);
        });

        // 11. article_skill
        Schema::create('article_skill', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained('articles')->cascadeOnDelete();
            $table->foreignId('skill_id')->constrained('skills')->cascadeOnDelete();
            $table->primary(['article_id', 'skill_id']);
        });

        // 12. article_project
        Schema::create('article_project', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained('articles')->cascadeOnDelete();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->primary(['article_id', 'project_id']);
        });

        // 13. article_experience
        Schema::create('article_experience', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained('articles')->cascadeOnDelete();
            $table->foreignId('experience_id')->constrained('experiences')->cascadeOnDelete();
            $table->primary(['article_id', 'experience_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_experience');
        Schema::dropIfExists('article_project');
        Schema::dropIfExists('article_skill');
        Schema::dropIfExists('certificate_skill');
        Schema::dropIfExists('achievement_skill');
        Schema::dropIfExists('project_achievement');
        Schema::dropIfExists('project_skill');
        Schema::dropIfExists('project_technology');
        Schema::dropIfExists('experience_event');
        Schema::dropIfExists('experience_certificate');
        Schema::dropIfExists('experience_achievement');
        Schema::dropIfExists('experience_skill');
        Schema::dropIfExists('experience_project');
    }
};
