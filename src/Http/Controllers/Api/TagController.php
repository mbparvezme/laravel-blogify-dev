<?php

namespace Forphp\Blogify\Http\Controllers\Api;

use Forphp\Blogify\Http\Controllers\Controller;
use Forphp\Blogify\Http\Requests\StoreTagRequest;
use Forphp\Blogify\Http\Requests\UpdateTagRequest;
use Forphp\Blogify\Http\Resources\TagResource;
use Forphp\Blogify\Models\Tag;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class TagController extends Controller
{
  public function index()
  {
    return TagResource::collection(Tag::latest()->get());
  }

  public function store(StoreTagRequest $request): TagResource
  {
    $locale = app()->getLocale();
    $tag = Tag::create([
      'name' => json_encode([$locale => $request->input('name')]),
      'slug' => json_encode([$locale => Str::slug($request->input('name'))]),
    ]);
    return new TagResource($tag);
  }

  public function show(Tag $tag): TagResource
  {
    return new TagResource($tag);
  }

  public function update(UpdateTagRequest $request, Tag $tag): TagResource
  {
    $locale = app()->getLocale();
    $name = json_decode($tag->getRawOriginal('name'), true);
    $name[$locale] = $request->input('name');

    $tag->update(['name' => json_encode($name)]);
    return new TagResource($tag);
  }

  public function destroy(Tag $tag): Response
  {
    $tag->delete();
    return response()->noContent();
  }
}
