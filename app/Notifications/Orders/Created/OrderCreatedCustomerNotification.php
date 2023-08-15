<?php

namespace App\Notifications\Orders\Created;

use App\Models\Order;
use App\Services\InvoicesService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Storage;

class OrderCreatedCustomerNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected InvoicesService $invoicesService)
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
    public function toMail(Order $order): MailMessage
    {
        $invoice = $this->invoicesService->generate($order);

        return (new MailMessage)
            ->subject('Order #' . $order->id . ' created')
            ->line('Your order has been created.')
            ->lineIf($order->status !== \App\Enums\OrderStatus::IN_PROCESS, 'Your order will be processed soon.')
            ->line('You can download your invoice here:')
            ->line('Download invoice in attachment')
            ->attach(Storage::disk('public')->path($invoice->filename), [
                'as'   => $invoice->filename,
                'mime' => 'application/pdf',
            ]);
    }
}
