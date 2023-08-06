<?php

namespace App\Http\Controllers\Payment;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;

class PaymentSuccessController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $id)
    {
        $order = Order::findOrFail($id);

        switch ($order->status->name) {
            case OrderStatus::PAID:
            case OrderStatus::COMPLETED:
                return view('pages.order-success', compact('order'));
            default:
                return redirect()->route('home');
        }
    }
}
