<?php

namespace Forphp\Blogify\Models;

use Forphp\Blogify\Events\CategoryDeleted;
use Forphp\Blogify\Events\CategoryDeleting;
use Forphp\Blogify\Events\CategorySaved;
use Forphp\Blogify\Events\CategorySaving;

use Forphp\Blogify\Models\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
  use SoftDeletes, HasTranslations;

  protected $table = 'blogify_categories';
  protected $guarded = [];

  protected $dispatchesEvents = [
    'saving'   => CategorySaving::class,
    'saved'    => CategorySaved::class,
    'deleting' => CategoryDeleting::class,
    'deleted'  => CategoryDeleted::class,
  ];

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
