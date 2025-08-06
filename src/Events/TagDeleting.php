<?php

namespace Forphp\Blogify\Events;

use Forphp\Blogify\Models\Tag;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TagDeleting
{
    use Dispatchable, SerializesModels;

    public function __construct(public Tag $tag)
    {
        
    }
}