<?php

namespace Forphp\Blogify\Events;

use Forphp\Blogify\Models\Post;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostDeleted
{
    use Dispatchable, SerializesModels;

    public function __construct(public Post $post)
    {
        
    }
}