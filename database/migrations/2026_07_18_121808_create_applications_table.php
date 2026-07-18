<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            // CASCADE — opportunity মুছলে applications-ও মুছে যাবে
            $table->foreignId('opportunity_id')->constrained()->cascadeOnDelete();
            // CASCADE — student মুছলে applications-ও মুছে যাবে
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['applied', 'under_review', 'shortlisted', 'accepted', 'rejected', 'withdrawn'])->default('applied');
            $table->text('cover_letter')->nullable();
            $table->timestamp('applied_at')->nullable();
            $table->timestamps();

            // A student can apply to an opportunity only once
            $table->unique(['opportunity_id', 'student_id']);
            // Indexes for status-based queries
            $table->index('status');
            $table->index(['student_id', 'status']);
            $table->index(['opportunity_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};