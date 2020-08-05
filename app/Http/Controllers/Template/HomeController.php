<?php

namespace App\Http\Controllers\Template;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Model\Phong;
use App\Model\cate_room;
use App\Model\services;
use App\Model\blogs;
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
        $cate_room = cate_room::all();
        $services = services::all();
        $blogs= blogs::join('cate_blogs','cate_blogs.id','=','blogs.cate_id')
            ->get();
        if (empty(Session::has('status_login'))) {
            Session::put('status_login', 0);
        }
        return view('booking.index', compact('cate_room','services','blogs'));
    }
}
