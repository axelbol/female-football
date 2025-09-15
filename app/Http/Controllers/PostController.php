<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::with(['user', 'category'])
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

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post created successfully.');
    }

    public function show(Post $post): View
    {
        $post->load(['user', 'category']);

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

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
