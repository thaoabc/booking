<?php

namespace App\Http\Controllers\Template;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Carbon\Carbon;
use DateTime;
use DB;
use Session;
use App\Model\dat_phong;
use App\Model\loai_phong;
use App\Model\khach_hang;
use App\Model\bill;
use App\Model\bill_chi_tiet;
use App\Model\room;


class BookingController extends BaseController
{
    public function view_dat_phong($user_id)
    {
        if ($user_id == 0) {
            Session::flash('error', 'Hãy chọn khách hàng trước khi đặt phòng!');
            return redirect('admin/users/view_all_user');
        } else {
            Session::put('user_id', $user_id);
            $array_loai_phong['cate_room'] = DB::table('cate_room')->get();
            return view('admins.page.booking.view_booking', $array_loai_phong);
        }
    }

    public function check_room(Request $request, $cate_id)
    {
        $bill = new bill();
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $day = $dt->subDay(1)->toDateString();
        $rules = [
            'check_in' => 'required|after:' . $day,
            'check_out' => 'required|after:check_in'
        ];
        $messages = [
            'check_in.required' => 'Ngày nhận phòng là trường bắt buộc',
            'check_in.after' => 'Ngày nhận phòng phải từ ngày hiện tại',
            'check_out.required' => 'Ngày trả phòng là trường bắt buộc',
            'check_out.after' => 'Ngày trả phòng phải sau ngày đặt phòng',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect()->route('room.detail_cateroom', $cate_id)->withErrors($validator)->withInput();
        } else {
            $give_inf =  $request->all();
            $check_in = $give_inf['check_in'];
            $check_out = $give_inf['check_out'];
            $date1 = new DateTime($check_in);
            $date2 = new DateTime($check_out);
            $bill = bill::whereDate('check_in', '<=', $date1)
                ->whereDate('check_out', '>=', $date2)
                ->whereIn('status', [1, 2])
                ->pluck('bill_id');
            if (($bill->count()) == 0) {
                dd($bill->count());
                $array_room['room'] = DB::table('room')
                    ->where('cate_id', $cate_id)
                    ->where('status', 1)
                    ->get();

                $interval = $date1->diff($date2);
                $room_id = $array_room['room']->random()->id;
                $price = DB::table('cate_room')->where('id', $cate_id)
                    ->first()->price;
                $value = array(
                    'user_id' => 1,
                    'check_in' => $date1,
                    'check_out' => $date2,
                    'day' => ($interval->d),
                    'total_billed' => $price * ($interval->d),
                    'room_id' => $room_id
                );
                $dat_phong = new BookingController();
                $dat_phong->dat_phong($value);
            } else {
                $room = array();
                foreach ($bill as $bill) {
                    $a = DB::table('bill')

                        ->select("detailed_invoice.room_id")

                        ->join("detailed_invoice", "detailed_invoice.bill_id", "=", "bill.bill_id")

                        ->where('detailed_invoice.bill_id', $bill)

                        ->first();
                    $room_id = $a->room_id;
                    $room = DB::table('room')->whereNotIn('id', [$room_id])
                        ->pluck('id');
                }
                $array_room['room'] = DB::table('room')->where('cate_id', $cate_id)
                    ->whereIn('id', $room)
                    ->where('status', 1)
                    ->get();
                if ($array_room['room']->count() != 0) {
                    dd($array_room['room']);
                    $interval = $date1->diff($date2);
                    $room_id = $array_room['room']->random()->id;
                    $price = DB::table('cate_room')->where('id', $cate_id)
                        ->first()->price;
                    $value = array(
                        'user_id' => 1,
                        'check_in' => $date1,
                        'check_out' => $date2,
                        'day' => ($interval->d),
                        'total_billed' => $price * ($interval->d),
                        'room_id' => $room_id
                    );
                    $dat_phong = new BookingController();
                    $dat_phong->dat_phong($value);
                } else {
                    Session::flash('error', 'Phòng loại này cho ngày bạn chọn đã kín!');
                    return redirect()->back();
                }
            }
        }


        // $comment = bill::find(1);
        // $ma_phong=$comment->bill_chi_tiet->ma_phong;


        // $bill->ngay_nhan_phong=$request->input('ngay_nhan_phong');
        // $loai_phong->ngay_tra_phong=$request->input('ngay_tra_phong');
        // $loai_phong->loai_phong=$request->input('loai_phong');
    }
    public function dat_phong($value)
    {
        $bill_id = DB::table('bill')->insertGetId([
            'user_id' => $value['user_id'],
            'check_in' =>  $value['check_in'],
            'check_out' =>  $value['check_out'],
            'day' =>  $value['day'],
            'status' => '1',
            'total_billed' =>  $value['total_billed']
        ]);


        DB::table('detailed_invoice')->insert([
            'bill_id' => $bill_id,
            'room_id' => $value['room_id'],
        ]);
        Session::flash('success', 'Bạn đã đặt phòng thành công! Truy cập tài khoản và lịch sử để thấy');
        return redirect()->back();
    }
}
