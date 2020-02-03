<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';

    public function district()
    {
        return $this->hasMany(District::class);
    }
}
