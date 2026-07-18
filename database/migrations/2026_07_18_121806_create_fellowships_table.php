<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fellowships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opportunity_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('fellowship_provider')->nullable();
            $table->unsignedTinyInteger('duration_months')->nullable();
            $table->boolean('includes_stipend')->default(false);
            $table->boolean('includes_research_funding')->default(false);
            $table->boolean('includes_mentorship')->default(false);
            $table->boolean('requires_publication')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fellowships');
    }
};