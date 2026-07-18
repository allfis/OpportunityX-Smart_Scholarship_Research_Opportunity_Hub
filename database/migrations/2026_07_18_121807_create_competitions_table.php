<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opportunity_id')->unique()->constrained()->cascadeOnDelete();
            $table->enum('competition_type', ['hackathon', 'olympiad', 'debate', 'project', 'essay', 'other'])->default('hackathon');
            $table->unsignedTinyInteger('team_size_min')->default(1);
            $table->unsignedTinyInteger('team_size_max')->default(4);
            $table->json('prizes')->nullable();
            $table->unsignedTinyInteger('rounds')->default(1);
            $table->boolean('requires_registration_fee')->default(false);
            $table->decimal('registration_fee_amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('competitions');
    }
};