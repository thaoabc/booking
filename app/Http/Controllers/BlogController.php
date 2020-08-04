<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Model\blog;
use App\Model\cate_blog;
use DB;

class BlogController extends Controller
{
    public function view_all()
    {
        $array['blog']=blog::get();
    	return view('admins.page.blog.list',$array);
    }

    public function view_insert()
    {	
        if(Gate::allows('insert')){
            $array['cate_blog']=cate_blog::all();
    	return view('admins.page.blog.add',$array);
        }
        else{
            return view('admins.page.error_level');
        }
        
    }

    public function process_insert_phong(Request $request)
    {   
       // $phong=new phong();
        $rules = [
            'name_blog' =>'required',
            'content' =>'required',
            'image' => 'required'
        ];
        $messages = [
            'name_blog.required' => 'Tên tin tức là trường bắt buộc',
            'content.required' => 'Nội dung là trường bắt buộc',
            'image.required' => 'Ảnh là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        
        
        if ($validator->fails()) {
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect('blogs/view_insert_blog')->withErrors($validator)->withInput();
        } else {
            if ($request->hasFile('image')) {

                $file = $request->file('image');

                $name = $file->getClientOriginalName();
                $file->move('assets/blog/', $name);
                $file_name = $name;
            }
            DB::table('blogs')->insert([
                'name_blog' => $request->name_blog,
                'cate_id' => $request->cate_id,
                'image' => $file_name,
                'content' => $request->content,
                'created_at' => now(),
            ]);
        
            return redirect()->route('view_all_blog');
        }
    }

     public function view_one($id)
    {   
        if(Gate::allows('update')){
            $array_blog['blog'] = DB::table('blogs')->where('id',$id)->first();
        
            $array_cate_blog['cate_blog']=DB::table('cate_blog')->get();
            // dd($array_phong);
            return view("admins.page.blog.edit",$array_cate_blog,$array_blog);
        }
        else{
            return view('admins.page.error_level');
        }
       
    }

   public function update(Request $request,$id)
    {   
        $rules = [
            'name' =>'required',
            'content' =>'required',
            'image' => 'required'
            
        ];
        $messages = [
            'name.required' => 'Tên phòng là trường bắt buộc',
            'content.required' => 'Nội dung là trường bắt buộc',
            'image.required' => 'Ảnh là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        
        
        if ($validator->fails()) {
            $give_all=$request->all();
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect()->route('view_one_blog',$id)->withErrors($validator)->withInput();
        } else {
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
            DB::table('blogs')->where('id',$id)->update([
                'name_blog' => $request->name_blog,
                'content' => $request->content,
                'image' => $file_name,
                'cate_id' => $request->cate_id,
                'status' => $request->status,
            ]);
            return redirect()->route('view_all_blog');
        }
    }
}
