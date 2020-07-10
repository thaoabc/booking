<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class bill extends Model
{
    protected $table='bill';
    protected $primaryKey='bill_id';
	 protected $fillable = [
        'id', 'user_id', 'check_in','check_out','status','total_billed',
    ];

    public $timestamps = false;
    protected $hidden = [];

     public function detailed_invoice()
    {
        return $this->hasMany('App\Model\detailed_invoice','bill_id');
    }

    public function users()
    {
         return $this->belongsTo('App\Model\users','id');
    }

    public function getTenTinhTrangAttribute($value)
    {
        switch ($this->status) {
            case '1':
                return "Phòng trống";
                break;
            case '2':
                return "Đã đặt";
                break;
            case '3':
                return "Tạm dừng sử dụng";
                break;
        }
    }
    public function chua_nhan_phong()
    {
        $bill = DB::table('bill')
            ->join('users','bill.user_id','=','users.id')
            ->where('bill.status',1)
            ->get();
        return $bill;
    }
    public function dang_su_dung()
    {
        $bill = DB::table('bill')
            ->join('users','bill.user_id','=','users.id')
            ->where('bill.status',2)
            ->simplePaginate(3);
        return $bill;
    }
    public function da_thanh_toan()
    {
        $bill = DB::table('bill')
        ->join('users','bill.user_id','=','users.id')
        ->where('bill.status',3)
        ->select('bill.*','users.name')
        ->get();
    return $bill;
    }
}
