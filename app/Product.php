<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'vendor_id',
    ];

    public function vendor()
    {
        return $this->belongsTo(\App\Vendor::class, 'vendor_id', 'id');
    }
}
