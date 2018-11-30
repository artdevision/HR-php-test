<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderComplite extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Order
     */
    protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        //
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject(trans('emails.order.subject', ['number' => $this->order->id]));
        return $this->markdown('emails.order_complite_partner', ['order' =>  $this->order]);
    }
}
