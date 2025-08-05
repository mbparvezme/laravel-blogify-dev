<?php

namespace Forphp\LaravelBlogify\Models;

use Forphp\LaravelBlogify\Models\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
  use SoftDeletes, HasTranslations;

  protected $table = 'blogify_categories';
  protected $guarded = [];

  public function getNameAttribute()
  {
    return $this->getTranslated('name');
  }

  // Relationships
  public function posts(): HasMany
  {
    return $this->hasMany(Post::class);
  }

  public function parent(): BelongsTo
  {
    return $this->belongsTo(Category::class, 'parent_id');
  }

  public function children(): HasMany
  {
    return $this->hasMany(Category::class, 'parent_id');
  }
}
