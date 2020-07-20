<?php

namespace App\Model;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class cate_room extends Model
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
