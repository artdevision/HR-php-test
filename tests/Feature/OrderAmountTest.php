<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderAmountTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {

        $order = \App\Order::orderByRaw("RAND()")->with('products')->first();

        $orders = \App\Order::getByState('complite')->paginate(10);

//        print_r($orders);
        $this->assertNotEmpty($order->amount);

    }
}
