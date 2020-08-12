<?php

namespace App\Http\Controllers\Template\AuthUser;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use Session;

class UserLoginController extends BaseController
{
    public  function postLogin(Request $request)
    {
        // Kiểm tra dữ liệu nhập vào
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        $messages = [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect()->route('index')->withErrors($validator)->withInput();
        } else {
            $arr = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];
            if(Auth::guard('user')->attempt($arr)) {
                // Kiểm tra đúng email và mật khẩu sẽ chuyển trang
                $user = Auth::guard('user')->id();
                Session::put('id',$user);
                Session::put('status_login',1);
                Session::flash('login_success', 'Đăng nhập thành công!');
               // Session::put('cap_do',Auth::user()->cap_do);
                return redirect()->route('index');
            } else {
                // Kiểm tra không đúng sẽ hiển thị thông báo lỗi
                Session::flash('login_faile', 'Email hoặc mật khẩu không đúng!');
                return redirect()->route('index');
            }
        }
    }
}
