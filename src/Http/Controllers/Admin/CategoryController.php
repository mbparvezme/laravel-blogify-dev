<?php

namespace Forphp\Blogify\Http\Controllers\Admin;

use Forphp\Blogify\Http\Controllers\Controller;
use Forphp\Blogify\Http\Requests\StoreCategoryRequest;
use Forphp\Blogify\Http\Requests\UpdateCategoryRequest;
use Forphp\Blogify\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $locale = app()->getLocale();
        Category::create([
            'name' => json_encode([$locale => $request->input('name')]),
            'slug' => json_encode([$locale => Str::slug($request->input('name'))]),
        ]);
        return back()->with('success', 'Category created successfully.');
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $locale = app()->getLocale();
        $name = json_decode($category->getRawOriginal('name'), true);
        $name[$locale] = $request->input('name');

        $category->update(['name' => json_encode($name)]);
        return back()->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return back()->with('success', 'Category deleted successfully.');
    }
}