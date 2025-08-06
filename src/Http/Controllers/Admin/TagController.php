<?php

namespace Forphp\Blogify\Http\Controllers\Admin;

use Forphp\Blogify\Http\Controllers\Controller;
use Forphp\Blogify\Http\Requests\StoreTagRequest;
use Forphp\Blogify\Http\Requests\UpdateTagRequest;
use Forphp\Blogify\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function store(StoreTagRequest $request): RedirectResponse
    {
        $locale = app()->getLocale();
        Tag::create([
            'name' => json_encode([$locale => $request->input('name')]),
            'slug' => json_encode([$locale => Str::slug($request->input('name'))]),
        ]);
        return back()->with('success', 'Tag created successfully.');
    }

    public function update(UpdateTagRequest $request, Tag $tag): RedirectResponse
    {
        $locale = app()->getLocale();
        $name = json_decode($tag->getRawOriginal('name'), true);
        $name[$locale] = $request->input('name');

        $tag->update(['name' => json_encode($name)]);
        return back()->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();
        return back()->with('success', 'Tag deleted successfully.');
    }
}