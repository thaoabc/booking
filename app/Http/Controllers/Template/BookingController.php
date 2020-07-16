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
        $day = $dt->toDateString();
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
            $amount = $give_inf['amount_room'];
            $check_in = $give_inf['check_in'];
            $check_out = $give_inf['check_out'];
            $date1 = new DateTime($check_in);
            $date2 = new DateTime($check_out);
            $interval = $date1->diff($date2);
            $price = DB::table('cate_room')->where('id', $cate_id)
                ->first()->price;
            $value_bill = array(
                'user_id' => 1,
                'check_in' => $date1,
                'check_out' => $date2,
                'day' => ($interval->d),
                'total_billed' => $price * ($interval->d) * $amount,
                'amount' => $amount,
                'status' => 1
            );
            $bill = bill::select('bill_id')
                ->whereDate('check_in', '<=', $date1)
                ->whereDate('check_out', '>=', $date2)
                ->whereIn('status', [1, 2])
                ->get();
            echo ($bill->pluck('bill_id')->all());
            dd(2);
            $bill_1 = bill::whereDate('check_in', '<=', $date2)
                ->whereDate('check_in', '>', $date1)
                ->whereIn('status', [1, 2])
                ->pluck('bill_id');
            $bill->push($bill_1->all());
            $bill_2 = bill::whereDate('check_out', '>=', $date1)
                ->whereDate('check_out', '<', $date2)
                ->whereIn('status', [1, 2])
                ->pluck('bill_id');
            $bill->push($bill_2);
            echo ($bill);
            dd(1);
            if (($bill->count()) == 0) {
                $array_room['room'] = DB::table('room')
                    ->where('cate_id', $cate_id)
                    ->where('status', 1)
                    ->pluck('id');
                $room_id = $array_room['room']->random($amount);
                $dat_phong = new BookingController();
                $dat_phong->dat_phong($value_bill, $room_id);
                Session::flash('success', 'Bạn đã đặt phòng thành công! Truy cập tài khoản và lịch sử để thấy');
                return redirect()->back();
            } else {
                foreach ($bill as $bill) {
                    $a = DB::table('bill')

                        ->select("detailed_invoice.room_id")

                        ->join("detailed_invoice", "detailed_invoice.bill_id", "=", "bill.bill_id")

                        ->where('detailed_invoice.bill_id', $bill)

                        ->first();
                    $room_id_selected[] = $a->room_id;
                }
                $array_room['room'] = DB::table('room')->whereNotIn('id', $room_id_selected)
                    ->where('cate_id', $cate_id)
                    ->where('status', 1)
                    ->pluck('id');
                if ($array_room['room']->count() != 0) {
                    if ($array_room['room']->count() < $amount) {
                        Session::flash('error', 'Chỉ còn ' . $array_room['room']->count() . ' phòng cho ngày mà bạn chọn!');
                        return redirect()->back();
                    } else {
                        $room_id = $array_room['room']->random($amount);
                        $dat_phong = new BookingController();
                        $dat_phong->dat_phong($value_bill, $room_id);

                        Session::flash('success', 'Bạn đã đặt phòng thành công! Truy cập tài khoản và lịch sử để thấy');
                        return redirect()->back();
                    }
                } else {
                    Session::flash('error', 'Phòng loại này cho ngày bạn chọn đã kín!');
                    return redirect()->back();
                }
            }
        }
    }
    public function dat_phong($value_bill, $room_id)
    {
        $bill_id = DB::table('bill')->insertGetId($value_bill);
        for ($i = 0; $i < $room_id->count(); $i++) {
            DB::table('detailed_invoice')->insert([
                'bill_id' => $bill_id,
                'room_id' => $room_id[$i],
            ]);
        }
    }
}
