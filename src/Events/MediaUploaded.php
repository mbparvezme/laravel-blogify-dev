<?php

namespace Forphp\Blogify\Events;

use Forphp\Blogify\Models\Media;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MediaUploaded
{
    use Dispatchable, SerializesModels;

    public function __construct(public Media $media)
    {

    }
}