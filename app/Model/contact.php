<?php

namespace App\Model;

use DB;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{	
    protected $table='contact';
    protected $fillable = [
        'id', 'title','masothue','address','phone','email','website','active',
    ];
    public $timestamps = false;

    protected $hidden = [];
    public function getTenTinhTrangAttribute($value)
    {
        switch ($this->tinh_trang) {
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
    public function view_all()
    {
        $room = DB::table('room')
	        ->join('cate_room','room.cate_id','=','cate_room.id')
	        ->simplePaginate(3);
        return $room;
    }
    public function cate_room()
    {
        return $this->belongsTo('App\Model\cate_room', 'cate_id');
    }

    // public function view_one()
    // {

    //     $phong = DB::table('phong')->where('ma_phong', $this->ma_phong)->first();
    //     // dd($phong);
    //     return $phong;
    // }

    // public function process_insert()
    // {
    //     DB::insert("insert into $this->table(ma_loai_phong,tinh_trang) values(?,?)",[$this->ma_loai_phong,$this->tinh_trang]);
    // }

    //  public function update()
    // {
    // 	DB::update("update $this->table set ma_loai_phong=?,tinh_trang=? where ma_phong=?",
    // 		[$this->ma_loai_phong,$this->tinh_trang,$this->ma_phong]);
    // }
}
