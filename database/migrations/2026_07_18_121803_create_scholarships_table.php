<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            // CASCADE — opportunity মুছলে scholarship details-ও মুছে যাবে
            $table->foreignId('opportunity_id')->unique()->constrained()->cascadeOnDelete();
            $table->enum('scholarship_type', ['merit', 'need', 'research', 'sports', 'other'])->default('merit');
            $table->decimal('min_cgpa', 4, 2)->nullable();
            $table->json('required_departments')->nullable();
            $table->decimal('gpa_scale', 3, 1)->default(4.0);
            $table->boolean('covers_tuition')->default(false);
            $table->boolean('covers_living')->default(false);
            $table->boolean('covers_travel')->default(false);
            $table->boolean('covers_insurance')->default(false);
            $table->text('additional_benefits')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};