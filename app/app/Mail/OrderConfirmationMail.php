<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $items;

    public function __construct($order, $items)

    {
        $this->order = $order;
        $this->items = $items;
    }

    public function build()
    {
        return $this->from('hello@example.com', config('app.name'))
            ->subject('Спасибо за ваш заказ!')
            ->view('emails.order_confirmation')
            ->with([
                'order' => $this->order,
                'items' => $this->items,])
            ->withSwiftMessage(function ($message) {
                $message->getHeaders()
                    ->addTextHeader('Content-Type', 'text/html; charset=UTF-8');
            });
    }
}
