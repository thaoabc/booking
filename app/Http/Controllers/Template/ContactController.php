<?php

namespace App\Http\Controllers\Template;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\contact;
use App\Model\users;
use DB;

class ContactController extends BaseController
{
    public function view()
    {
        $array['contact'] = DB::table('contact')->find(1);
        return view('booking.pages.contact', $array);
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
