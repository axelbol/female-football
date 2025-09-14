<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement(['Admin', 'Editor', 'Author', 'Moderator', 'Subscriber']);
        
        return [
            'name' => $name,
            'slug' => strtolower($name),
            'description' => fake()->sentence(),
        ];
    }
}
