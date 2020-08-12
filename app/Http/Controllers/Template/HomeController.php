<?php

namespace App\Http\Controllers\Template;

use Illuminate\Routing\Controller as BaseController;
use App\Model\cate_room;
use App\Model\services;
use App\Model\blogs;
use App\Model\cate_blogs;
use Session;
use App\Model\contact;

class HomeController extends BaseController
{
    public function welcome()
    {
        $cate_room = cate_room::all();
        $cate_blogs = cate_blogs::all();
        $services = services::all();
        $blogs= blogs::join('cate_blogs','cate_blogs.id','=','blogs.cate_id')
            ->get();
        $cate_room=cate_room::all();
        $contact =contact::find(1);
        if (empty(Session::has('status_login'))) {
            Session::put('status_login', 0);
        }
        return view('booking.index', compact('cate_room','services','blogs','cate_room','cate_blogs','contact'));
    }
}
