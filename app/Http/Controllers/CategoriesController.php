<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::with('image')->where('parent_id', null)->get();

        return view('pages.categories.categories-page', compact('categories'));
    }
}
