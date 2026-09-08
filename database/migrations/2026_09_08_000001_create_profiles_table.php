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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('headline');
            $table->text('short_bio')->nullable();
            $table->longText('long_bio')->nullable();
            $table->string('location')->nullable();
            $table->string('email')->nullable();
            $table->string('avatar')->nullable();
            $table->string('resume')->nullable();
            $table->string('availability')->nullable();
            $table->string('hero_label')->nullable();
            $table->text('hero_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
