<?php

namespace App\Jobs;

use App\Enums\Roles;
use App\Models\Order;
use App\Models\User;
use App\Notifications\Orders\Created\OrderCreatedAdminNotification;
use App\Notifications\Orders\Created\OrderCreatedCustomerNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class OrderCreatedNotifyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Order $order)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logs()->info(self::class);
        $this->order->user->notify(new OrderCreatedCustomerNotification($this->order));
        Notification::send(User::role(Roles::ADMIN->value)->get(), new OrderCreatedAdminNotification($this->order));
    }
}
