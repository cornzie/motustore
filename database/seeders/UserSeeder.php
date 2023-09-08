<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $manager = \App\Models\User::factory()->create([
            'name' => 'Test Manager',
            'email' => 'manager@example.com',
        ]);

        $manager->assignRole('manager');

        $loggedUser = \App\Models\User::factory()->create([
            'name' => 'Test Loggedin',
            'email' => 'user@example.com',
        ]);

        $loggedUser->assignRole('loggedUser');
    }
}
