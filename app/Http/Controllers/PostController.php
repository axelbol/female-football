<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::with(['user', 'category', 'media'])
            ->latest('created_at')
            ->paginate(15);

        return view('posts.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();

        if ($validatedData['is_published'] && !$validatedData['published_at']) {
            $validatedData['published_at'] = now();
        }

        $post = Post::create($validatedData);

        // Handle image uploads
        if ($request->hasFile('featured_image')) {
            $post->addMediaFromRequest('featured_image')
                ->toMediaCollection('featured_image');
        }

        if ($request->hasFile('hero_image')) {
            $post->addMediaFromRequest('hero_image')
                ->toMediaCollection('hero_image');
        }

        if ($request->hasFile('middle_image')) {
            $post->addMediaFromRequest('middle_image')
                ->toMediaCollection('middle_image');
        }

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post created successfully.');
    }

    public function show(Post $post): View
    {
        $post->load(['user', 'category', 'media']);

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($validatedData['is_published'] && !$post->published_at && !$validatedData['published_at']) {
            $validatedData['published_at'] = now();
        }

        $post->update($validatedData);

        // Handle image uploads
        if ($request->hasFile('featured_image')) {
            $post->clearMediaCollection('featured_image');
            $post->addMediaFromRequest('featured_image')
                ->toMediaCollection('featured_image');
        }

        if ($request->hasFile('hero_image')) {
            $post->clearMediaCollection('hero_image');
            $post->addMediaFromRequest('hero_image')
                ->toMediaCollection('hero_image');
        }

        if ($request->hasFile('middle_image')) {
            $post->clearMediaCollection('middle_image');
            $post->addMediaFromRequest('middle_image')
                ->toMediaCollection('middle_image');
        }

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }

    public function search(Request $request): View
    {
        $query = $request->get('q');

        if (empty($query)) {
            return redirect()->route('home');
        }

        $posts = Post::published()
            ->with(['user', 'category', 'media'])
            ->search($query)
            ->latest('published_at')
            ->paginate(12);

        return view('search', compact('posts', 'query'));
    }

    public function showPublic(Post $post): View
    {
        // Ensure the post is published
        if (!$post->is_published) {
            abort(404);
        }

        $post->load(['user', 'category', 'media']);
        $relatedPosts = $post->getRelatedPosts();

        return view('post', compact('post', 'relatedPosts'));
    }
}
