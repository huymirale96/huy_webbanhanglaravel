<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewDetail extends Model
{
    use SoftDeletes;
    protected $table = 'news';
    public $fillable = [
        'name',
        'image',
        'content',
        'description',
        'content',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
