<?php

namespace Forphp\Blogify\Http\Controllers\Admin;

use Forphp\Blogify\Http\Controllers\Controller;
use Forphp\Blogify\Http\Requests\StorePostRequest;
use Forphp\Blogify\Http\Requests\UpdatePostRequest;
use Forphp\Blogify\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        $locale = app()->getLocale();

        Post::create([
            'author_id' => Auth::id(),
            'title' => json_encode([$locale => $request->input('title')]),
            'slug' => json_encode([$locale => Str::slug($request->input('title'))]),
            'content' => json_encode([$locale => $request->input('content')]),
            'status' => 'draft',
            'category_id' => $request->input('category_id'),
        ]);

        // Redirect back to the previous page with a success message
        return back()->with('success', 'Post created successfully.');
    }

        /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $locale = app()->getLocale();

        // Get existing translations and update the current locale's value
        $title = json_decode($post->getRawOriginal('title'), true);
        $content = json_decode($post->getRawOriginal('content'), true);

        $title[$locale] = $request->input('title');
        $content[$locale] = $request->input('content');

        $post->update([
            'title' => json_encode($title),
            'content' => json_encode($content),
            'category_id' => $request->input('category_id'),
        ]);

        $post->tags()->sync($request->input('tags'));

        return back()->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        // We can add authorization checks here later
        $post->delete();

        return back()->with('success', 'Post deleted successfully.');
    }
}