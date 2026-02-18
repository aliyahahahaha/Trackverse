<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Remove creation and full edit rights from 'user'
        DB::table('role_permissions')
            ->where('role', 'user')
            ->whereIn('permission', ['create_tasks', 'edit_tasks'])
            ->delete();

        // 2. Grant 'update_task_status' to relevant roles
        // We use insertOrIgnore to avoid duplicates if re-run (though SQLite/MySQL syntax varies, simpler to check first or just use insert)
        // Since we have a unique constraint, we can wrap in try-catch or use insertOrIgnore

        $roles = ['user', 'team_leader', 'admin'];
        foreach ($roles as $role) {
            $exists = DB::table('role_permissions')
                ->where('role', $role)
                ->where('permission', 'update_task_status')
                ->exists();

            if (!$exists) {
                DB::table('role_permissions')->insert([
                    'role' => $role,
                    'permission' => 'update_task_status',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore capabilities for user (optional fallback)
        DB::table('role_permissions')->insert([
            ['role' => 'user', 'permission' => 'create_tasks'],
            ['role' => 'user', 'permission' => 'edit_tasks'],
        ]);

        DB::table('role_permissions')
            ->where('permission', 'update_task_status')
            ->delete();
    }
};
