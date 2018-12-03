<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Order extends Model
{
    //

    const STATUS_NEW        = 0;
    const STATUS_CURRENT    = 10;
    const STATUS_DONE       = 20;

    protected $table = 'orders';

    protected $fillable = [
        'status',
        'client_email',
        'partner_id',
        'delivery_dt'
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function($item) {
            switch ($item->status) {
                case 0:
                    // Событие на создание заказа
                    break;
            }

        });

        static::updated(function ($item) {
            switch ($item->status) {
                case 20:
                    // Событие на завершенеи заказа
                    event(new \App\Events\OrderCompliteEvent($item));
                    break;
                case 10:
                    //Событие на статсу 10
                    break;
            }
        });
    }

    public function items()
    {
        return $this->hasMany(\App\OrderProduct::class, 'order_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(\App\Product::class,
            'order_products',
            'order_id',
            'product_id',
            'id',
            'id'
        )->withPivot(['quantity', 'price']);
    }

    public function partner()
    {
        return $this->belongsTo(\App\Partner::class, 'partner_id', 'id');
    }

    public function amount()
    {
        return $this->products()->sum('order_products.price');
    }

    public function getAmountAttribute()
    {
        return $this->amount() / pow(10, 2);
    }

    public function getStateAttribute()
    {
        if ($this->status == self::STATUS_CURRENT && Carbon::createFromFormat('Y-m-d H:i:s', $this->delivery_dt)->timestamp < time()) {
            return 'overdue';
        }
        else if ($this->status == self::STATUS_CURRENT && Carbon::createFromFormat('Y-m-d H:i:s', $this->delivery_dt)->add(24, 'hour')->timestamp < time()) {
            return 'current';
        }
        else if ($this->status == self::STATUS_NEW && Carbon::createFromFormat('Y-m-d H:i:s', $this->delivery_dt)->timestamp > time()) {
            return 'new';
        }
        else if ($this->status == self::STATUS_DONE &&
            (
                Carbon::createFromFormat('Y-m-d H:i:s', $this->delivery_dt)->timestamp > strtotime(date('Y-m-d', time()) . ' 00:00:00')  &&
                Carbon::createFromFormat('Y-m-d H:i:s', $this->delivery_dt)->timestamp < strtotime(date('Y-m-d', time()) . ' 23:59:59')
            )) {
            return 'complite';
        }
        return false;

    }

    public static function getByState($state = 'all')
    {
        switch ($state) {
            case 'all':
            default:
                return self::orderBy('delivery_dt', 'DESC');
                break;
            case 'new':
                return self::where('delivery_dt', '>', Carbon::now()->timestamp)->where('status', self::STATUS_NEW)->orderBy('delivery_dt', 'ASC');
                break;
            case 'current':
                return self::whereRaw('ADDDATE(delivery_dt, INTERVAL +24 HOUR) < NOW()')->where('status', self::STATUS_CURRENT)->orderBy('delivery_dt', 'ASC');
                break;
            case 'complite':
                return self::where('status', self::STATUS_DONE)->whereRaw("delivery_dt BETWEEN CONCAT(DATE(NOW()), ' 00:00:00') AND CONCAT(DATE(NOW()), ' 23:59:59')")->orderBy('delivery_dt', 'DESC');
                break;
            case 'overdue':
                return self::where('delivery_dt', '<', Carbon::now()->timestamp)->where('status', self::STATUS_CURRENT)->orderBy('delivery_dt', 'DESC');
                break;

        }
    }

    public function saveAll($data = [])
    {
        $this->fill($data);
        $this->save();
//        $this->saveProducts($data);

    }

    public function saveProducts($data)
    {

        $this->products()->sync();
    }

    /**
     * @param array $data
     * @return \Illuminate\Validation\Validator;
     */
    public function getEditValidator($data = [])
    {
        return Validator::make($data, [
            'client_email'  => 'required|email',
            'partner_id'    => 'required|exists:partners,id',
            'status'        => 'required|in:0,10,20',
//            'products'      => 'array',
//            'products.*.id' => 'exists:products,id',
        ]);
    }



}
