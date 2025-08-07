<?php

namespace Forphp\Blogify\Http\Controllers\Api;

use Forphp\Blogify\Http\Controllers\Controller;
use Forphp\Blogify\Http\Requests\StorePostRequest;
use Forphp\Blogify\Http\Requests\UpdatePostRequest;
use Forphp\Blogify\Http\Resources\PostResource;
use Forphp\Blogify\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
  public function index()
  {
    $posts = Post::with(['category', 'tags'])->latest()->paginate(15);
    return PostResource::collection($posts);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StorePostRequest $request): PostResource
  {
    $locale = app()->getLocale();

    $post = Post::create([
      'author_id' => Auth::id(),
      'category_id' => $request->input('category_id'),
      'title' => json_encode([$locale => $request->input('title')]),
      'slug' => json_encode([$locale => Str::slug($request->input('title'))]),
      'content' => json_encode([$locale => $request->input('content')]),
      'status' => 'draft',
    ]);

    $post->tags()->sync($request->input('tags'));
    return new PostResource($post->load(['category', 'tags']));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdatePostRequest $request, Post $post): PostResource
  {
    $locale = app()->getLocale();
    $title = json_decode($post->getRawOriginal('title'), true);
    $content = json_decode($post->getRawOriginal('content'), true);

    $title[$locale] = $request->input('title');
    $content[$locale] = $request->input('content');

    $post->update([
      'category_id' => $request->input('category_id'),
      'title' => json_encode($title),
      'content' => json_encode($content),
    ]);

    $post->tags()->sync($request->input('tags'));

    // Return the updated resource
    return new PostResource($post->load(['category', 'tags']));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Post $post): Response
  {
    $post->delete();
    return response()->noContent();
  }
}
