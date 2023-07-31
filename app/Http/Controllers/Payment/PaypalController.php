<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;

use Illuminate\Support\Facades\View;
use Response;

class PaypalController extends Controller
{
    public function create(CreateOrderRequest $request)
    {
        echo ('not here');
    }

    public function capture()
    {
    }
}
