<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class detailed_invoice extends Model
{
    protected $table='detailed_invoice';
	public $primaryKey=['bill_id','room_id'];

	 protected $fillable = [
        'bill_id', 'room_id',
    ];

    public $timestamps = false;
    protected $hidden = [];

     public function room()
    {
        return $this->belongsTo('App\Model\room','room_id');
    }
}
