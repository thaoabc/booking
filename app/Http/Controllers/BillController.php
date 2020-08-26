<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use App\Model\bill;
use App\Model\cate_room;
use App\Model\room;
use DB;
use Session;

class BillController extends Controller
{   
    public function getDay($status)
    {
        //dd($interval);
        $array_date=array(
            "status" => $status,
        );

        return $array_date;
    }
    public function chua_nhan_phong()
    {
        $bill=new bill();
        //getdate
        $interval = $this->getDay('1');
        
        $array_bill=$bill->chua_nhan_phong();
        return view('admins.page.bill.list',['array_bill'=>$array_bill],['day'=>$interval]);
    }
    public function dang_su_dung()
    {
        $bill=new bill();
        //getdate
        $interval = $this->getDay('2');
        $array_bill=$bill->dang_su_dung();

        return view('admins.page.bill.list',['array_bill'=>$array_bill],['day'=>$interval]);
    }
    public function da_thanh_toan()
    {
        $bill=new bill();
        //getdate
        $interval = $this->getDay(3);
        $array_bill=$bill->da_thanh_toan();

        return view('admins.page.bill.list',['array_bill'=>$array_bill],['day'=>$interval]);
    }
    public function xac_nhan($bill_id)
    {   
        $bill=new bill();
        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $check_in=bill::find($bill_id)->check_in;
        if($check_in>$now){
            Session::flash('error','Chưa đến ngày nhận phòng');
            return redirect('admin/hoa_don/chua_nhan_phong')->withInput();
        }
        

        DB::table('bill')->where('bill_id',$bill_id)
        		->update(['status'=>2]);
        return redirect()->route('dang_su_dung');
    }
    public function dung_thue($bill_id)
    {
        $bill=new bill();
        //date
        $check_in=bill::find($bill_id)->check_in;
        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $date1 = new DateTime($check_in);
        $date2 = new DateTime($now);
        $interval = $date1->diff($date2);

        //price

        $a = DB::table('bill')

            ->select( "detailed_invoice.room_id" )             

            ->join("detailed_invoice", "detailed_invoice.bill_id", "=", "bill.bill_id")

            ->where('detailed_invoice.bill_id',$bill_id)

            ->first();
        $room_id=$a->room_id;
        
        $price=room::find($room_id)->cate_room->first()->price;
        
        //end
        if(($interval->d)<1){
            DB::table('bill')->where('bill_id',$bill_id)->update([
                'check_in' =>$date1,
                'check_out' =>$date2,
                'status'=>3,
                'total_billed'=>$price
            ]);
        }
        else{
            DB::table('bill')->where('bill_id',$bill_id)->update([
                'check_in' =>$date1,
                'check_out' =>$date2,
                'status'=>3,
                'total_billed'=>$price*($interval->d)
            ]);
        }
        return redirect()->route('da_thanh_toan');
    }
    public function thanh_toan($bill_id)
    {
        $bill=new bill();
        bill::where('bill_id',$bill_id)
                ->update(['status'=>3]);
        return redirect()->route('da_thanh_toan');
    }
    public function thue_tiep(Request $request)
    {
        $give_inf =  $request->all();
        $bill_id=$give_inf['bill_id'];
        $bill=new bill();
        //date
        $check_in=bill::find($bill_id)->check_in;
        $check_out = $give_inf['check_out'];
        $date1 = new DateTime($check_in);
        $date2 = new DateTime($check_out);
        $interval = $date1->diff($date2);

        //price

        $a = DB::table('bill')

            ->select( "detailed_invoice.room_id" )             

            ->join("detailed_invoice", "detailed_invoice.bill_id", "=", "bill.bill_id")

            ->where('detailed_invoice.bill_id',$bill_id)

            ->first();
        $room_id=$a->room_id;
        
        $price=room::find($room_id)->cate_room->first()->price;
        //amount

        $amount=bill::where('bill_id', $bill_id)->first()->amount;
        //end
        $bill = bill::where('bill_id', $bill_id)->first();
        $bill->check_out = $check_out;
        $bill->day = $interval->d;
        $bill->total_billed = $price * ($interval->d) * $amount;
        $bill->save();
        return redirect()->route('dang_su_dung');
    }

    public function chi_tiet($bill_id){
        $detail_bill=cate_room::select('name_user','email','phone','name','price','name_room','check_in','check_out','day','amount','total_billed','bill.status as status')
         ->join('room','cate_room.id','=','room.cate_id')
        ->join('detailed_invoice','room.id','=','detailed_invoice.room_id')
        ->join('bill','bill.bill_id','=','detailed_invoice.bill_id')
        ->join('users','bill.user_id','=','users.id')
        ->where('bill.bill_id','=',$bill_id)
        ->first();
        return view('admins.page.bill.detail',['detail_bill'=>$detail_bill]);
    }
}
