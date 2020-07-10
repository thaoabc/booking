<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class cate_room extends Model
{
    protected $table='cate_room';
    protected $fillable = [
        'id', 'name', 'price','image','describe',
    ];

    public $timestamps = false;
    protected $hidden = [];
}
