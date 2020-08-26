<?php

namespace App\Http\Controllers\Template;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Model\blogs;
use App\Model\cate_room;
use App\Model\contact;
use App\Model\cate_blogs;
use DB;

class BlogController extends BaseController
{
    public function blog()
    {

        $blogs = blogs::select(DB::raw('blogs.id AS id'),DB::raw('blogs.created_at AS created_at'), 'name_blog', 'image', 'name_cateblog')
            ->join('cate_blogs', 'cate_blogs.id', '=', 'blogs.cate_id')
            ->paginate(9);
        $cate_room = cate_room::all();
        $cate_blogs = cate_blogs::all();
        $contact = contact::find(1);
        return view('booking.pages.blog.blog', compact('blogs', 'cate_room', 'cate_blogs', 'contact'));
    }
    public function type_blog($id_cateblog)
    {
        $blogs = blogs::select(DB::raw('blogs.id AS id'),DB::raw('blogs.created_at AS created_at'), 'name_blog', 'image', 'name_cateblog')
            ->join('cate_blogs', 'cate_blogs.id', '=', 'blogs.cate_id')
            ->where('cate_blogs.id', '=', $id_cateblog)
            ->get();
        $cate_room = cate_room::all();
        $cate_blogs = cate_blogs::all();
        $contact = contact::find(1);
        return view('booking.pages.blog.blog', compact('blogs', 'cate_room', 'cate_blogs', 'contact'));
    }

    public function detail_blog($id)
    {
        $blog = blogs::join('cate_blogs', 'cate_blogs.id', '=', 'blogs.cate_id')
            ->where('blogs.id', $id)->first();
        $blogs = blogs::select(DB::raw('blogs.id AS id'),DB::raw('blogs.created_at AS created_at'), 'name_blog', 'image', 'name_cateblog')
        ->join('cate_blogs', 'cate_blogs.id', '=', 'blogs.cate_id')
            ->paginate(3);
        $cate_room = cate_room::all();
        $cate_blogs = cate_blogs::all();
        $contact = contact::find(1);
        return view("booking.pages.blog.detail_blog", compact('blog', 'blogs', 'cate_blogs', 'cate_room', 'contact'));
    }
}
