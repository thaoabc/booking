<?php

namespace App\Http\Controllers\Template\AuthUser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;

class LogoutController extends Controller
{
	public function logout()
	{
		Auth::logout();
		Session::forget('id');
		Session::forget('status_login');
		Session::flash('succes', 'Đăng xuất thành công!');
		return redirect()->route('index');
	}
}
