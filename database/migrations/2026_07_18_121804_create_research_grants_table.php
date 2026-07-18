<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('research_grants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opportunity_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('research_area')->nullable();
            $table->enum('grant_type', ['individual', 'group', 'project'])->default('individual');
            $table->decimal('max_funding', 15, 2)->nullable();
            $table->unsignedTinyInteger('min_duration_months')->nullable();
            $table->unsignedTinyInteger('max_duration_months')->nullable();
            $table->boolean('requires_proposal')->default(true);
            $table->boolean('requires_supervisor')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('research_grants');
    }
};