<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostSearch extends Component
{
    public string $search = '';
    public bool $showResults = false;

    public function updatedSearch(): void
    {
        $this->showResults = strlen($this->search) >= 2;
    }

    public function selectPost(string $slug): void
    {
        $this->redirect(route('post.public', $slug));
    }

    public function resetSearch(): void
    {
        $this->search = '';
        $this->showResults = false;
    }

    public function render()
    {
        $posts = [];

        if ($this->showResults) {
            $posts = Post::published()
                ->search($this->search)
                ->with('category')
                ->limit(5)
                ->get();
        }

        return view('livewire.post-search', [
            'posts' => $posts
        ]);
    }
}
