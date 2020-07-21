<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Model\Phong;
use App\Model\cate_room;
use DB;

class RoomController extends Controller
{
    public function view_all()
    {
        $array['room']=DB::table('room')->get();
    	return view('admins.page.room.list',$array);
    }

    public function view_insert()
    {	
        if(Gate::allows('insert')){
            $array['cate_room']=cate_room::all();
    	return view('admins.page.room.add',$array);
        }
        else{
            return view('admins.page.error_level');
        }
        
    }

    public function process_insert_phong(Request $request)
    {   
       // $phong=new phong();
        $rules = [
            'name' =>'required'
        ];
        $messages = [
            'name.required' => 'Tên phòng là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        
        
        if ($validator->fails()) {
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect('phong/view_insert_phong')->withErrors($validator)->withInput();
        } else {
            // $phong->ma_cate_room=$request->input('ma_cate_room');
            // $phong->ten_phong=$request->input('ten_phong');
            // $phong->tinh_trang=1;
            // $phong->save();
            DB::table('room')->insert([
                'name' => $request->name,
                'cate_id' => $request->cate_id,
                'slug' =>1,
                'status' =>1,
            ]);
        
            return redirect()->route('view_all_phong');
        }
    }

     public function view_one($id)
    {   
        if(Gate::allows('update')){
            $array_room['room'] = DB::table('room')->where('id',$id)->first();
        
            $array_cate_room['cate_room']=DB::table('cate_room')->get();
            // dd($array_phong);
            return view("admins.page.room.edit",$array_cate_room,$array_room);
        }
        else{
            return view('admins.page.error_level');
        }
       
    }

   public function update(Request $request,$id)
    {   
        $rules = [
            'name' =>'required'
        ];
        $messages = [
            'name.required' => 'Tên phòng là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        
        
        if ($validator->fails()) {
            $give_all=$request->all();
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect()->route('view_one_phong',$id)->withErrors($validator)->withInput();
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
            DB::table('room')->where('id',$id)->update([
                'name' => $request->name,
                'cate_id' => $request->cate_id,
                'status' => $request->status,
            ]);
            return redirect()->route('view_all_phong');
        }
    }
}
