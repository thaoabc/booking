<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class users extends Authenticatable
{
    protected $table='users';
    
    protected $fillable = [
        'id', 'name','phone','email','password',
    ];
    public $timestamps = false;

    protected $hidden = [];
}
