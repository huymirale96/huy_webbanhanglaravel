<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
class ProductImage extends Model
{
    protected $table = 'product_image';
    protected $guarded = [];
    public $timestamps = false;
    public $fillable = [
        'product_id',
        'image',
    ];
}
