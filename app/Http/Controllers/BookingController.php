<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Carbon\Carbon;
use DateTime;
use DB;
use App\Model\dat_phong;
use App\Model\loai_phong;
use App\Model\khach_hang;
use App\Model\bill;
use App\Model\bill_chi_tiet;
use App\Model\room;


class BookingController extends Controller
{
    public function view_dat_phong()
	{	
		$array_loai_phong['cate_room']=DB::table('cate_room')->get();
		return view('admins.page.booking.view_booking',$array_loai_phong);
	}

	public function view_phong(Request $request)
	{	
		$bill=new bill();
		$dt = Carbon::now();
		$day=$dt->addDay(1)->toDateString();
		$rules = [
            'check_in' =>'date|after:'.$day,
            'check_out' =>'required|after:check_in'
        ];
        $messages = [
            'check_in.required' => 'Ngày nhận phòng là trường bắt buộc',
            'check_in.after' => 'Ngày nhận phòng phải sau ngày hiện tại',
            'check_out.required' => 'Ngày trả phòng là trường bắt buộc',
            'check_out.after' => 'Ngày trả phòng phải sau ngày đặt phòng',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        
        
        if ($validator->fails()) {
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect('admin/dat_phong/view_dat_phong')->withErrors($validator)->withInput();
        } else {
			$give_inf =  $request->all();
			$cate_id=$request->input('cate_id');
			$check_in=$request->input('check_in');
	    	$check_out=$request->input('check_out');
	    	$array_date['array_date']=array(
	    		"check_in"  => $check_in,
				"check_out" => $check_out,
            );
			$bill = bill::whereDate('check_in','<=',$give_inf['check_in'])
							->whereDate('check_out','>=',$give_inf['check_out'])
							->whereIn('status',[1,2])
							->pluck('bill_id');
			if (($bill->count())==0){
				$array_room['room']=DB::table('room')
					->where('cate_id',$cate_id)
					->where('status',1)
					->get();
				// return  redirect()->route('view_phong',
				// 	['array_phong'=>$array_phong]
				// );
				return view('admins.page.booking.view_room',$array_room,$array_date);
			}
			else{
                $room=array();
				foreach ($bill as $bill) {
					$a = DB::table('bill')

						->select( "detailed_invoice.room_id" )             

						->join("detailed_invoice", "detailed_invoice.bill_id", "=", "bill.bill_id")

						->where('detailed_invoice.bill_id',$bill)

						->first();
					$room_id=$a->room_id;
					$room=DB::table('room')->whereNotIn('id',['$room_id'])
											->pluck('id');
				}
				
				$array_room['room']=DB::table('room')->where('cate_id',$cate_id)
									->whereIn('id',$room)
									->where('status',1)
									->get();
                return view('admins.page.booking.view_room',$array_room,$array_date);			
			}
		}
						
		
		// $comment = bill::find(1);
		// $ma_phong=$comment->bill_chi_tiet->ma_phong;
						
		
        // $bill->ngay_nhan_phong=$request->input('ngay_nhan_phong');
        // $loai_phong->ngay_tra_phong=$request->input('ngay_tra_phong');
        // $loai_phong->loai_phong=$request->input('loai_phong');
	}
	public function dat_phong(Request $request)
	{	
		$give_inf =  $request->all();
		$bill=new bill();
		$check_in=$give_inf['check_in'];
		$check_out=$give_inf['check_out'];

		$date1 = new DateTime($check_in);
	  	$date2 = new DateTime($check_out);
	  	$interval = $date1->diff($date2);

		$room_id=$give_inf['id'];
		$room=room::find($room_id)->cate_room;
		$cate_id=$room->pluck('id');
		$price=DB::table('cate_room')->where('id',$cate_id)
							->first()->price;
		$bill_id = DB::table('bill')->insertGetId([
            'user_id' => '1',
            'check_in' => $check_in,
            'check_out' => $check_out,
            'status'=> '1',
            'total_billed'=>$price*($interval->d)
        ]);

		// $detailed_invoice=new detailed_invoice();
		// $bill_chi_tiet->ma_bill=$ma_bill;
		// $bill_chi_tiet->ma_phong=$ma_phong;
		// $bill_chi_tiet->so_luong=1;
        // $bill_chi_tiet->save();
        DB::table('detailed_invoice')->insert([
            'bill_id' => $bill_id,
            'room_id' => $room_id,
        ]);

        return redirect()->to('admin/hoa_don/chua_nhan_phong');
	}
}
