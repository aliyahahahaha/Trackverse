<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'team_leader', 'user', 'director') NOT NULL DEFAULT 'user'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Warning: This could result in data loss if any users have the 'director' role
        DB::table('users')->where('role', 'director')->update(['role' => 'user']);

        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'team_leader', 'user') NOT NULL DEFAULT 'user'");
    }
};
