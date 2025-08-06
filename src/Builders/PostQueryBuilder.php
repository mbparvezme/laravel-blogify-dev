<?php

namespace Forphp\Blogify\Builders;

use Illuminate\Database\Eloquent\Builder;

class PostQueryBuilder
{
    protected Builder $query;

    public function __construct()
    {
        $this->query = \Forphp\Blogify\Models\Post::query();
    }

    /**
     * Filter posts by category slug.
     */
    public function category(string $slug): self
    {
        $this->query->whereHas('category', function ($q) use ($slug) {
            $q->where('slug->' . app()->getLocale(), $slug);
        });

        return $this;
    }

    /**
     * Limit the number of posts returned.
     */
    public function limit(int $number): self
    {
        $this->query->limit($number);

        return $this;
    }

    /**
     * Pass any other method calls to the underlying query builder.
     * This allows us to use methods like get(), paginate(), etc.
     */
    public function __call(string $name, array $arguments)
    {
        return $this->query->{$name}(...$arguments);
    }
}