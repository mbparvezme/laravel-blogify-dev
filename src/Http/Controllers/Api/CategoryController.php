<?php

namespace Forphp\Blogify\Http\Controllers\Api;

use Forphp\Blogify\Http\Controllers\Controller;
use Forphp\Blogify\Http\Requests\StoreCategoryRequest;
use Forphp\Blogify\Http\Requests\UpdateCategoryRequest;
use Forphp\Blogify\Http\Resources\CategoryResource;
use Forphp\Blogify\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
  public function index()
  {
    return CategoryResource::collection(Category::latest()->get());
  }

  public function store(StoreCategoryRequest $request): CategoryResource
  {
    $locale = app()->getLocale();
    $category = Category::create([
      'name' => json_encode([$locale => $request->input('name')]),
      'slug' => json_encode([$locale => Str::slug($request->input('name'))]),
    ]);
    return new CategoryResource($category);
  }

  public function show(Category $category): CategoryResource
  {
    return new CategoryResource($category);
  }

  public function update(UpdateCategoryRequest $request, Category $category): CategoryResource
  {
    $locale = app()->getLocale();
    $name = json_decode($category->getRawOriginal('name'), true);
    $name[$locale] = $request->input('name');

    $category->update(['name' => json_encode($name)]);
    return new CategoryResource($category);
  }

  public function destroy(Category $category): Response
  {
    $category->delete();
    return response()->noContent();
  }
}
