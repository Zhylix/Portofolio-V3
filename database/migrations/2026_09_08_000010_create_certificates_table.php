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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('issuer');
            $table->string('credential_id')->nullable();
            $table->text('description')->nullable();
            $table->date('issued_at')->nullable()->index();
            $table->date('expires_at')->nullable()->index();
            $table->string('credential_url')->nullable();
            $table->string('image')->nullable();
            $table->boolean('featured')->default(false)->index();
            $table->integer('sort_order')->default(0)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
