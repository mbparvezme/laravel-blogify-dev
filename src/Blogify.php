<?php

namespace Forphp\Blogify;

use Forphp\Blogify\Models\Post;
use Forphp\Blogify\Builders\PostQueryBuilder;

class Blogify
{
    /**
     * Start a new fluent query for posts.
     */
    public function posts(): PostQueryBuilder
    {
        return new PostQueryBuilder();
    }
}