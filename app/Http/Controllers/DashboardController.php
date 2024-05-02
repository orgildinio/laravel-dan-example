<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $web = Complaint::where('channel_id', 1)->count();
        $utas = Complaint::where('channel_id', 2)->count();
        $email = Complaint::where('channel_id', 3)->count();
        $mobile = Complaint::where('channel_id', 4)->count();
        $bichgeer = Complaint::where('channel_id', 5)->count();
        $biychlen = Complaint::where('channel_id', 6)->count();

        $complaints_by_channels = DB::table('complaints')
            ->select(DB::raw('count(*)'))
            ->groupBy('channel_id')
            ->get();

        $complaints_by_months = DB::table('complaints')
            ->select(DB::raw('count(*)'))
            ->groupBy(DB::raw("date_part('month', created_at)"))
            ->get();

        $complaints_by_status = DB::table('complaints as c')
            ->join('statuses as s', 's.id', '=', 'c.status_id')
            ->select(DB::raw('count(c.*), s.name'))
            ->groupBy('s.id')
            ->get();

        return view('dashboard', compact('complaints_by_channels', 'complaints_by_months', 'complaints_by_status', 'web', 'utas', 'email', 'mobile', 'bichgeer', 'biychlen'));
    }
    public function dashboardEhzh()
    {
        return view('dashboard.ehzh');
    }
    public function dashboardTze()
    {
        return view('dashboard.tze');
    }
    public function dashboardEhs()
    {
        return view('dashboard.ehs');
    }
    public function dashboardTzeShow()
    {
        return view('dashboard.tzeShow');
    }
}
