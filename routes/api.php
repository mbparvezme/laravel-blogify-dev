<?php

use Forphp\Blogify\Http\Controllers\Api\CategoryController;
use Forphp\Blogify\Http\Controllers\Api\PostController;
use Forphp\Blogify\Http\Controllers\Api\TagController;
use Illuminate\Support\Facades\Route;

// Publicly accessible routes (for reading data)
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);

Route::get('/tags', [TagController::class, 'index']);
Route::get('/tags/{tag}', [TagController::class, 'show']);


// Protected routes (for writing data)
Route::middleware('auth:sanctum')->group(function () {
  Route::post('/posts', [PostController::class, 'store']);
  Route::put('/posts/{post}', [PostController::class, 'update']);
  Route::delete('/posts/{post}', [PostController::class, 'destroy']);

  Route::post('/categories', [CategoryController::class, 'store']);
  Route::put('/categories/{category}', [CategoryController::class, 'update']);
  Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

  Route::post('/tags', [TagController::class, 'store']);
  Route::put('/tags/{tag}', [TagController::class, 'update']);
  Route::delete('/tags/{tag}', [TagController::class, 'destroy']);
});
