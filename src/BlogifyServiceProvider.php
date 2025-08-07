<?php

namespace Forphp\Blogify;

use Forphp\Blogify\Console\Commands\InstallCommand;
use Forphp\Blogify\Console\Commands\AssignRoleCommand;
use Illuminate\Support\ServiceProvider;
use Forphp\Blogify\View\Components\PostsList;
use Forphp\Blogify\View\Components\CategoryForm;
use Forphp\Blogify\View\Components\CategoriesList;
use Forphp\Blogify\View\Components\TagForm;
use Forphp\Blogify\View\Components\TagsList;
use Forphp\Blogify\View\Components\MediaList;
use Forphp\Blogify\Managers\ExtensionManager;
use Forphp\Blogify\Blogify;
use Illuminate\Support\Facades\Route;

class BlogifyServiceProvider extends ServiceProvider
{

  /**
   * The namespace for the package's controllers.
   *
   * @var string|null
   */
  protected $namespace = 'Forphp\Blogify\Http\Controllers';


  /**
   * Register any application services.
   */
  public function register(): void
  {
    // Merge the package's config file with the application's published copy
    $this->mergeConfigFrom(
      __DIR__ . '/../config/blogify.php', 'blogify'
    );

    $this->app->singleton('blogify', function ($app) {
        return new Blogify();
    });

    (new ExtensionManager($this->app))->registerExtensions();
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

    if ($this->app->runningInConsole()) {
      $this->publishes([
        __DIR__ . '/../config/blogify.php' => config_path('blogify.php'),
      ], 'blogify-config');

      $this->commands([AssignRoleCommand::class, InstallCommand::class]);
    }

    $this->loadViewComponentsAs('blogify', [
        PostForm::class,
        PostsList::class,

        CategoryForm::class,
        CategoriesList::class,

        TagForm::class,
        TagsList::class,

        MediaList::class,
    ]);

    $this->mapApiRoutes();
  }

  protected function mapApiRoutes()
  {
    Route::prefix('api/blogify')
      ->middleware('api')
      ->namespace($this->namespace)
      ->group(base_path('routes/api.php'));
  }

}
