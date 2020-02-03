<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'brand_id',
        'content',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public $timestamps = true;

    public function brand()
    {
    	return $this->belongsTo(Brand::class, 'brand_id')->withTrashed();
    }

    public function product_relate()
    {
        return $this->hasMany(ProductRelate::class, 'product_id');
    }

    public function product_category()
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    public function product_image()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function product_option()
    {
        return $this->hasMany(ProductOption::class, 'product_id');
    }

    public function product_type()
    {
        return $this->hasMany(ProductType::class, 'product_id');
    }

    public function product_review()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }
}
