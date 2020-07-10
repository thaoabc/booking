<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Request;
use App\Model\khach_hang;
use Session;
use Illuminate\support\facades\auth;

class khachhangController extends BaseController
{
   
      public function process_dang_nhap()
   {
         $khach_hang             = new khach_hang();
         $khach_hang ->email    = Request::get('email');
         $khach_hang ->mat_khau = Request::get('mat_khau');
         $khach_hang = $khach_hang -> dang_nhap();
         // dd($khach_hang);

         if(isset($khach_hang)){
            Session::put('ma_khach_hang', $khach_hang[0]->ma_khach_hang);
            Session::put('ten_khach_hang', $khach_hang[0]->ten_khach_hang);
            return redirect()->route('welcome');
         }
         else{
            return redirect()->back(); 
         }
         
   }
         public function process_dang_xuat()
   {
      session()->flush();
      return redirect()->route('welcome');
         
   }
      public function process_dang_ky()
   {
         $khach_hang                       = new khach_hang();
         $khach_hang -> ten_khach_hang     = Request::get('ten_khach_hang');
         $khach_hang -> email              = Request::get('email');
         $khach_hang -> so_dien_thoai      = Request::get('so_dien_thoai');
         $khach_hang -> mat_khau           = Request::get('mat_khau');
         $khach_hang -> dia_chi            = Request::get('dia_chi');
         $khach_hang -> gioi_tinh          = Request::get('gioi_tinh');
         $khach_hang -> ngay_sinh          = Request::get('ngay_sinh');

         $khach_hang = $khach_hang -> dang_ky();
         return redirect()->route('logins');
     
   }
      public function update()
   {
      return view('khach_hang.update_khach_hang');
   }
     public function process_update()
   {
         $khach_hang                       = new khach_hang();
         $khach_hang -> ten_khach_hang     = Request::get('ten_khach_hang');
         $khach_hang -> email              = Request::get('email');
         $khach_hang -> so_dien_thoai      = Request::get('so_dien_thoai');
         $khach_hang -> mat_khau           = Request::get('mat_khau');
         $khach_hang -> dia_chi            = Request::get('dia_chi');
         $khach_hang -> gioi_tinh          = Request::get('gioi_tinh');
         $khach_hang -> ngay_sinh          = Request::get('ngay_sinh');

         $khach_hang -> update();
     
   }
}
