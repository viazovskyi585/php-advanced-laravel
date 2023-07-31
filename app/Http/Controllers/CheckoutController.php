<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->ajax()) {
            $errors = $request->session()->get('errors');
            if ($errors) {
                $view = view('pages.checkout.checkout-page')->with('errors', $errors)->fragment('form');
                return response($view, 422);
            }
        }

        return view('pages.checkout.checkout-page');
    }
}
