<?php

namespace App\Enums;

enum OrderStatus: string
{
    case IN_PROCESS = 'In process';
    case PAID = 'Paid';
    case COMPLETED = 'Completed';
    case CANCELLED = 'Cancelled';

    public function findByKey(string $key): OrderStatus
    {
        $result = constant("self::$key");

        if ($result === null) {
            throw new \Exception("$key is not a valid order status");
        }

        return $result;
    }
}
