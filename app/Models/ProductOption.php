<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
class ProductOption extends Model
{
    protected $table = 'product_option';
    protected $guarded = [];
    public $timestamps = false;
    public $fillable = [
        'product_id',
        'option_value',
        'option_name',
    ];
}
