<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('slug', 'admin')->first();
        
        if (!$adminRole) {
            return;
        }

        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@femalefootball.com',
            'password' => 'password123'
        ]);

        $adminUser->roles()->attach($adminRole->id);
    }
}
