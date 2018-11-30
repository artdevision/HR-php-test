<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //

    public function index($state = 'all', Request $request)
    {
        $per_page = ($state == 'all') ? 25 : 50;
        $items = \App\Order::getByState($state)->paginate($per_page);
        return view('orders', ['items' => $items, 'state' => $state]);
    }

    public function edit($id, Request $request)
    {

    }
}
