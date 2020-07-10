<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;
use App\Model\bill;

/**
 * 
 */
class ChartController extends BaseController
{
	// public function view_all()
	// {	
	// 	$array_hoa_don=hoa_don::where('tinh_trang','1')->get();
	// 	return view('chart.view_chart',['array_hoa_don'=>$array_hoa_don]);
	// }
	public function orderMonth()
    {
        $orderYear = DB::table('bill')
                    ->select(DB::raw('month(check_in) as getMonth'), DB::raw('SUM(total_billed) as value'),DB::raw('year(check_out) as getYear'))
                    ->where('status',3)
                    ->groupBy('getMonth')
                    ->groupBy('getYear')
                    ->orderBy('getMonth', 'ASC')
                    ->get();
        return view('admins.page.chart.view_month', compact('orderYear'));
    }

	public function orderYear()
    {
        $orderYear = DB::table('bill')
                    ->select(DB::raw('year(check_in) as getYear'), DB::raw('SUM(total_billed) as price'))
                    ->where('status',3)
                    ->groupBy('getYear')
                    ->orderBy('getYear', 'ASC')
                    ->get();
        return view('admins.page.chart.view_year', compact('orderYear'));
    }
}