<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'product_type';
    protected $guarded = [];
    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'product_type',
        'stock',
        'stock_price',
        'promotion_price',
    ];
}
