<?php

namespace Forphp\LaravelBlogify\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Media extends Model
{
  use SoftDeletes;

  protected $table = 'blogify_media';

  protected $guarded = [];

  public function posts(): BelongsToMany
  {
    return $this->belongsToMany(Post::class, 'blogify_media_post');
  }
}
