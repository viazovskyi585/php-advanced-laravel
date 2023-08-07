<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use App\Services\Contracts\InvoicesServiceContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;

class InvoicesService implements InvoicesServiceContract
{
    public function generate(Order $order): Invoice
    {
        $customer = new Buyer([
            'name'          => "{$order->first_name} {$order->last_name}",
            'custom_fields' => [
                'email'   => $order->email,
                'phone'   => $order->phone,
                'city'    => $order->city,
                'address' => $order->address,
            ],
        ]);

        $invoice = Invoice::make()
            ->status($order->status->getName())
            ->buyer($customer)
            ->taxRate(config('cart.tax'))
            ->filename($this->generateFileName($order))
            ->addItems($this->getInvoiceItems($order->products))
            ->save('public');

        if ($order->status === OrderStatus::IN_PROCESS) {
            $invoice->payUntilDays(5);
        }

        return $invoice;
    }

    protected function generateFileName(Order $order): string
    {
        return Str::of("{$order->id}_{$order->first_name}-{$order->lastName}_{$order->created_at->format('d-m-Y')}")
            ->slug('-');
    }

    protected function getInvoiceItems(Collection $products): array
    {
        return $products->map(function (Product $product) {
            return (new InvoiceItem())
                ->title($product->title)
                ->pricePerUnit($product->pivot->single_price)
                ->quantity($product->pivot->quantity);
        })->toArray();
    }
}
