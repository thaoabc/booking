<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Model\services;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;

class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function view_one($id)
    {
        $services = services::where('id', $id)->first();
        return view('admins.page.services.edit', ['services' => $services]);
    }

    public function view_all()
    {

        $array['services'] = services::all();
        return view('admins.page.services.list', $array);
    }
    public function view_insert()
    {
        return view('admins.page.services.create');
        //return view('users.view_insert');
    }

    public function process_insert(Request $request)
    {
        // dd($request->all());
        $services = new services();
        // Kiểm tra dữ liệu nhập vào

        $this->validate(
            $request,
            [
                'name_service' => 'required',
                'content' => 'required',
                'name_service' => 'required'
            ],
            [
                'name_service.required' => 'Tên dịch vụ là trường bắt buộc',
                'content.required' => 'Nội dung là trường bắt buộc',
                'name_service.required' => 'Tên class không được thiếu'
            ]
        );

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $name = $file->getClientOriginalName();
            $file->move('assets/service/', $name);
            $file_name = $name;
        }
        $services->name_service = $request->input('name_service');
        $services->content = $request->input('content');
        $services->name_class = $request->input('name_class');
        $services->image = $file_name;

        //Storage::disk('public')->put('cate_room', '$anh');
        $services->save();
        return redirect()->route('view_all_service');
    }

    public function update(Request $request, $id)
    {
        $services = new services();
        $image_update = DB::table('services')->where('id', $id)->pluck('image');
        $rules = [
            'name_service' => 'required',
            'content' => 'required',
            'name_service' => 'required'
        ];
        $messages = [
            'name_service.required' => 'Tên dịch vụ là trường bắt buộc',
            'content.required' => 'Nội dung là trường bắt buộc',
            'name_service.required' => 'Tên class không được thiếu'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $give_all = $request->all();
            $b = (int)$id;
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect()->route('view_one_service', ['id' => $b])->withErrors($validator)->withInput();
        } else {
            $update =  $request->all();

            if ($request->hasFile('image')) {
                if (file_exists('assets/service/' . $image_update[0]) && $image_update[0] != '') {
                    unlink('assets/service/' . $image_update[0]);
                }
                $file = $request->file('image');

                $name = $file->getClientOriginalName();
                $file->move('assets/service/', $name);
                $file_name = $name;
            } else {
                $file_name = DB::table('services')->where('id', $id)->pluck('image')->first();
            }
            $services = services::where('id', $id)->first();
            $services->name_service = $update['name_service'];
            $services->content = $update['content'];
            $services->name_class = $update['name_class'];
            $services->image = $file_name;
            $services->save();
            return redirect()->route('view_all_service');
        }
    }

    public function delete($id)
    {
        Auth::shouldUse('admin');
        if (Gate::allows('delete', Auth::guard('admin')->user())) {
            services::find($id)->delete();
            return redirect()->route('view_all_service');
        } else {
            Session::flash('error', 'Không có quyền truy cập!');
            return redirect('services/view_all_services');
        }
    }
}
