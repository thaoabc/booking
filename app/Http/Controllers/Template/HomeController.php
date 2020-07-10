<?php

namespace App\Http\Controllers\Template;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Model\Phong;
use App\Model\cate_room;
use DB;
use App\Http\Controllers\Controller;
use Session;

class HomeController extends Controller
{
    public function changeLanguage($language)
{
    Session::put('website_language', $language);

    return redirect()->back();
}
}
