<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            // One-to-one with users — CASCADE DELETE means if user deleted, student profile also deleted
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('university', 200)->nullable();
            $table->string('department', 150)->nullable();
            $table->decimal('cgpa', 4, 2)->nullable();
            $table->decimal('gpa_scale', 3, 1)->default(4.0);
            $table->unsignedTinyInteger('current_semester')->nullable();
            $table->json('skills')->nullable();
            $table->json('research_interests')->nullable();
            $table->json('achievements')->nullable();
            $table->string('resume_path')->nullable();
            $table->string('profile_picture_path')->nullable();
            $table->text('bio')->nullable();
            $table->string('phone', 20)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            // This will be auto-calculated by trigger
            $table->unsignedTinyInteger('profile_completion_percentage')->default(0);
            $table->timestamps();

            // Index for faster CGPA-based eligibility queries
            $table->index('cgpa');
            $table->index('department');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};