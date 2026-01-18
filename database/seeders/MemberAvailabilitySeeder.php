<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberAvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::where('email', 'admin@trackverse.com')->first();
        $leader = \App\Models\User::where('email', 'leader@trackverse.com')->first();
        $user = \App\Models\User::where('email', 'user@trackverse.com')->first();

        $today = now()->toDateString();

        if ($admin) {
            \App\Models\MemberAvailability::updateOrCreate(
                ['user_id' => $admin->id, 'date' => $today],
                ['status' => 'present']
            );
        }

        if ($leader) {
            \App\Models\MemberAvailability::updateOrCreate(
                ['user_id' => $leader->id, 'date' => $today],
                ['status' => 'medical_leave']
            );
        }

        if ($user) {
            \App\Models\MemberAvailability::updateOrCreate(
                ['user_id' => $user->id, 'date' => $today],
                ['status' => 'vacation']
            );
        }
    }
}
