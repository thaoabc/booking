<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class password_resets extends Authenticatable
{
    protected $table='password_resets';
    
    protected $fillable = [
        'email','token',
    ];
    public $timestamps = true;

    protected $hidden = [];
}
