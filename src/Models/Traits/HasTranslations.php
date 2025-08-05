<?php

namespace Forphp\LaravelBlogify\Models\Traits;

use Illuminate\Support\Facades\App;

trait HasTranslations
{
  /**
   * Get a translated attribute.
   *
   * @param string $key
   * @return mixed
   */
  public function getTranslated(string $key)
  {
    $locale = App::getLocale();
    $fallbackLocale = config('app.fallback_locale');

    $translations = json_decode($this->attributes[$key] ?? '{}', true);

    return $translations[$locale] ?? $translations[$fallbackLocale] ?? null;
  }
}
