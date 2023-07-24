<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = Product::orderByDesc('id')->take(8)->get();

        return view('pages.home.home-page', compact('categories', 'products'));
    }
}
