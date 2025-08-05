<?php

namespace Forphp\LaravelBlogify\Models;

use Forphp\LaravelBlogify\Models\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
  use SoftDeletes, HasTranslations;

  protected $table = 'blogify_posts';
  protected $guarded = [];
  protected $casts = [
    'published_at' => 'datetime',
    'interactions' => 'json',
  ];

  public function getTitleAttribute()
  {
    return $this->getTranslated('title');
  }

  public function getContentAttribute()
  {
    return $this->getTranslated('content');
  }

  // Relationships
  public function author(): BelongsTo
  {
    return $this->belongsTo(config('blogify.author.model'));
  }

  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }

  public function tags(): BelongsToMany
  {
    return $this->belongsToMany(Tag::class, 'blogify_post_tag');
  }

  public function media(): BelongsToMany
  {
    return $this->belongsToMany(Media::class, 'blogify_media_post');
  }
}
