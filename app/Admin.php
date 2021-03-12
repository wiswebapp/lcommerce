<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $table = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phonecode', 'phone', 'imgName','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->password = Hash::make($model->password);;
        });
        self::updating(function ($model) {
            $model->password = Hash::make($model->password);;
        });
    }
}
