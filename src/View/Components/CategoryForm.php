<?php

namespace Forphp\Blogify\View\Components;

use Forphp\Blogify\Models\Category;
use Illuminate\View\Component;
use Illuminate\View\View;

class CategoryForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public ?Category $category = null)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('blogify::components.category-form');
    }
}