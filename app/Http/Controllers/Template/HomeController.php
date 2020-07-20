<?php

namespace App\Http\Controllers\Template;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Model\Phong;
use App\Model\cate_room;
use DB;
use App\Http\Controllers\Controller;
use Session;

class HomeController extends BaseController
{
    public function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return redirect()->back();
    }
    public function welcome()
    {
        $amount_room['amount_room']=DB::table('room')
        ->join('cate_room','cate_room.id','=','room.cate_id')
        ->where('status',1)
        ->orderBy('room.cate_id')
        ->get();
        $array['cate_room'] = DB::table('cate_room')->paginate(4);
        return view('booking.index',$array);
    }
}
