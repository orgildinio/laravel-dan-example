<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
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
