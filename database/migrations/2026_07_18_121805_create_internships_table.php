<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opportunity_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('company_name')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->decimal('stipend_amount', 15, 2)->nullable();
            $table->string('stipend_currency', 5)->default('USD');
            $table->unsignedTinyInteger('duration_months')->nullable();
            $table->boolean('remote_allowed')->default(false);
            $table->string('location')->nullable();
            $table->json('required_skills')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('internships');
    }
};