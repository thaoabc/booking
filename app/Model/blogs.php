<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class blogs extends Model
{
    protected $table='blogs';
    protected $fillable = [
        'id', 'name_blog','content',
    ];
    public $timestamps = true;

    protected $hidden = [];
}
