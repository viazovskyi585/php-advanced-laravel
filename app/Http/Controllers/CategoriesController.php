<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(): View
    {
        $categories = Category::with('image')->where('parent_id', null)->get();

        return view('pages.categories.categories-page', compact('categories'));
    }

    public function show(string $slugs): View
    {
        $segments = explode('/', $slugs);
        $categories = collect();
        $category = null;

        foreach ($segments as $segment) {
            $category = Category::where('slug', $segment)->firstOrFail();
            $categories->push($category);
        }

        if ($categories->last()->childs->count() > 0) {
            $parentCategories = $categories;
            $categories = $categories->last()->childs;
            $parentSlugs = $slugs . '/';
            return view('pages.categories.categories-page', compact('categories', 'parentSlugs', 'parentCategories'));
        } else {
            $products = $categories->last()->products()->paginate(12);
            return view('pages.products.products-page', compact('categories', 'products'));
        }
    }
}
