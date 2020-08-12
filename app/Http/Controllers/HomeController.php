<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Model\admins;
use Illuminate\Support\Str;
use App;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;
use Auth;

class HomeController extends Controller
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

    public function index()
    {
        return view('admins.dashboard');
    }

    public function changeLanguage($language)
    {
        Session::put('admin_language', $language);
        echo ($language);
        App::setLocale($language);
        //dd(app()->getLocale());
        return redirect()->back();
    }

    public function view_one($id)
    {
        Auth::shouldUse('admin');
        if (Gate::allows('update', Auth::guard('admin')->user())) {
            $admin = admins::find($id);
            return view('admins.page.admin.edit', ['admin' => $admin]);
        } else {
            Session::flash('error', 'Không có quyền truy cập!');
            return redirect('admin/view_all_admin');
        }

        exit;
    }

    public function view_all()
    {
        $array['admin'] = admins::all();
        return view('admins.page.admin.list', $array);
    }
    public function view_insert()
    {
        Auth::shouldUse('admin');
        if (Gate::allows('insert', Auth::guard('admin')->user())) {
            return view('admins.page.admin.create');
        } else {
            return view('admins.page.error_level');
        }
        //return view('admin.view_insert');
    }

    public function process_insert(Request $request)
    {
        // dd($request->all());
        $admin = new admins();
        // Kiểm tra dữ liệu nhập vào

        $this->validate(
            $request,
            [
                'name' => 'required',
                'phone' => 'required|numeric',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'password_confirm' => 'required|same:password'
            ],
            [
                'name.required' => 'Tên admin là trường bắt buộc',
                'phone.required' => 'Số điện thoại là trường bắt buộc',
                'phone.numeric' => 'Viết sai số điện thoại',
                'email.required' => 'Email là trường bắt buộc',
                'email.email' => 'Email không đúng định dạng',
                'password.required' => 'Mật khẩu là trường bắt buộc',
                'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
                'password_confirm' => "Mật khẩu nhập lại phải giống mật khẩu trước"
            ]
        );

        $email = DB::table('admins')->pluck('email');
        $phone = DB::table('admins')->pluck('phone');
        foreach ($email as $value) {
            if ($value == $request->input('email')) {
                Session::flash('error', 'Tài khoản này đã tồn tại!');
                return redirect('admin/view_insert_admin')->withInput();
            }
        }
        foreach ($phone as $value) {
            if ($value == $request->input('phone')) {
                Session::flash('error', 'Tài khoản này đã tồn tại!');
                return redirect('admin/view_insert_admin')->withInput();
            }
        }



        $admin->name = $request->input('name');
        $admin->phone = $request->input('phone');
        $admin->email = $request->input('email');
        $admin->password = bcrypt($request->input('password'));
        $admin->level = $request->input('level');
        $admin->status = 1;
        $admin->save();
        return redirect()->route('view_all_admin');
    }

    public function update(Request $request, $id)
    {
        $admin = new admins();
        $rules = [
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password'
        ];
        $messages = [
            'name.required' => 'Tên admin là trường bắt buộc',
            'phone.required' => 'Số điện thoại là trường bắt buộc',
            'phone.numeric' => 'Viết sai số điện thoại',
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
            'password_confirm' => "Mật khẩu nhập lại phải giống mật khẩu trước"
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $give_all = $request->all();
            $b = (int)$id;
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect()->route('view_one_admin', ['id' => $b])->withErrors($validator)->withInput();
        } else {
            $email_old = DB::table('admins')->find($id)->email;
            $phone_old = DB::table('admins')->find($id)->phone;

            if ($email_old == $request->input("email")) {
                if ($phone_old == $request->input("phone")) {
                    DB::table('admins')->where('id', $id)->update([
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        'level' => $request->level,
                        'status' => 1,
                        'updated_at' => now(),
                    ]);
                } else {
                    $phone = DB::table('admins')->select('phone')->pluck('phone');
                    foreach ($phone as $value) {
                        if ($value == $request->input('phone')) {
                            Session::flash('error', 'Tài khoản này đã tồn tại!');
                            return redirect()->route('view_one_admin', ['id' => $id])->withInput();
                        }
                    }
                    DB::table('admins')->where('id', $id)->update([
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        'level' => $request->level,
                        'status' => 1,
                        'updated_at' => now(),
                    ]);
                }
            } else {
                $email = DB::table('admins')->select('email')->pluck('email');
                foreach ($email as $value) {
                    if ($value == $request->input('email')) {
                        Session::flash('error', 'Tài khoản này đã tồn tại!');
                        return redirect()->route('view_one_admin', ['id' => $id])->withInput();
                    }
                }
                if ($phone_old == $request->input("phone")) {

                    DB::table('admin')->where('id', $id)->update([
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        'level' => $request->level,
                        'status' => 1,
                        'updated_at' => now(),
                    ]);
                } else {
                    $phone = DB::table('admin')->select('phone')->pluck('phone');
                    foreach ($phone as $value) {
                        if ($value == $request->input('phone')) {
                            Session::flash('error', 'Tài khoản này đã tồn tại!');
                            return redirect()->route('view_one_admin', ['id' => $id])->withInput();
                        }
                    }

                    DB::table('admin')->where('id', $id)->update([
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        'level' => $request->level,
                        'status' => 1,
                        'updated_at' => now(),
                    ]);
                }
            }
            return redirect()->route('view_all_admin');
        }
    }

    public function delete($id)
    {
        Auth::shouldUse('admin');
        if (Gate::allows('delete', Auth::guard('admin')->user())) {
            admins::find($id)->delete();
            return redirect()->route('view_all_admin');
        } else {
            Session::flash('error', 'Không có quyền truy cập!');
            return redirect('admin/view_all_admin');
        }
    }
}
