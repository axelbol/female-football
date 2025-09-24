<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $posts = Post::published()
            ->with('category')
            ->latest('updated_at')
            ->get();

        $categories = Category::all();

        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        // Homepage
        $sitemap .= '  <url>' . PHP_EOL;
        $sitemap .= '    <loc>' . url('/') . '</loc>' . PHP_EOL;
        $sitemap .= '    <lastmod>' . now()->toISOString() . '</lastmod>' . PHP_EOL;
        $sitemap .= '    <changefreq>daily</changefreq>' . PHP_EOL;
        $sitemap .= '    <priority>1.0</priority>' . PHP_EOL;
        $sitemap .= '  </url>' . PHP_EOL;

        // Posts
        foreach ($posts as $post) {
            $sitemap .= '  <url>' . PHP_EOL;
            $sitemap .= '    <loc>' . route('post.public', $post->slug) . '</loc>' . PHP_EOL;
            $sitemap .= '    <lastmod>' . $post->updated_at->toISOString() . '</lastmod>' . PHP_EOL;
            $sitemap .= '    <changefreq>weekly</changefreq>' . PHP_EOL;
            $sitemap .= '    <priority>0.8</priority>' . PHP_EOL;

            // Add images to sitemap
            if ($post->featured_image_url) {
                $sitemap .= '    <image:image>' . PHP_EOL;
                $sitemap .= '      <image:loc>' . $post->featured_image_url . '</image:loc>' . PHP_EOL;
                $sitemap .= '      <image:caption>' . htmlspecialchars($post->title) . '</image:caption>' . PHP_EOL;
                $sitemap .= '    </image:image>' . PHP_EOL;
            }

            $sitemap .= '  </url>' . PHP_EOL;
        }

        // Categories (if you have category pages)
        foreach ($categories as $category) {
            $sitemap .= '  <url>' . PHP_EOL;
            $sitemap .= '    <loc>' . route('category.show', $category->slug) . '</loc>' . PHP_EOL;
            $sitemap .= '    <lastmod>' . $category->updated_at->toISOString() . '</lastmod>' . PHP_EOL;
            $sitemap .= '    <changefreq>weekly</changefreq>' . PHP_EOL;
            $sitemap .= '    <priority>0.6</priority>' . PHP_EOL;
            $sitemap .= '  </url>' . PHP_EOL;
        }

        $sitemap .= '</urlset>' . PHP_EOL;

        return response($sitemap, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }

    public function robots(): Response
    {
        $robots = "User-agent: *" . PHP_EOL;
        $robots .= "Disallow: /admin" . PHP_EOL;
        $robots .= "Disallow: /posts/create" . PHP_EOL;
        $robots .= "Disallow: /posts/*/edit" . PHP_EOL;
        $robots .= "Disallow: /categories/create" . PHP_EOL;
        $robots .= "Disallow: /categories/*/edit" . PHP_EOL;
        $robots .= "Allow: /" . PHP_EOL;
        $robots .= PHP_EOL;
        $robots .= "Sitemap: " . url('/sitemap.xml') . PHP_EOL;

        return response($robots, 200, [
            'Content-Type' => 'text/plain'
        ]);
    }
}