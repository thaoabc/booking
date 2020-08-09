<?php

namespace App\Http\Controllers\Template;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Model\users;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;
use App\Model\bill;
use App\Model\cate_room;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{

    public function profile()
    {
        $users = users::where('id', Auth::guard('user')->id())->first();
        $your_booking=cate_room::join('room','cate_room.id','=','room.cate_id')
        ->join('detailed_invoice','room.id','=','detailed_invoice.room_id')
        ->join('bill','bill.bill_id','=','detailed_invoice.bill_id')
        ->where('user_id','=',Auth::guard('user')->id())
        ->get();
        $cate_room=cate_room::all();
        return view('booking.pages.users.profile',compact('users','your_booking','cate_room'));
    }

    public function process_insert(Request $request)
    {
        // dd($request->all());
        $users = new users();
        // Kiểm tra dữ liệu nhập vào

        // $this->validate(
        //     $request,
        //     [
        //         'name' => 'required',
        //         'phone' => 'required|numeric',
        //         'email' => 'required|email',
        //         'identity_card' => 'required|numeric',
        //         'password' => 'required|min:6',
        //         'password_confirm' => 'required|same:password'
        //     ],
        //     [
        //         'name.required' => 'Tên users là trường bắt buộc',
        //         'phone.required' => 'Số điện thoại là trường bắt buộc',
        //         'phone.numeric' => 'Viết sai số điện thoại',
        //         'email.required' => 'Email là trường bắt buộc',
        //         'email.email' => 'Email không đúng định dạng',
        //         'identity_card.required' => 'Số chứng minh là trường bắt buộc',
        //         'identity_card.numeric' => 'Viết sai số chứng minh',
        //         'password.required' => 'Mật khẩu là trường bắt buộc',
        //         'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
        //         'password_confirm' => "Mật khẩu nhập lại phải giống mật khẩu trước"
        //     ]
        // );

        $email = DB::table('users')->pluck('email');
        $phone = DB::table('users')->pluck('phone');
        foreach ($email as $value) {
            if ($value == $request->input('email')) {
                Session::flash('errorRg', 'Tài khoản này đã tồn tại!');
                return redirect()->back()->withInput();
            }
        }
        foreach ($phone as $value) {
            if ($value == $request->input('phone')) {
                Session::flash('errorRg', 'Tài khoản này đã tồn tại!');
                return redirect()->back()->withInput();
            }
        }



        $users->name_user = $request->input('name');
        $users->phone = $request->input('phone');
        $users->email = $request->input('email');
        $users->password = bcrypt($request->input('password'));
        $users->identity_card = $request->input('identity_card');
        $users->status = 1;
        $users->save();
        Session::put('status_login', 1);
        return redirect()->route('index');
    }

    public function update(Request $request, $id)
    {
        $users = new users();
        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'identity_card' => 'required|numeric',
        ];
        $messages = [
            'name.required' => 'Tên users là trường bắt buộc',
            'phone.required' => 'Số điện thoại là trường bắt buộc',
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'identity_card.required' => 'Số chứng minh là trường bắt buộc',
            'identity_card.numeric' => 'Viết sai số chứng minh',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $give_all = $request->all();
            $b = (int)$id;
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect()->route('view_one_user', ['id' => $b])->withErrors($validator)->withInput();
        } else {
            $email_old = DB::table('users')->find($id)->email;
            $phone_old = DB::table('users')->find($id)->phone;

            if ($email_old == $request->input("email")) {
                if ($phone_old == $request->input("phone")) {
                    DB::table('users')->where('id', $id)->update([
                        'name_user' => $request->name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        'identity_card' => $request->identity_card,
                        'status' => 1,
                        'updated_at' => now(),
                    ]);
                } else {
                    $phone = DB::table('users')->select('phone')->pluck('phone');
                    foreach ($phone as $value) {
                        if ($value == $request->input('phone')) {
                            Session::flash('error', 'Tài khoản này đã tồn tại!');
                            return redirect()->route('view_one_user', ['id' => $id])->withInput();
                        }
                    }
                    DB::table('users')->where('id', $id)->update([
                        'name_user' => $request->name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        'identity_card' => $request->identity_card,
                        'status' => 1,
                        'updated_at' => now(),
                    ]);
                }
            } else {
                $email = DB::table('users')->select('email')->pluck('email');
                foreach ($email as $value) {
                    if ($value == $request->input('email')) {
                        Session::flash('error', 'Tài khoản này đã tồn tại!');
                        return redirect()->route('view_one_user', ['id' => $id])->withInput();
                    }
                }
                if ($phone_old == $request->input("phone")) {

                    DB::table('users')->where('id', $id)->update([
                        'name_user' => $request->name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        'identity_card' => $request->identity_card,
                        'status' => 1,
                        'updated_at' => now(),
                    ]);
                } else {
                    $phone = DB::table('users')->select('phone')->pluck('phone');
                    foreach ($phone as $value) {
                        if ($value == $request->input('phone')) {
                            Session::flash('error', 'Tài khoản này đã tồn tại!');
                            return redirect()->route('view_one_user', ['id' => $id])->withInput();
                        }
                    }

                    DB::table('users')->where('id', $id)->update([
                        'name_user' => $request->name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        'identity_card' => $request->identity_card,
                        'status' => 1,
                        'updated_at' => now(),
                    ]);
                }
            }
            return redirect()->route('view_all_user');
        }
    }

    public function delete($id)
    {
        $users = new users();
        if (Gate::allows('delete')) {
            users::find($id)->delete();
            return redirect()->route('view_all_user');
        } else {
            Session::flash('error', 'Không có quyền truy cập!');
            return redirect('users/view_all_users');
        }
    }
}
