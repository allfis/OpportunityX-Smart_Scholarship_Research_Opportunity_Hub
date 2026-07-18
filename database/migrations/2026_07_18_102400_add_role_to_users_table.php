<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // role column: admin, student, faculty — default 'student'
            $table->enum('role', ['admin', 'student', 'faculty'])
                  ->default('student')
                  ->after('email');

            // is_active: account active আছে কিনা
            $table->boolean('is_active')->default(true)->after('role');

            // Index for faster role-based queries
            $table->index('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropColumn(['role', 'is_active']);
        });
    }
};