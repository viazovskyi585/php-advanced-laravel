<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
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
        $data = $this->validate($request, [
            'rowId' => 'required|string',
        ]);
        try {
            Cart::instance('cart')->remove($data['rowId']);
        } catch (Exception $e) {
            logs()->warning($e);
        } finally {
            return redirect()->back();
        }
    }

    public function updateCount(Request $request)
    {
        $data = $this->validate($request, [
            'rowId' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);
        try {
            Cart::instance('cart')->update($data['rowId'], $data['quantity']);
        } catch (Exception $e) {
            logs()->warning($e);
        } finally {
            return redirect()->back();
        }
    }
}
