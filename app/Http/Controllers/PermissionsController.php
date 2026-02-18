<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = [
            ['name' => 'Admin', 'key' => 'admin', 'color' => 'primary'],
            ['name' => 'Director', 'key' => 'director', 'color' => 'warning'],
            ['name' => 'Team Leader', 'key' => 'team_leader', 'color' => 'secondary'],
            ['name' => 'User', 'key' => 'user', 'color' => 'info']
        ];

        // Gather permissions from Config
        $groups = config('permissions.groups');
        $permissions = [];

        foreach ($groups as $group) {
            foreach ($group['permissions'] as $key => $details) {
                // Determine current active roles for this permission
                $activeRoles = \App\Models\RolePermission::where('permission', $key)
                    ->pluck('role')
                    ->toArray();

                $rolesState = [];
                foreach ($roles as $role) {
                    $rolesState[$role['key']] = in_array($role['key'], $activeRoles);
                }

                $permissions[] = [
                    'id' => $key, // Using slug as ID
                    'name' => $details['name'],
                    'description' => $details['description'],
                    'roles' => $rolesState
                ];
            }
        }

        return view('permissions.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = [
            ['name' => 'Admin', 'key' => 'admin', 'color' => 'primary'],
            ['name' => 'Director', 'key' => 'director', 'color' => 'warning'],
            ['name' => 'Team Leader', 'key' => 'team_leader', 'color' => 'secondary'],
            ['name' => 'User', 'key' => 'user', 'color' => 'info']
        ];

        return view('permissions.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'roles' => 'nullable|array',
            'roles.*' => 'in:admin,director,team_leader,user'
        ]);

        // Generate permission key from name (lowercase, underscores)
        $permissionKey = strtolower(str_replace(' ', '_', $validated['name']));

        // Check if permission already exists in config
        $groups = config('permissions.groups');
        foreach ($groups as $group) {
            if (isset($group['permissions'][$permissionKey])) {
                return redirect()->back()->withErrors(['name' => 'A permission with this name already exists.'])->withInput();
            }
        }

        // Add to database for selected roles (Admin always gets all permissions)
        $rolesToAssign = $validated['roles'] ?? [];

        // Always add admin
        \App\Models\RolePermission::firstOrCreate([
            'role' => 'admin',
            'permission' => $permissionKey
        ]);

        // Add other selected roles
        foreach ($rolesToAssign as $roleKey => $value) {
            if ($roleKey !== 'admin') {
                \App\Models\RolePermission::firstOrCreate([
                    'role' => $roleKey,
                    'permission' => $permissionKey
                ]);
            }
        }

        // Note: In a production environment, you would also update the config/permissions.php file
        // This could be done by writing to the file or using a database-driven permission system
        // For now, we're just adding to the role_permissions table

        return redirect()->route('permissions.index')->with('success', 'Permission added to database successfully! To make it appear in the list, please add it to config/permissions.php manually.');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Expecting input: permissions[perm_key][role_key] = "on" (if checked)
        $input = $request->input('permissions', []);

        // Get all possible permissions to ensure we can turn OFF unchecked ones
        $allPermissions = [];
        $groups = config('permissions.groups');
        foreach ($groups as $group) {
            foreach ($group['permissions'] as $key => $d) {
                $allPermissions[] = $key;
            }
        }

        $definedRoles = ['admin', 'director', 'team_leader', 'user'];

        foreach ($allPermissions as $permKey) {
            foreach ($definedRoles as $roleKey) {
                // Admin always has all permissions (business rule protection)
                if ($roleKey === 'admin') {
                    \App\Models\RolePermission::firstOrCreate([
                        'role' => 'admin',
                        'permission' => $permKey
                    ]);
                    continue;
                }

                $shouldHave = isset($input[$permKey][$roleKey]);

                if ($shouldHave) {
                    \App\Models\RolePermission::firstOrCreate([
                        'role' => $roleKey,
                        'permission' => $permKey
                    ]);
                } else {
                    \App\Models\RolePermission::where('role', $roleKey)
                        ->where('permission', $permKey)
                        ->delete();
                }
            }
        }

        return redirect()->route('permissions.index')->with('success', 'Permissions updated successfully.');
    }
}
