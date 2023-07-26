<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function add(Request $request, Product $product)
    {
        //
    }

    public function remove(Request $request)
    {
        //
    }

    public function updateCount(Request $request, Product $product)
    {
        //
    }
}
