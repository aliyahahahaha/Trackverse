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
        // Mock Data for UI Demonstration
        $roles = [
            ['name' => 'Admin', 'key' => 'admin', 'color' => 'primary'],
            ['name' => 'Team Leader', 'key' => 'team_leader', 'color' => 'secondary'],
            ['name' => 'User', 'key' => 'user', 'color' => 'info']
        ];

        $permissions = [
            // Project Management
            [
                'id' => 1,
                'name' => 'View Projects',
                'description' => 'Can view project details',
                'roles' => ['admin' => true, 'team_leader' => true, 'user' => true]
            ],
            [
                'id' => 2,
                'name' => 'Create Projects',
                'description' => 'Can create new projects',
                'roles' => ['admin' => true, 'team_leader' => true, 'user' => false]
            ],
            [
                'id' => 3,
                'name' => 'Edit Projects',
                'description' => 'Can update project details',
                'roles' => ['admin' => true, 'team_leader' => true, 'user' => false]
            ],
            [
                'id' => 4,
                'name' => 'Delete Projects',
                'description' => 'Can remove existing projects',
                'roles' => ['admin' => true, 'team_leader' => false, 'user' => false]
            ],

            // Task Management
            [
                'id' => 5,
                'name' => 'Create Tasks',
                'description' => 'Can assign new tasks',
                'roles' => ['admin' => true, 'team_leader' => true, 'user' => true]
            ],
            [
                'id' => 6,
                'name' => 'Edit Tasks',
                'description' => 'Can modify task details',
                'roles' => ['admin' => true, 'team_leader' => true, 'user' => true]
            ],
            [
                'id' => 7,
                'name' => 'Delete Tasks',
                'description' => 'Can remove tasks',
                'roles' => ['admin' => true, 'team_leader' => true, 'user' => false]
            ],

            // Ticket Management
            [
                'id' => 8,
                'name' => 'Create Tickets',
                'description' => 'Can raise support tickets',
                'roles' => ['admin' => true, 'team_leader' => true, 'user' => true]
            ],
            [
                'id' => 9,
                'name' => 'Resolve Tickets',
                'description' => 'Can mark tickets as resolved',
                'roles' => ['admin' => true, 'team_leader' => true, 'user' => false]
            ],
            [
                'id' => 10,
                'name' => 'Delete Tickets',
                'description' => 'Can permanently remove tickets',
                'roles' => ['admin' => true, 'team_leader' => false, 'user' => false]
            ],

            // User Management
            [
                'id' => 11,
                'name' => 'Manage Users',
                'description' => 'Can add, edit, or remove users',
                'roles' => ['admin' => true, 'team_leader' => false, 'user' => false]
            ],
            [
                'id' => 12,
                'name' => 'Manage Roles',
                'description' => 'Can assign roles to users',
                'roles' => ['admin' => true, 'team_leader' => false, 'user' => false]
            ],

            // System Features
            [
                'id' => 13,
                'name' => 'Manage Announcements',
                'description' => 'Can post system-wide announcements',
                'roles' => ['admin' => true, 'team_leader' => false, 'user' => false]
            ],
            [
                'id' => 14,
                'name' => 'Manage Deployments',
                'description' => 'Access to deployment controls',
                'roles' => ['admin' => true, 'team_leader' => true, 'user' => false]
            ],
            [
                'id' => 15,
                'name' => 'View Reports',
                'description' => 'Access to analytics and system reports',
                'roles' => ['admin' => true, 'team_leader' => true, 'user' => false]
            ],
        ];

        return view('permissions.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = [
            ['name' => 'Admin', 'key' => 'admin', 'color' => 'primary'],
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
        // In a real app, this would validate and save to DB
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // In a real app, this would update the role-permission association
        return redirect()->route('permissions.index')->with('success', 'Permissions updated successfully.');
    }
}
