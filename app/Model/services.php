<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class services extends Model
{
    protected $table='services';
    protected $fillable = [
        'id', 'name_service','content','image','name_class',
    ];
    public $timestamps = false;

    protected $hidden = [];
}
