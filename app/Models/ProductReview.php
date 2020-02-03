<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductReview extends Model
{
    use SoftDeletes;

    protected $table = 'product_review';

    protected $fillable = [
        'product_id',
        'customer_id',
        'comment',
        'star'
    ];
}
