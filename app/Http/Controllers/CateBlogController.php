<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Model\Phong;
use App\Model\cate_blog;
use Auth;
use Session;
use App;
use DB;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class CateBlogController extends Controller
{
    public function view_all()
    {
        // app()->setLocale('en');
        //  $list = cate_blog::all();
        //  echo '<pre>';
        //  print_r($list);
        //  dd();
        $array['cate_blog'] = cate_blog::all();
        return view('admins.page.cate_blog.list', $array);
    }

    public function view_insert()
    {

        if (Gate::allows('insert')) {
            return view('admins.page.cate_blog.add');
        } else {
            return view('admins.page.error_level');
        }
        // $user = Auth::user();
        // return view('admins.page.cate_blog.add');
        // if ($user->can('create', cate_blog::class)) {
        //     return view('cate_blog.view_insert');
        // }
        // else{
        //     Session::flash('error','Không có quyền truy cập!');
        //     return redirect('admin/cate_blog/view_all_cate_blog');
        // }

    }

    public function process_insert(Request $request)
    {
        // $cate_blog=new cate_blog();
        // $cate_blog->ten_cate_blog=Request::get('ten_cate_blog');
        // $cate_blog->gia=Request::get('gia');
        // $cate_blog->mo_ta=Request::get('mo_ta');
        // $cate_blog->process_insert();
        $cate_blog = new cate_blog();
        $rules = [
            'name_cateblog' => 'required',
        ];
        $messages = [
            'name_cateblog.required' => 'Tên admin là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect('admin/cate_blog/view_insert_cate_blog')->withErrors($validator)->withInput();
        } else {
            
            $cate_blog->name_cateblog = $request->input('name_cateblog');
            $cate_blog->slug = 1;

            //Storage::disk('public')->put('cate_blog', '$anh');
            $cate_blog->save();
            return redirect()->route('view_all_cate_blog');
        }
    }

    public function delete($id)
    {
        if (Gate::allows('delete')) {
            $cate_blog = new cate_blog();
            DB::table('cate_blog')->where('id', $id)->delete();
            return redirect()->route('view_all_cate_blog');
        } else {
            return view('admins.page.error_level');
        }
    }

    public function view_one($id)
    {
        if (Gate::allows('update')) {
            $cate_blog = new cate_blog();
            $cate_blog->id = $id;
            $array['cate_blog'] = cate_blog::find($id);
            return view('admins.page.cate_blog.edit', $array);
        } else {
            return view('admins.page.error_level');
        }
    }

    public function update(Request $request, $id)
    {
        $give_all = $request->all();
        $cate_blog = new cate_blog();
        $image_update = DB::table('cate_blog')->where('id', $id)->pluck('image');
        $rules = [
            'name_cateblog' => 'required',
        ];
        $messages = [
            'naname_cateblogme.required' => 'Tên admin là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {

            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect()->route('view_one_cate_blog', ['id' => $id])->withErrors($validator)->withInput();
        } else {
            $update =  $request->all();file_name = DB::table('cate_blog')->where('id', $id)->pluck('image')->first();
            }
            $cate_blog = cate_blog::where('id', $id)->first();
            $cate_blog->name_cateblog = $update['name_cateblog'];
            // $cate_blog->anh=Storage::disk('public')->put('cate_blog', '$anh');
            $cate_blog->save();
            // $cate_blog->ma_cate_blog=Request::get('ma_cate_blog');
            // $cate_blog->ten_cate_blog=Request::get('ten_cate_blog');
            // $cate_blog->gia=Request::get('gia');
            // $cate_blog->mo_ta=Request::get('mo_ta');
            // $cate_blog->update();
            return redirect()->route('view_all_cate_blog');
        }
    }
}
