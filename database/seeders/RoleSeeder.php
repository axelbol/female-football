<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Full access to everything'
        ]);

        Role::create([
            'name' => 'Editor',
            'slug' => 'editor',
            'description' => 'Can create, edit, and publish posts and manage categories'
        ]);

        Role::create([
            'name' => 'User',
            'slug' => 'user',
            'description' => 'Can only view published content'
        ]);
    }
}
