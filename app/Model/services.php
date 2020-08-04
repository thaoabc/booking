<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class services extends Model
{
    protected $table='services';
    protected $fillable = [
        'id', '_service','content','image',
    ];
    public $timestamps = false;

    protected $hidden = [];
}
