<?php

// config for Forphp/LaravelBlogify
return [
  /*
    |--------------------------------------------------------------------------
    | Author Model
    |--------------------------------------------------------------------------
    |
    | This is the model that will be used to represent the author of a post.
    | It must be an Eloquent model. You can change this to your own
    | User, Admin, or Author model.
    |
    */
  'author' => [
    'model' => App\Models\User::class,
  ],

  /*
    |--------------------------------------------------------------------------
    | Admin Menu
    |--------------------------------------------------------------------------
    |
    | This array defines the items that will appear in the admin navigation
    | menu. The blogify_menu() helper reads from this array. Extensions
    | can programmatically add items to this list.
    |
    */
  'menu' => [
    ['name' => 'Posts', 'route' => 'blogify.admin.posts.index', 'icon' => 'icon-post'],
    ['name' => 'Categories', 'route' => 'blogify.admin.categories.index', 'icon' => 'icon-cat'],
    ['name' => 'Tags', 'route' => 'blogify.admin.tags.index', 'icon' => 'icon-tag'],
    ['name' => 'Media', 'route' => 'blogify.admin.media.index', 'icon' => 'icon-media'],
  ],

  /*
    |--------------------------------------------------------------------------
    | Extensions
    |--------------------------------------------------------------------------
    |
    | Register any extensions for Laravel Blogify here. An extension is just
    | another service provider that can hook into the package's lifecycle
    | to add functionality.
    |
    */
  'extensions' => [
    // \Vendor\SeoExtension\SeoServiceProvider::class,
  ],
];
