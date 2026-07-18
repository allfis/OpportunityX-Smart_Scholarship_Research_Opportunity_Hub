<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('university', 200)->nullable();
            $table->string('department', 150)->nullable();
            $table->string('designation', 100)->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_picture_path')->nullable();
            $table->string('specialization')->nullable();
            $table->string('website_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faculties');
    }
};