<?php

namespace Database\Seeders;

use App\Enums\OrderStatus as EnumsOrderStatus;
use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (EnumsOrderStatus::cases() as $status) {
            OrderStatus::firstOrCreate([
                'name' => $status,
            ]);
        }
    }
}
