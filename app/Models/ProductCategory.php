<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
class ProductCategory extends Model
{
    protected $table = 'product_category';
    protected $guarded = [];
    public $timestamps = false;
    public $fillable = [
        'product_id',
        'category_id'
    ];
}
