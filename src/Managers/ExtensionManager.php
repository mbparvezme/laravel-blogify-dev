<?php

namespace Forphp\Blogify\Managers;

use Illuminate\Contracts\Foundation\Application;

class ExtensionManager
{
    protected Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Load and register all extensions from the config file.
     */
    public function registerExtensions(): void
    {
        $extensions = config('blogify.extensions', []);

        foreach ($extensions as $extensionProvider) {
            if (class_exists($extensionProvider)) {
                $this->app->register($extensionProvider);
            }
        }
    }
}