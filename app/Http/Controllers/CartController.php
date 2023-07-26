<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.cart-page');
    }

    public function add(Request $request, Product $product)
    {
        Cart::instance('cart')->add($product, $request->get('quantity', 1));

        return redirect()->back();
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
