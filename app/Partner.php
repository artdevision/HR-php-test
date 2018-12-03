<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    //
    protected $table = 'partners';

    protected $fillable = [
        'email',
        'name',
    ];

    public static function selectList()
    {
        return self::select(['id', 'email'])->get()->keyBy('id')->map(function($item) { return $item->name . " (" . $item->email . ")"; })->toArray();
    }
}
