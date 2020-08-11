<?php

namespace App\Http\Controllers\Template;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Model\blogs;
use App\Model\cate_room;
use DB;
use App\Model\contact;

class BlogController extends BaseController
{
    public function blog()
    {
        $blogs = blogs::select(DB::raw('blogs.id AS id'),'name_blog','image','name_cateblog')
        ->join('cate_blogs','cate_blogs.id','=','blogs.cate_id')
            ->get();
            $cate_room=cate_room::all();
            $contact = DB::table('contact')->find(1);
        return view('booking.pages.blog.blog', compact('blogs','cate_room','contact'));
    }

    public function detail_blog($id)
    {
        $blog = blogs::join('cate_blogs','cate_blogs.id','=','blogs.cate_id')
        ->where('blogs.id', $id)->first();
        $blogs=blogs::join('cate_blogs','cate_blogs.id','=','blogs.cate_id')
        ->paginate(3);
        $cate_room=cate_room::all();
        return view("booking.pages.blog.detail_blog", compact('blog','blogs','cate_room'));
    }
}
