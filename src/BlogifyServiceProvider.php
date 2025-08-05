<?php

namespace Forphp\LaravelBlogify;

use Forphp\LaravelBlogify\Console\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;

class BlogifyServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    // Merge the package's config file with the application's published copy
    $this->mergeConfigFrom(
      __DIR__ . '/../config/blogify.php',
      'blogify'
    );
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

    if ($this->app->runningInConsole()) {
      // Publish config file
      $this->publishes([
        __DIR__ . '/../config/blogify.php' => config_path('blogify.php'),
      ], 'blogify-config');

      $this->commands([
        InstallCommand::class,
      ]);
    }
  }
}
