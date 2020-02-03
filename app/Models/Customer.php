<?php

namespace App\Models;


use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Customer extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'customers';
    protected $guarded = 'customers';
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'remember_token',
        'address',
        'token_expire',
        'ward_id',
        'token',
    ];

    public function order()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
