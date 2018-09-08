<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'company_id',
        'order_items',
        'order_done',
        'time_to_finish',
        'city',
        'address',
        'delivery_boy_id',
        'time_delivered',
        'order_price',
        'order_profit',
    ];

    /**
     * Get the company that owns the order.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the employee boy delivery order.
     */
    public function deliveryBoy()
    {
        return $this->belongsTo(User::class, 'delivery_boy_id');
    }
}
