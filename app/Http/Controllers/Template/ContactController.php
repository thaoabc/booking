<?php

namespace App\Http\Controllers\Template;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\contact;
use App\Model\cate_blogs;
use App\Model\cate_room;

class ContactController extends BaseController
{
    public function view()
    {
        $contact = contact::find(1);
        $cate_room=cate_room::all();
        $cate_blogs=cate_blogs::all();
        return view('booking.pages.contact', compact('contact','cate_room','cate_blogs'));
    }

    public function send(Request $request)
    {
        $input = $request->all();
        contact::insert([
            "name_customer" => $input['name_users'],
            "email" => $input["email"],
            "content" => $input["content"],
        ]);
        Session::flash('success', 'Cảm ơn bạn đã đóng góp ý kiến, nhân viên của chúng tôi sẽ liên hệ với bạn sớm nhất có thể!');
        return redirect()->back();
    }
}
