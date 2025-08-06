<?php

namespace Forphp\Blogify\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;

class MediaDeleting
{
    use Dispatchable, SerializesModels;

    public function __construct(public UploadedFile $file)
    {
        
    }
}