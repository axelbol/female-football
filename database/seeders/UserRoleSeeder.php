<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;
use App\Models\User;
use App\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $roles = Role::all();

        // Get existing user-role combinations to avoid duplicates
        $existingCombinations = UserRole::all()->map(function ($userRole) {
            return $userRole->user_id . '_' . $userRole->role_id;
        })->toArray();

        // Create unique combinations that don't already exist
        $combinations = [];
        foreach ($users as $user) {
            foreach ($roles as $role) {
                $combinationKey = $user->id . '_' . $role->id;

                // Skip if this combination already exists
                if (in_array($combinationKey, $existingCombinations)) {
                    continue;
                }

                $combinations[] = [
                    'user_id' => $user->id,
                    'role_id' => $role->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert only new unique combinations, limit to reasonable number
        if (!empty($combinations)) {
            $limitedCombinations = collect($combinations)->take(20)->toArray();
            UserRole::insert($limitedCombinations);
        }
    }
}
