<?php

namespace App\Http\Controllers\Template;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\contact;
use DB;

class ContactController extends BaseController
{
    public function view()
    {
        $array['contact'] = DB::table('contact')->find(1);
        return view('booking.pages.contact', $array);
    }

    public function detail_room($id)
    {
        $array_room['cate_room'] = DB::table('cate_room')->where('id', $id)->first();
        return view("booking.pages.room.detail_room", $array_room);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required'
        ];
        $messages = [
            'name.required' => 'Tên phòng là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            $give_all = $request->all();
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect()->route('view_one_phong', $id)->withErrors($validator)->withInput();
        } else {
            // $update =  $request->all();
            // $phong=phong::where('ma_phong','=',$update['ma_phong'])->first();
            // $phong->ma_phong=$update['ma_phong'];
            // $phong->ma_cate_room=$update['ma_cate_room'];
            // $phong->tinh_trang=$update['tinh_trang'];
            //   $phong->save();
            // $phong->ma_loai_phong=Request::get('ma_loai_phong');
            // $phong->tinh_trang=Request::get('tinh_trang');
            // $phong->update();
            DB::table('room')->where('id', $id)->update([
                'name' => $request->name,
                'cate_id' => $request->cate_id,
                'status' => $request->status,
            ]);
            return redirect()->route('view_all_phong');
        }
    }
}
