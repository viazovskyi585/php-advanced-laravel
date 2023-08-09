<?php

namespace App\Notifications\Orders\Created;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedAdminNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Order $order)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(): MailMessage
    {
        $message =  (new MailMessage)
            ->subject('New order created')
            ->greeting('Hello, admin!')
            ->line('New order has been created.')
            ->line('Order status: ' . $this->order->status->name->value)
            ->line('Order total: ' . $this->order->total_price);

        foreach ($this->order->products as $product) {
            $message->line($product->pivot->quantity . 'x ' . $product->title . ' - ' . $product->pivot->single_price . ' = ' . $product->pivot->quantity * $product->pivot->single_price);
        }

        $message->line('Customer: ' . $this->order->user->name . ' (' . $this->order->user->email . ')');

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
