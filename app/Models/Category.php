<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'icon',
        'created_at',
        'updated_at',
    ];

    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_category');
    }
}
