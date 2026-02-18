<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;

class VerificationSeeder extends Seeder
{
    public function run(): void
    {
        // Create User
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create Project
        // $project = Project::create([
        //     'name' => 'Test Project',
        //     'description' => 'A test project',
        //     'status' => 'active',
        //     'created_by' => $user->id,
        // ]);

        // Assign User to Project
        // $project->members()->attach($user->id);

        // Create Task
        // $task = Task::create([
        //     'project_id' => $project->id,
        //     'name' => 'Test Task',
        //     'status' => 'pending',
        //     'assigned_to' => $user->id,
        //     'due_date' => now()->addDays(7),
        // ]);

        // Verify Relationships
    }
}
