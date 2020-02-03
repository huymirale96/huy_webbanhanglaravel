<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;
    protected $table = 'brands';
    public $fillable = [
        'name',
        'slug',
        'logo',
        'description',
        'status',
    ];

    protected $dates = ['deleted_at'];
}
