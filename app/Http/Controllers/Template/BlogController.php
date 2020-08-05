<?php

namespace App\Http\Controllers\Template;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Model\blogs;

class BlogController extends BaseController
{
    public function blog()
    {
        $array['blogs'] = blogs::join('cate_blogs','cate_blogs.id','=','blogs.cate_id')
            ->paginate(3);
        return view('booking.pages.blog.blog', $array);
    }

    public function detail_blog($id)
    {
        $array_blog['blogs'] = blogs::where('id', $id)->first();
        return view("booking.pages.blog.detail_blog", $array_blog);
    }
}
