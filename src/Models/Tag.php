<?php

namespace Forphp\Blogify\Models;

use Forphp\Blogify\Events\TagDeleted;
use Forphp\Blogify\Events\TagDeleting;
use Forphp\Blogify\Events\TagSaved;
use Forphp\Blogify\Events\TagSaving;

use Forphp\Blogify\Models\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
  use SoftDeletes, HasTranslations;

  protected $table = 'blogify_tags';

  protected $guarded = [];

  protected $dispatchesEvents = [
    'deleted'  => TagDeleted::class,
    'deleting' => TagDeleting::class,
    'saved'    => TagSaved::class,
    'saving'   => TagSaving::class,
  ];

  public function getNameAttribute()
  {
    return $this->getTranslated('name');
  }

  public function posts(): BelongsToMany
  {
    return $this->belongsToMany(Post::class, 'blogify_post_tag');
  }
}
