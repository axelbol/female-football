<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(4);
        $isPublished = fake()->boolean(70);
        
        return [
            'title' => rtrim($title, '.'),
            'slug' => str($title)->slug(),
            'excerpt' => fake()->sentence(15),
            'content' => fake()->paragraphs(8, true),
            'featured_image' => fake()->boolean(40) ? fake()->imageUrl(800, 600, 'football') : null,
            'hero_image' => fake()->boolean(30) ? fake()->imageUrl(1200, 400, 'sports') : null,
            'middle_image' => fake()->boolean(25) ? fake()->imageUrl(1000, 500, 'football') : null,
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'read_time' => fake()->numberBetween(2, 15),
            'is_featured' => fake()->boolean(15),
            'is_published' => $isPublished,
            'published_at' => $isPublished ? fake()->dateTimeBetween('-1 year', 'now') : null,
            'meta_data' => fake()->boolean(30) ? [
                'keywords' => fake()->words(5),
                'author_bio' => fake()->sentence(10)
            ] : null,
        ];
    }
}
