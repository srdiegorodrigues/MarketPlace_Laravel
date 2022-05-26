<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\User;
use App\UserOrder;
use Illuminate\Support\Facades\DB;

class GraphicController extends Controller
{

    public function users()
    {
        $users = User::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');
        $months  = User::select(DB::raw("Month(created_at) as month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('month');

        $datas = array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach ($months as $index => $month)
        {
            $datas[$month] = $users[$index];
        }
        return view('administrator.charts.users', compact('datas'));
    }

    public function orders()
    {
        $orders = UserOrder::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');

        $months = User::select(DB::raw("Month(created_at) as month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('month');

        $datas = array(0,0,0,0,0,0,0,0,0,0,0,0);


        foreach ($months as $index => $month)
        {
            $datas[$month] = $orders[$index];
        }


        return view('administrator.charts.orders', compact('datas'));
    }






}
