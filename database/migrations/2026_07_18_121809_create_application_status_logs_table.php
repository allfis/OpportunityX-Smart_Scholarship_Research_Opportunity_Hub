<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('application_status_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained()->cascadeOnDelete();
            $table->string('old_status', 50)->nullable();
            $table->string('new_status', 50);
            // Who changed it — NULL means system/trigger changed it
            $table->foreignId('changed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('application_id');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_status_logs');
    }
};