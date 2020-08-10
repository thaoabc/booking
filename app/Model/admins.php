<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class admins extends Authenticatable
{
    use Notifiable;
    
    protected $guard = 'admin';
    protected $table = 'admins';
    protected $fillable = [
        'id', 'name','phone','email','password',
    ];
    public $timestamps = false;

    protected $hidden = [];
}
