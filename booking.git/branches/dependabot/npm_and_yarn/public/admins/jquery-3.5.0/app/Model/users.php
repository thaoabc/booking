<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $table='users';
    protected $fillable = [
        'id', 'name','phone','email','password',
    ];
    public $timestamps = false;

    protected $hidden = [];
}
