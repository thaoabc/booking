<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Model\Phong;
use App\Model\cate_room;
use DB;

class ContactController extends Controller
{
    public function view_all()
    {
        $array['contact']=DB::table('contact')->get();
    	return view('admins.page.contact.list',$array);
    }

    public function view_insert()
    {	
        if(Gate::allows('insert')){
            $array['contact']=DB::table('contact')->get();
    	return view('admins.page.contact.add',$array);
        }
        else{
            return view('admins.page.error_level');
        }
        
    }

    public function process_insert(Request $request)
    {   
       // $phong=new phong();
        $rules = [
            'title' =>'required',
            'masothue'=>'required',
        ];
        $messages = [
            'title.required' => 'Tên là trường bắt buộc',
            'masothue'=>'Mã thuế là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        
        
        if ($validator->fails()) {
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect('contact/view_insert_contact')->withErrors($validator)->withInput();
        } else {
            // $phong->ma_cate_room=$request->input('ma_cate_room');
            // $phong->ten_phong=$request->input('ten_phong');
            // $phong->tinh_trang=1;
            // $phong->save();
            DB::table('contact')->insert([
                'title' => $request->title,
                'masothue' => $request->masothue,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'website' => $request->website,
                'active' =>1,
            ]);
        
            return redirect()->route('contact.list');
        }
    }

     public function view_one($id)
    {   
        if(Gate::allows('update')){
            $array_contact['contact'] = DB::table('contact')->where('id',$id)->first();
            // dd($array_phong);
            return view("admins.page.contact.edit",$array_contact);
        }
        else{
            return view('admins.page.error_level');
        }
       
    }

   public function update(Request $request,$id)
    {   
        $rules = [
            'title' =>'required'
        ];
        $messages = [
            'title.required' => 'Tên là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        
        
        if ($validator->fails()) {
            $give_all=$request->all();
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect()->route('view_one_contact',$id)->withErrors($validator)->withInput();
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
            DB::table('contact')->where('id',$id)->update([
                'title' => $request->title,
                'masothue' => $request->masothue,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'website' => $request->website,
                'active' =>1,
            ]);
            return redirect()->route('contact.list');
        }
    }
    public function delete($id)
    {   
        if(Gate::allows('delete')){
            DB::table('contact')->where('id',$id)->delete();
            return redirect()->route('contact.list');
        }
        else{
            return view('admins.page.error_level');
        }
    }
}
