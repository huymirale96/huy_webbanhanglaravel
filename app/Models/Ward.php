<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'wards';

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
