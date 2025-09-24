<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $latestPost = Post::published()
            ->with(['user', 'category', 'media'])
            ->latest('published_at')
            ->first();

        $recentPosts = Post::published()
            ->with(['user', 'category', 'media'])
            ->latest('published_at')
            ->skip(1)
            ->limit(2)
            ->get();

        $featuredPosts = Post::published()
            ->featured()
            ->with(['user', 'category', 'media'])
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('welcome', compact('latestPost', 'recentPosts', 'featuredPosts'));
    }
}
