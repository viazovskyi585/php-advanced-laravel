<?php

namespace App\Repositories;

use App\Enums\PaymentSystem;
use App\Enums\TransactionStatus;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Transaction;
use App\Repositories\Contracts\OrderRepositoryContract;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use \Illuminate\Support\Facades\Auth;

class OrderRepository implements OrderRepositoryContract
{
    public function create(array $data): Order|false
    {
        $status = OrderStatus::default()->first();
        $data = array_merge($data, [
            'status_id' => $status->id,
        ]);
        $order = Auth::user()->orders()->create($data);

        $this->addProductsToOrder($order);

        return $order;
    }

    public function setTransaction(string $vendorOrderId, PaymentSystem $system, TransactionStatus $status)
    {
        $order = Order::where('vendor_order_id', $vendorOrderId)->firstOrFail();
        $order->transaction()->create([
            'status' => $status->value,
            'payment_system' => $system->value,
        ]);

        $status = match ($status) {
            TransactionStatus::SUCCESS => OrderStatus::paid()->first(),
            TransactionStatus::CANCELLED => OrderStatus::failed()->first(),
            default => OrderStatus::default()->first(),
        };

        $order->update(['status_id' => $status->id]);

        return $order;
    }

    protected function addProductsToOrder(Order $order)
    {
        $products = Cart::instance('cart')->content();
        foreach ($products as $product) {
            $order->products()->attach($product->model, [
                'quantity' => $product->qty,
                'single_price' => $product->price,
            ]);

            $quantity = $product->model->quantity - $product->qty;

            if (!$product->model->update(['quantity' => $quantity])) {
                throw new Exception("Error while updating product [$product->title] quantity.");
            }
        }
    }
}
