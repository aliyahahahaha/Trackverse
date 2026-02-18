<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run PermissionSeeder first
        $this->call(PermissionSeeder::class);

        // Create default users
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@trackverse.com',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Team Leader',
            'email' => 'leader@trackverse.com',
            'role' => 'team_leader',
        ]);

        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@trackverse.com',
            'role' => 'user',
        ]);

        // Run other seeders
        $this->call([
            MemberAvailabilitySeeder::class,
            VerificationSeeder::class,
        ]);
    }
}
