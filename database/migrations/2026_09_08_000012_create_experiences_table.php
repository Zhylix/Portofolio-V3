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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('experience_type_id')->constrained('experience_types')->cascadeOnDelete();
            $table->foreignId('organization_id')->nullable()->constrained('organizations')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('role');
            $table->text('summary');
            $table->longText('description');
            $table->text('contribution')->nullable();
            $table->text('challenge')->nullable();
            $table->text('solution')->nullable();
            $table->text('outcome')->nullable();
            $table->string('location')->nullable();
            $table->date('started_at')->nullable()->index();
            $table->date('ended_at')->nullable()->index();
            $table->boolean('is_current')->default(false);
            $table->boolean('featured')->default(false)->index();
            $table->string('status')->default('published')->index();
            $table->integer('sort_order')->default(0)->index();
            $table->string('visibility')->default('public')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
