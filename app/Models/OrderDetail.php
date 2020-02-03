<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    protected $fillable = [
        'order_id',
        'product_id',
        'product_type',
        'quantity',
        'price',
    ];
    public $timestamps = false;
}
