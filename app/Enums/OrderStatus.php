<?php

namespace App\Enums;

enum OrderStatus: string
{
    case InProcess = 'In process';
    case Paid = 'Paid';
    case Completed = 'Completed';
    case Cancelled = 'Cancelled';

    public function findByKey(string $key): OrderStatus
    {
        $result = constant("self::$key");

        if ($result === null) {
            throw new \Exception("$key is not a valid order status");
        }

        return $result;
    }
}
