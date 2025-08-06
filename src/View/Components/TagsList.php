<?php

namespace Forphp\Blogify\View\Components;

use Forphp\Blogify\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class TagsList extends Component
{
    public Collection $tags;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->tags = Tag::latest()->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('blogify::components.tags-list');
    }
}