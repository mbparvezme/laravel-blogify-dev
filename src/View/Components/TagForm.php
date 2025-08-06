<?php

namespace Forphp\Blogify\View\Components;

use Forphp\Blogify\Models\Tag;
use Illuminate\View\Component;
use Illuminate\View\View;

class TagForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public ?Tag $tag = null)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('blogify::components.tag-form');
    }
}