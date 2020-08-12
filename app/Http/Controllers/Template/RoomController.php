<?php

namespace App\Http\Controllers\Template;

use Illuminate\Routing\Controller as BaseController;
use App\Model\cate_room;
use App\Model\cate_blogs;
use App\Model\room;
use DB;
use App\Model\contact;

class RoomController extends BaseController
{
    public function category_room()
    {
        $cate_room = cate_room::paginate(10);
        $cate_blogs = cate_blogs::all();
        $contact = contact::find(1);
        return view('booking.pages.room.category_room', compact('cate_room', 'cate_blogs', 'contact'));
    }

    public function detail_cateroom($id)
    {
        $room = cate_room::where('id', $id)->first();
        $cate_room = cate_room::all();
        $cate_blogs = cate_blogs::all();
        $contact = contact::find(1);
        $amount_room = room::join('cate_room', 'cate_room.id', '=', 'room.cate_id')
            ->where('room.cate_id', $id)
            ->where('status', 1)
            ->count();
        return view("booking.pages.room.detail_cateroom", compact('room', 'cate_room','cate_blogs', 'amount_room', 'contact'));
    }
}
