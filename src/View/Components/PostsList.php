<?php

namespace Forphp\Blogify\View\Components;

use Forphp\Blogify\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class PostsList extends Component
{
    public Collection $posts;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $category = null,
        public int $limit = 15
    ) {
        // Fetch posts based on the provided parameters
        $query = Post::with('author')->latest();

        if ($this->category) {
            // We will add category filtering logic here later
        }

        $this->posts = $query->take($this->limit)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('blogify::components.posts-list');
    }
}