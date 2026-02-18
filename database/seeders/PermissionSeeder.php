<?php

namespace Database\Seeders;

use App\Models\RolePermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define default roles access
        $defaults = [
            'admin' => ['*'], // Semantic for 'all'
            'director' => ['view_projects', 'view_reports'],
            'team_leader' => [
                'view_projects',
                'create_projects',
                'edit_projects',
                'create_tasks',
                'edit_tasks',
                'delete_tasks',
                'create_tickets',
                'resolve_tickets',
                'view_reports' // Assuming TLs can view reports too
            ],
            'user' => [
                'view_projects',
                'update_task_status',
                'create_tickets'
            ]
        ];

        // Flatten config permissions to get all keys
        $allPermissions = [];
        $config = Config::get('permissions.groups');
        foreach ($config as $group) {
            foreach ($group['permissions'] as $key => $details) {
                $allPermissions[] = $key;
            }
        }

        foreach ($defaults as $role => $perms) {
            // Clear existing permissions for this role to ensure we only have what's in the seeder
            RolePermission::where('role', $role)->delete();

            $permissionsToGrant = [];

            if ($perms === ['*']) {
                $permissionsToGrant = $allPermissions;
            } else {
                $permissionsToGrant = $perms;
            }

            foreach ($permissionsToGrant as $perm) {
                // Ensure permission exists in our config (safety check)
                if (in_array($perm, $allPermissions)) {
                    RolePermission::firstOrCreate([
                        'role' => $role,
                        'permission' => $perm
                    ]);
                }
            }
        }
    }
}
