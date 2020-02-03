<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
class ProductRelate extends Model
{
    protected $table = 'product_relate';
    protected $guarded = [];
    public $timestamps = false;
    public $fillable = [
        'product_id',
        'product_relate_id',
    ];
}
