<?php

namespace App\Http\Controllers\Template;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\contact;
use App\Model\users;
use App\Model\cate_room;
use DB;

class ContactController extends BaseController
{
    public function view()
    {
        $contact = DB::table('contact')->find(1);
        $cate_room=cate_room::all();
        return view('booking.pages.contact', compact('contact','cate_room'));
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
