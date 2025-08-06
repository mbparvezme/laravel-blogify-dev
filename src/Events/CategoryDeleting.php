<?php

namespace Forphp\Blogify\Events;

use Forphp\Blogify\Models\Category;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CategoryDeleting
{
    use Dispatchable, SerializesModels;

    public function __construct(public Category $category)
    {
        //
    }
}