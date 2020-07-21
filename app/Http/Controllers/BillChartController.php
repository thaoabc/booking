<?php

namespace App\Http\Controllers;

use App\Charts\BillChart;
use Illuminate\Http\Request;

class BillChartController extends Controller
{
    public function index()
    {
        $billsChart = new BillChart;
        $billsChart->labels(['Jan', 'Feb', 'Mar']);
        $billsChart->dataset('Users by trimester', 'line', [10, 25, 13]);
       // dd($billsChart);
        return view('admins.page.chart.bill_chart', compact('billsChart') );
    }
}
