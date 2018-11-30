<?php

namespace App\Listeners;

use App\Events\OrderCompliteEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class OrderCompliteListener // implements ShouldQueue
{
//    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderCompliteEvent  $event
     * @return void
     */
    public function handle(OrderCompliteEvent $event)
    {
        //
        $order = $event->order;

        Mail::to($order->partner->email)
            ->queue(new \App\Mail\OrderComplite($order));
        $vendors = collect();
        $order->products()->each(function ($item) use($order, &$vendors) {
            if (empty($vendors->where('id', '=', $item->vendor->id)->first()))
                $vendors->push($item->vendor);
        });

        $vendors->each(function($item) use($order) {
            Mail::to($item->email)
                ->queue(new \App\Mail\OrderComplite($order));
        });

    }
}
