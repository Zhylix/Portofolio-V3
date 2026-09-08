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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('institution');
            $table->string('slug')->unique();
            $table->string('degree')->nullable();
            $table->string('major')->nullable();
            $table->text('description')->nullable();
            $table->date('started_at')->nullable()->index();
            $table->date('ended_at')->nullable()->index();
            $table->boolean('is_current')->default(false);
            $table->string('logo')->nullable();
            $table->integer('sort_order')->default(0)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
