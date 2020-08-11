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
        // app()->setLocale('en');
        //  $list = cate_room::all();
        //  echo '<pre>';
        //  print_r($list);
        //  dd();
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
        // $user = Auth::user();
        // return view('admins.page.cate_room.add');
        // if ($user->can('create', cate_room::class)) {
        //     return view('cate_room.view_insert');
        // }
        // else{
        //     Session::flash('error','Không có quyền truy cập!');
        //     return redirect('admin/loai_phong/view_all_loai_phong');
        // }

    }

    public function process_insert(Request $request)
    {
        // $loai_phong=new loai_phong();
        // $loai_phong->ten_loai_phong=Request::get('ten_loai_phong');
        // $loai_phong->gia=Request::get('gia');
        // $loai_phong->mo_ta=Request::get('mo_ta');
        // $loai_phong->process_insert();
        $cate_room = new cate_room();
        $rules = [
            'name' => 'required',
            'price' => 'required|numeric',
            'describe' => 'required',
            'image' => 'required'
        ];
        $messages = [
            'name.required' => 'Tên admin là trường bắt buộc',
            'price.required' => 'Giá là trường bắt buộc',
            'price.numeric' => 'Giá phòng là số',
            'describe.required' => 'Mô tả là trường bắt buộc',
            'image.required' => 'Ảnh là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect('admin/loai_phong/view_insert_loai_phong')->withErrors($validator)->withInput();
        } else {
            if ($request->hasFile('image')) {

                $file = $request->file('image');

                $name = $file->getClientOriginalName();
                $file->move('assets/cate_room/', $name);
                $file_name = $name;
            }
            $cate_room->name = $request->input('name');
            $cate_room->price = $request->input('price');
            $cate_room->describe = $request->input('describe');
            $cate_room->image = $file_name;
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
            if (file_exists('assets/cate_room/' . $image_delete[0]) && $image_delete[0] != '') {
                unlink('assets/cate_room/' . $image_delete[0]);
            }
            DB::table('cate_room')->where('id', $id)->delete();
            return redirect()->route('view_all_loai_phong');
        } else {
            return view('admins.page.error_level');
        }
    }

    public function view_one($id)
    {
        Auth::shouldUse('admin');
        if (Gate::allows('update', Auth::guard('admin')->user())) {
            $cate_room = new cate_room();
            $cate_room->id = $id;
            $array['cate_room'] = cate_room::find($id);
            return view('admins.page.cate_room.edit', $array);
        } else {
            return view('admins.page.error_level');
        }
    }

    public function update(Request $request, $id)
    {
        $give_all = $request->all();
        $cate_room = new cate_room();
        $image_update = DB::table('cate_room')->where('id', $id)->pluck('image');
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
                if (file_exists('assets/cate_room/' . $image_update[0]) && $image_update[0] != '') {
                    unlink('assets/cate_room/' . $image_update[0]);
                }
                $file = $request->file('image');

                $name = $file->getClientOriginalName();
                $file->move('assets/cate_room/', $name);
                $file_name = $name;
            } else {
                $file_name = DB::table('cate_room')->where('id', $id)->pluck('image')->first();
            }
            $cate_room = cate_room::where('id', $id)->first();
            $cate_room->name = $update['name'];
            $cate_room->price = $update['price'];
            $cate_room->describe = $update['describe'];
            $cate_room->image = $file_name;
            // $cate_room->anh=Storage::disk('public')->put('cate_room', '$anh');
            $cate_room->save();
            // $loai_phong->ma_loai_phong=Request::get('ma_loai_phong');
            // $loai_phong->ten_loai_phong=Request::get('ten_loai_phong');
            // $loai_phong->gia=Request::get('gia');
            // $loai_phong->mo_ta=Request::get('mo_ta');
            // $loai_phong->update();
            return redirect()->route('view_all_loai_phong');
        }
    }
}
