<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $orders = Order::with(['status'])->where('user_id', $userId)->paginate(8);

        return view('pages.orders.orders-page', compact('orders'));
    }
}
