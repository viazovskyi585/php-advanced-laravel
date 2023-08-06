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

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['products', 'status']);

        return view('pages.orders.order-page', compact('order'));
    }
}
