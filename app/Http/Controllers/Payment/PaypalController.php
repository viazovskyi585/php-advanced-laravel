<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Services\Contracts\PaymentServiceContract;

class PaypalController extends Controller
{
    public function create(CreateOrderRequest $request, PaymentServiceContract $payment)
    {
        return app()->call([$payment, 'create'], compact('request'));
    }

    public function capture(string $vendorOrderId, PaymentServiceContract $payment)
    {
        return app()->call([$payment, 'capture'], compact('vendorOrderId'));
    }
}
