<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Validator;
use App\Model\admin;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm($token)
    {
        $user = admin::where('password_reminder_token', $token)->first();
        if(!empty($user)){
            return view('auth.passwords.reset',['token'=>$token]);
        }
        else{
            echo "Không nên nha";
        }
       
    }

    public function reset(Request $request)
    {
        
        $input = $request->all();
        $token=$input['token'];
        $passwordReset = admin::where('password_reminder_token', $token)->firstOrFail();
        dd($passwordReset->updated_at);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return response()->json([
                'message' => 'Link đặt lại mật khẩu đã quá hạn',
            ], 422);
        }
        $rules = [
            'email' =>'required|email',
            'password' => 'required|min:6',
            'password_confirmation'=>'required_with:password|same:password|min:6'
        ];
        $messages = [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        
        
        if ($validator->fails()) {
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user = admin::where('email', $passwordReset->email)->firstOrFail();
            $user->password=bcrypt($input['password']);
            $user->save();

            Session::flash('success', 'Mật khẩu đã được thay đổi!');
            return view('auth.passwords.notice');
        }
    }
}
