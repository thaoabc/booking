<?php

namespace App\Model;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model as Eloquent;

class cate_room extends Eloquent 
{
    use Translatable;
    protected $table='cate_room';
    protected $fillable = [
        'id','image',
    ];

  public $translatedAttributes = ['name','price','describe'];

    public $timestamps = false;
    protected $hidden = [];
}
