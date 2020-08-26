<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;
use App\Model\bill;
use Carbon\Carbon;

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
    public function orderMonth(Request $request)
    {
        $array['listYear'] = DB::table('bill')
            ->select(DB::raw('year(check_out) as getYear'))
            ->where('status', 3)
            ->groupBy('getYear')
            ->orderBy('getYear', 'DESC')
            ->get();
        $valueSelected = [];
        $orderYear = DB::table('bill')
            ->select(DB::raw('month(check_out) as getMonth'), DB::raw('day(check_out) as getDayOut'), DB::raw('day(check_in) as getDayIn'), DB::raw('SUM(total_billed) as value'), DB::raw('year(check_out) as getYear'))
            ->where('status', 3)
            ->groupBy('getMonth')
            ->groupBy('getYear')
            ->groupBy('getDayOut')
            ->groupBy('getDayIn')
            ->orderBy('getMonth', 'ASC')
            ->get();
        if (!empty($request->all())) {
            foreach ($orderYear as $year) {
                if ($year->getYear == $request['select_year'] && $year->getMonth == $request['select_month']) {
                    $valueSelected[] = $year;
                }
            }
            $result = collect($valueSelected);
            $selectedYear = $request['select_year'];
            $selectedMonth = $request['select_month'];
            return view('admins.page.chart.view_month', compact('result', 'selectedYear', 'selectedMonth'), $array);
        } else {
            $current_year = Carbon::now()->year;
            $current_month = Carbon::now()->month;
            foreach ($orderYear as $year) {
                if ($year->getYear == $current_year && $year->getMonth == $current_month) {
                    $valueSelected[] = $year;
                }
            }
            $result = collect($valueSelected);
            $selectedYear = $current_year;
            $selectedMonth = $current_month;
            return view('admins.page.chart.view_month', compact('result', 'selectedYear', 'selectedMonth'), $array);
        }
    }

    public function orderYear(Request $request)
    {
        $array['listYear'] = DB::table('bill')
            ->select(DB::raw('year(check_out) as getYear'))
            ->where('status', 3)
            ->groupBy('getYear')
            ->orderBy('getYear', 'ASC')
            ->get();
        $selectYear = [];
        $orderYear = DB::table('bill')
            ->select(DB::raw('month(check_out) as getMonth'), DB::raw('SUM(total_billed) as value'), DB::raw('year(check_out) as getYear'))
            ->where('status', 3)
            ->groupBy('getMonth')
            ->groupBy('getYear')
            ->orderBy('getMonth', 'ASC')
            ->get();
        if (!empty($request->all())) {
            foreach ($orderYear as $year) {
                if ($year->getYear == $request['select_year']) {
                    $selectYear[] = $year;
                }
            }
            $result = collect($selectYear);
            $selectedYear = $request['select_year'];
            return view('admins.page.chart.view_year', compact('result', 'selectedYear'), $array);
        } else {
            $current_year = Carbon::now()->year;
            foreach ($orderYear as $year) {
                if ($year->getYear == $current_year) {
                    $selectYear[] = $year;
                }
            }
            $result = collect($selectYear);
            $selectedYear = $current_year;
            return view('admins.page.chart.view_year', compact('result', 'selectedYear'), $array);
        }
    }
    public function line_chart(Request $request)
    {

        $array['listYear'] = DB::table('bill')
            ->select(DB::raw('year(check_out) as getYear'))
            ->where('status', 3)
            ->groupBy('getYear')
            ->orderBy('getYear', 'ASC')
            ->get();
        $selectYear = [];
        $orderYear = DB::table('bill')
            ->select(DB::raw('month(check_out) as getMonth'), DB::raw('SUM(total_billed) as value'), DB::raw('year(check_out) as getYear'))
            ->where('status', 3)
            ->groupBy('getMonth')
            ->groupBy('getYear')
            ->orderBy('getMonth', 'ASC')
            ->get();
        if (!empty($request->all())) {
            foreach ($orderYear as $year) {
                if ($year->getYear == $request['select_year']) {
                    $selectYear[] = $year;
                }
            }
            $result = collect($selectYear);
            return view('admins.page.chart.line-chart', compact('result'), $array);
        } else {
            $current_year = Carbon::now()->year;
            foreach ($orderYear as $year) {
                if ($year->getYear == $current_year) {
                    $selectYear[] = $year;
                }
            }
            $result = collect($selectYear);
            return view('admins.page.chart.line-chart', compact('result'), $array);
        }
    }
    
}
