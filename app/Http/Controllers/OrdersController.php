<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

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
        $order = Order::find($id);
        if (empty($order))
            abort(404);
        $view = ($request->isJson()) ? 'json.order_edit' : 'order_edit';
        if($request->getMethod() == 'POST') {
            $validator = $order->getEditValidator($request->all());
            if ($validator->fails())
                return view($view, ['model' => $order])->withErrors($validator);
            $order->saveAll($request->all());
        }
        return view($view, ['model' => $order]);
    }
}
