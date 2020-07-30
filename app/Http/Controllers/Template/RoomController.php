<?php

namespace App\Http\Controllers\Template;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Model\Phong;
use App\Model\cate_room;
use App\Model\room;
use DB;

class RoomController extends BaseController
{
    public function category_room()
    {
        $array['cate_room'] = cate_room::paginate(3);
        return view('booking.pages.room.category_room', $array);
    }

    public function detail_cateroom($id)
    {
        $array_room['cate_room'] = cate_room::where('id', $id)->first();
        $amount_room['amount_room'] = room::join('cate_room', 'cate_room.id', '=', 'room.cate_id')
            ->where('room.cate_id', $id)
            ->where('status', 1)
            ->count();
        return view("booking.pages.room.detail_cateroom", $array_room, $amount_room);
    }
}
