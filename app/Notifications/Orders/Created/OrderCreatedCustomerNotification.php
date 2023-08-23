<?php

namespace App\Notifications\Orders\Created;

use App\Models\Order;
use App\Services\InvoicesService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use LaravelDaily\Invoices\Invoice;
use NotificationChannels\Telegram\TelegramMessage;
use Storage;

class OrderCreatedCustomerNotification extends Notification
{
    use Queueable;

    protected Invoice $invoice;

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
    public function via(Order $order): array
    {
        return $order?->user?->telegram_id ? ['mail', 'telegram'] : ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(Order $order): MailMessage
    {
        $this->invoice = $this->getInvoice($order);

        return (new MailMessage)
            ->subject('Order #' . $order->id . ' created')
            ->line('Your order has been created.')
            ->lineIf($order->status !== \App\Enums\OrderStatus::IN_PROCESS, 'Your order will be processed soon.')
            ->line('You can download your invoice here:')
            ->line('Download invoice in attachment')
            ->attach(Storage::disk('public')->path($this->invoice->filename), [
                'as'   => $this->invoice->filename,
                'mime' => 'application/pdf',
            ]);
    }

    /**
     * Get the telegram representation of the notification.
     */
    public function toTelegram(Order $order): TelegramMessage
    {
        $this->invoice = $this->getInvoice($order);

        return TelegramMessage::create()
            ->to($order->user->telegram_id)
            ->content("Hello, $order->first_name $order->last_name!")
            ->line('Your order was created!')
            ->line('Order ID: ' . $order->id)
            ->line('You can download your invoice here:')
            ->button('Download invoice', $this->invoice->url());
    }

    protected function getInvoice(Order $order): Invoice
    {
        if (isset($this->invoice)) {
            return $this->invoice;
        } else {
            return $this->invoicesService->generate($order);
        }
    }
}
