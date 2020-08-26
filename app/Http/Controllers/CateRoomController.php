<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Model\Phong;
use App\Model\cate_room;
use Auth;
use Session;
use App;
use DB;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class CateRoomController extends Controller
{
    public function view_all()
    {
        $array['cate_room'] = cate_room::all();
        return view('admins.page.cate_room.list', $array);
    }

    public function view_insert()
    {
        Auth::shouldUse('admin');
        if (Gate::allows('insert', Auth::guard('admin')->user())) {
            return view('admins.page.cate_room.add');
        } else {
            return view('admins.page.error_level');
        }

    }

    public function process_insert(Request $request)
    {
        $cate_room = new cate_room();
        
        $image_update = DB::table('cate_room')->where('id', $id)->pluck('image');
        $image_update_detail = DB::table('cate_room')->where('id', $id)->pluck('image_detail');
        $rules = [
            'name' => 'required',
            'price' => 'required|numeric',
            'describe' => 'required',
            'image' => 'required',
            'image_detail' => 'required'
        ];
        $messages = [
            'name.required' => 'Tên admin là trường bắt buộc',
            'price.required' => 'Giá là trường bắt buộc',
            'price.numeric' => 'Giá phòng là số',
            'describe.required' => 'Mô tả là trường bắt buộc',
            'image.required' => 'Ảnh là trường bắt buộc',
            'image_detail.required' => 'Ảnh là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect('admin/loai_phong/view_insert_loai_phong')->withErrors($validator)->withInput();
        } else {
            if ($request->hasFile('image')) {

                $file = $request->file('image');

                $name = $file->getClientOriginalName();
                if (!file_exists('assets/cate_room/' . $name) && $name == '') {
                    $file->move('assets/cate_room/', $name);
                }
                $file_name = $name;
            }
            if ($request->hasFile('image_detail')) {
                $file = $request->file('image_detail');

                $name = $file->getClientOriginalName();
                if (!file_exists('assets/detail_room/' . $name) && $name == '') {
                    $file->move('assets/detail_room/', $name);
                }
                $file_name_detail = $name;
            }
            $cate_room->name = $request->input('name');
            $cate_room->price = $request->input('price');
            $cate_room->describe = $request->input('describe');
            $cate_room->image = $file_name;
            $cate_room->image_detail = $file_name_detail;
            $cate_room->created_at = now();

            //Storage::disk('public')->put('cate_room', '$anh');
            $cate_room->save();
            return redirect()->route('view_all_loai_phong');
        }
    }

    public function delete($id)
    {
        Auth::shouldUse('admin');
        if (Gate::allows('delete', Auth::guard('admin')->user())) {
            $cate_room = new cate_room();
            $image_delete = cate_room::find($id)->pluck('image');
            $image_delete_detail = cate_room::find($id)->pluck('image');
            DB::table('cate_room')->where('id', $id)->delete();
            return redirect()->route('view_all_loai_phong');
        } else {
            return view('admins.page.error_level');
        }
    }

    public function view_one($id)
    {
        $cate_room = new cate_room();
        $cate_room->id = $id;
        $array['cate_room'] = cate_room::find($id);
        return view('admins.page.cate_room.edit', $array);
    }

    public function update(Request $request, $id)
    {
        $give_all = $request->all();
        $cate_room = new cate_room();
        $rules = [
            'name' => 'required',
            'price' => 'required|numeric',
            'describe' => 'required',
        ];
        $messages = [
            'name.required' => 'Tên admin là trường bắt buộc',
            'price.required' => 'Giá là trường bắt buộc',
            'price.numeric' => 'Giá phòng là số',
            'describe.required' => 'Mô tả là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {

            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect()->route('view_one_loai_phong', ['id' => $id])->withErrors($validator)->withInput();
        } else {
            $update =  $request->all();
           
            if ($request->hasFile('image')) {
                
                $file = $request->file('image');

                $name = $file->getClientOriginalName();
                $file->move('assets/cate_room/', $name);
                $file_name = $name;
            } else {
                $file_name = DB::table('cate_room')->where('id', $id)->pluck('image')->first();
            }
            if ($request->hasFile('image_detail')) {
                $file = $request->file('image_detail');

                $name = $file->getClientOriginalName();
                $file->move('assets/detail_room/', $name);
                $file_name_detail = $name;
            } else {
                $file_name_detail = DB::table('cate_room')->where('id', $id)->pluck('image_detail')->first();
            }
            $cate_room = cate_room::where('id', $id)->first();
            $cate_room->name = $update['name'];
            $cate_room->price = $update['price'];
            $cate_room->describe = $update['describe'];
            $cate_room->image = $file_name;
            $cate_room->image_detail = $file_name_detail;
            $cate_room->save();
            return redirect()->route('view_all_loai_phong');
        }
    }
}
