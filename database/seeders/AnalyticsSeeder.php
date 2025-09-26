<?php

namespace Database\Seeders;

use App\Models\Analytics;
use App\Models\Post;
use Illuminate\Database\Seeder;

class AnalyticsSeeder extends Seeder
{
    public function run(): void
    {
        $posts = Post::take(5)->get();
        $userAgents = [
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36',
            'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15',
            'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36',
            'Mozilla/5.0 (iPad; CPU OS 14_0 like Mac OS X) AppleWebKit/605.1.15',
        ];

        $referrers = [
            'https://google.com',
            'https://facebook.com',
            'https://twitter.com',
            null, // Direct traffic
            'https://linkedin.com',
        ];

        // Generate sample analytics data for the last 7 days
        $analyticsData = [];

        for ($i = 0; $i < 7; $i++) {
            $date = now()->subDays($i);
            $dailyViews = fake()->numberBetween(5, 20);

            for ($j = 0; $j < $dailyViews; $j++) {
                $analyticsData[] = [
                    'event_type' => 'page_view',
                    'post_id' => $posts->isNotEmpty() ? $posts->random()->id : null,
                    'session_id' => fake()->uuid(),
                    'ip_address' => fake()->ipv4(),
                    'user_agent' => fake()->randomElement($userAgents),
                    'referrer' => fake()->randomElement($referrers),
                    'url' => 'http://localhost:8000' . fake()->randomElement(['/home', '/about', '/posts']),
                    'user_id' => null,
                    'created_at' => $date,
                    'updated_at' => $date,
                ];
            }
        }

        Analytics::insert($analyticsData);
    }
}
