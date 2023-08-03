<?php

namespace App\Services;

use App\Enums\PaymentSystem;
use App\Enums\TransactionStatus;
use App\Http\Requests\CreateOrderRequest;
use App\Repositories\Contracts\OrderRepositoryContract;
use App\Services\Contracts\PaymentServiceContract;
use DB;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Srmklive\PayPal\Services\PayPal;

class PaypalService implements PaymentServiceContract
{
    protected PayPal $paypalClient;

    public function __construct()
    {
        $this->paypalClient = new PayPal;
        $this->paypalClient->setApiCredentials(config('paypal'));
        $this->paypalClient->setAccessToken($this->paypalClient->getAccessToken());
    }

    public function create(CreateOrderRequest $request, OrderRepositoryContract $repository)
    {
        try {
            DB::beginTransaction();
            $total = Cart::instance('cart')->totalFloat();
            $paypalOrder = $this->createPaymentOrder($total);

            $fields = array_merge(
                $request->validated(),
                [
                    "vendor_order_id" => $paypalOrder['id'],
                    "total_price" => $total,
                ]
            );

            $order = $repository->create($fields);

            DB::commit();
            return response()->json($order);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->handleException($e);
        }
    }

    public function capture(string $vendorOrderId, OrderRepositoryContract $repository)
    {
        try {
            DB::beginTransaction();

            $result = $this->paypalClient->capturePaymentOrder($vendorOrderId);
            $order = $repository->setTransaction($vendorOrderId, PaymentSystem::PAYPAL, $this->convertStatus($result['status']));

            DB::commit();
            Cart::instance('cart')->destroy();

            return response()->json($order);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->handleException($e);
        }
    }

    protected function handleException(Exception $e)
    {
        logs()->warning($e);
        return response()->json(['error' => $e->getMessage()], 422);
    }

    protected function createPaymentOrder($total): array
    {
        return $this->paypalClient->createOrder([
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => config('paypal.currency'),
                        'value' => $total
                    ]
                ]
            ]
        ]);
    }

    protected function convertStatus(string $status): TransactionStatus
    {
        return match ($status) {
            "COMPLETED", "APPROVED" => TransactionStatus::SUCCESS,
            "CREATED", "SAVED" => TransactionStatus::PENDING,
            default => TransactionStatus::CANCELLED,
        };
    }
}
