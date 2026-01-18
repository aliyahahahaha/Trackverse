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
            [
                'id' => 1,
                'name' => 'Create Projects',
                'description' => 'Can create new projects',
                'roles' => ['admin' => true, 'team_leader' => true, 'user' => false]
            ],
            [
                'id' => 2,
                'name' => 'Delete Projects',
                'description' => 'Can remove existing projects',
                'roles' => ['admin' => true, 'team_leader' => false, 'user' => false]
            ],
            [
                'id' => 3,
                'name' => 'Manage Users',
                'description' => 'Can add or remove users',
                'roles' => ['admin' => true, 'team_leader' => false, 'user' => false]
            ],
            [
                'id' => 4,
                'name' => 'View Reports',
                'description' => 'Access to analytics and reports',
                'roles' => ['admin' => true, 'team_leader' => true, 'user' => true]
            ],
            [
                'id' => 5,
                'name' => 'Edit Tasks',
                'description' => 'Can modify task details',
                'roles' => ['admin' => true, 'team_leader' => true, 'user' => true]
            ],
            [
                'id' => 6,
                'name' => 'Manage Roles',
                'description' => 'Can change user roles',
                'roles' => ['admin' => true, 'team_leader' => false, 'user' => false]
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
