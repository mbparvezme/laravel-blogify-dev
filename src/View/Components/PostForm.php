<?php

namespace Forphp\Blogify\View\Components;

use Forphp\Blogify\Models\Category;
use Forphp\Blogify\Models\Post;
use Forphp\Blogify\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class PostForm extends Component
{
    public Collection $categories;
    public Collection $tags;

    /**
     * Create a new component instance.
     */
    public function __construct(public ?Post $post = null)
    {
        // Fetch all categories and tags to be used in the form
        $this->categories = Category::all();
        $this->tags = Tag::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('blogify::components.post-form');
    }
}