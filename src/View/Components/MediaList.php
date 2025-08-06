<?php

namespace Forphp\Blogify\View\Components;

use Forphp\Blogify\Models\Media;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class MediaList extends Component
{
    public Collection $media;

    public function __construct()
    {
        $this->media = Media::latest()->get();
    }

    public function render(): View
    {
        return view('blogify::components.media-list');
    }
}