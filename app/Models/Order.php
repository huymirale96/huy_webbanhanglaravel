<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'ward_id',
        'customer_id',
        'address',
        'note',
        'status',
        'order_id',
        'pay_status',
        'payment_method',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, 'order_detail');
    }

    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }
}
