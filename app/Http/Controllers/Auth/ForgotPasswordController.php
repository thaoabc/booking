<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Mail;
use Session;
use DB;
use App\Model\admins;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }
    public function sendResetLinkEmail(Request $request)
    {   
        $input = $request->all();
        $email=$input["email"];
        $user = admins::where('email', $email)->first();
        $token=Str::random(60);
        if (!empty($user)) {
            $password=DB::table('admins')->where('email',$email)->update([
                'password_reminder_token' => $token,
            ]);
        $password=DB::table('admins')->where('email',$email)->select('password_reminder_token')->first();
        $url = url('admin/password/reset/' . $password->password_reminder_token);
        $comment='<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" method="get" action='.$url.'>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Link reset password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>';
        Mail::send('mailfb', array('email'=>$input["email"],'content'=>$comment), function($message) use ($email){
            $message->to($email, 'Visitor')->subject('Visitor Feedback!');
        });
        Session::flash('success', 'Hãy xác nhận tin hệ thống đã gửi vào gmail của bạn!');
        return view('auth.passwords.notice');
        }
        else{
            $rules = [
                'email' =>'required|email'
            ];
            $messages = [
                'email.required' => 'Email là trường bắt buộc',
                'email.email' => 'Email không đúng định dạng',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            Session::flash('error', 'Email này chưa đăng ký tài khoản!');
            return redirect('admin/password/reset')->withErrors($validator)->withInput();
        }
        
    }
}
