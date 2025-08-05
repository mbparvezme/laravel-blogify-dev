<?php

namespace Forphp\LaravelBlogify\Models;

use Forphp\LaravelBlogify\Models\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
  use SoftDeletes, HasTranslations;

  protected $table = 'blogify_tags';

  protected $guarded = [];

  public function getNameAttribute()
  {
    return $this->getTranslated('name');
  }

  public function posts(): BelongsToMany
  {
    return $this->belongsToMany(Post::class, 'blogify_post_tag');
  }
}
