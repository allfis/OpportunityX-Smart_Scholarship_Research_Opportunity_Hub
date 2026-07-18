<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            // SET NULL — category delete হলে opportunity থাকবে, category শুধু null হবে
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            // SET NULL — country delete হলে opportunity থাকবে
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            // CASCADE — faculty user deleted হলে তার posted opportunities-ও মুছে যাবে
            $table->foreignId('posted_by')->constrained('users')->cascadeOnDelete();
            // Type: which sub-table has the details
            $table->enum('type', ['scholarship', 'research_grant', 'internship', 'fellowship', 'competition']);
            $table->enum('status', ['active', 'draft', 'closed', 'expired'])->default('active');
            $table->dateTime('deadline')->nullable();
            $table->decimal('funding_amount', 15, 2)->nullable();
            $table->string('funding_currency', 5)->default('USD');
            $table->enum('funding_type', ['full', 'partial', 'none'])->default('none');
            $table->enum('degree_level', ['undergraduate', 'masters', 'phd', 'postdoc', 'any'])->default('any');
            // JSON for flexible eligibility criteria
            $table->json('eligibility_criteria')->nullable();
            $table->string('apply_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('views_count')->default(0);
            $table->timestamps();

            // Indexes for filter queries
            $table->index('type');
            $table->index('status');
            $table->index('degree_level');
            $table->index('funding_type');
            $table->index('deadline');
            $table->index('is_featured');
            $table->index(['type', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};