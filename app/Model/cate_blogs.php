<?php

namespace App\Model;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model as Eloquent;

class cate_blogs extends Eloquent 
{
    protected $table='cate_blogs';
    protected $fillable = [
        'id',
    ];

    public $timestamps = true;
    protected $hidden = [];
}
