<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(2, true);
        $colors = ['emerald', 'blue', 'purple', 'pink', 'indigo', 'green', 'yellow', 'red'];
        
        return [
            'name' => ucfirst($name),
            'slug' => str($name)->slug(),
            'color' => fake()->randomElement($colors),
            'description' => fake()->sentence(10),
            'is_active' => fake()->boolean(85),
        ];
    }
}
