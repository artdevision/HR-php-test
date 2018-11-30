<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    //
    protected $table = 'order_products';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

    public function order()
    {
        return $this->belongsTo(\App\Product::class, 'product_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Order::class, 'order_id', 'id');
    }

}
