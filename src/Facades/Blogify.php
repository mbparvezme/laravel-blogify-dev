<?php

namespace Forphp\Blogify\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Forphp\Blogify\Blogify
 */
class Blogify extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'blogify';
    }
}