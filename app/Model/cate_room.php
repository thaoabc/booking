<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class cate_room extends Eloquent 
{
    protected $table='cate_room';
    protected $fillable = [
        'id','image','name','price','describe'
    ];

    public $timestamps = false;
    protected $hidden = [];
}
