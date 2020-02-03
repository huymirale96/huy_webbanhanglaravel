<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    public function ward()
    {
        return $this->hasMany(Ward::class, 'district_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
