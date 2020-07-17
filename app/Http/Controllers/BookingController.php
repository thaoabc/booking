<?php

namespace App\Http\Controllers;

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
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class BookingController extends Controller
{
	public function view_dat_phong($user_id)
	{
		if ($user_id == 0) {
			Session::flash('error', 'Hãy chọn khách hàng trước khi đặt phòng!');
			return redirect('admin/users/view_all_user');
		} else {
			Session::put('user_id', $user_id);
			$array_loai_phong['cate_room'] = DB::table('cate_room')->get();
			$var_user_id['user_id'] = $user_id;
			return view('admins.page.booking.view_booking', $array_loai_phong, $var_user_id);
		}
	}

	public function check_phong(Request $request)
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
			return redirect()->route('view_dat_phong',Session('user_id'))->withErrors($validator)->withInput();
		} else {
			$give_inf =  $request->all();
			$amount = $give_inf['amount_room'];
			$cate_id=$give_inf['cate_id'];
			$check_in = $give_inf['check_in'];
			$check_out = $give_inf['check_out'];
			$date1 = new DateTime($check_in);
			$date2 = new DateTime($check_out);
			$interval = $date1->diff($date2);
			$price = DB::table('cate_room')->where('id', $cate_id)
				->first()->price;
			$value_bill = array(
				'user_id' => Session('user_id'),
				'check_in' => $date1,
				'check_out' => $date2,
				'day' => ($interval->d),
				'total_billed' => $price * ($interval->d) * $amount,
				'amount' => $amount,
				'status' => 1
			);
			$bill_0 = bill::whereDate('check_in', '<=', $date1)
                ->whereDate('check_out', '>=', $date2)
                ->whereIn('status', [1, 2])
                ->pluck('bill_id')
                ->all();
            $bill_1 = bill::whereDate('check_in', '<=', $date2)
                ->whereDate('check_in', '>=', $date1)
                ->whereIn('status', [1, 2])
                ->pluck('bill_id')
                ->all();
            $bill = array_merge($bill_0, $bill_1);
            $bill_2 = bill::whereDate('check_out', '>=', $date1)
                ->whereDate('check_out', '<=', $date2)
                ->whereIn('status', [1, 2])
                ->pluck('bill_id')
                ->all();
            $bill = array_merge($bill, $bill_2);
			if (count($bill) == 0) {
				$array_room['room'] = DB::table('room')
					->where('cate_id', $cate_id)
					->where('status', 1)
					->pluck('id');
				if ($array_room['room']->count() < $amount) {
					Session::flash('error', 'Chỉ còn ' . $array_room['room']->count() . ' phòng cho ngày mà bạn chọn!');
					return redirect()->back();
				} else {
					$room_id = $array_room['room']->random($amount);
					$dat_phong = new BookingController();
					$dat_phong->dat_phong($value_bill, $room_id);

					Session::flash('success', 'Bạn đã đặt phòng thành công!');
					$request->session()->forget('user_id');

					return redirect()->to('admin/hoa_don/chua_nhan_phong');
				}
			} else {
				$room_id_selected=array();
                foreach ($bill as $bill) {
                    if (empty($bill) || $bill == null || $bill == "") {
                    } else {
                        $a = DB::table('bill')

                            ->select("detailed_invoice.room_id")

                            ->join("detailed_invoice", "detailed_invoice.bill_id", "=", "bill.bill_id")

                            ->where('detailed_invoice.bill_id', $bill)

                            ->pluck('detailed_invoice.room_id')
                            
                            ->all();
                        $room_id_selected=array_merge($room_id_selected,$a);
                    }
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

						Session::flash('success', 'Bạn đã đặt phòng thành công!');
						$request->session()->forget('user_id');

						return redirect()->to('admin/hoa_don/chua_nhan_phong');
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
