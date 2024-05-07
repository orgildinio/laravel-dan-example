<?php

namespace App\View\Components;

use Carbon\Carbon;
use App\Models\Complaint;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class DashboardEhs extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $ehs_tog_count = Complaint::where('energy_type_id', 1)->count();
        $ehs_dulaan_count = Complaint::where('energy_type_id', 2)->count();

        $exp_comp = DB::table('complaints')
            ->where('expire_date', '<', now())
            ->where('status_id', '!=', 6)
            ->count();

        $ehs_category = Complaint::from('complaints as c')
            ->select('ct.name', DB::raw('COUNT(c.id) as y'))
            ->leftJoin('categories as ct', 'c.category_id', '=', 'ct.id')
            ->groupBy('ct.name')
            ->get();

        $ehs_status_count = DB::table('statuses as s')
            ->select('s.id as status_id', 's.name as name', DB::raw('COUNT(c.id) as y'))
            ->leftJoin('complaints as c', function ($join) {
                $join->on('s.id', '=', 'c.status_id');
            })
            ->whereNotIn('s.id', [7, 8])
            ->groupBy('s.id', 's.name')
            ->orderBy('s.id')
            ->get();

        $ehs_type_count = Complaint::from('complaints as c')
            ->select('ct.name', DB::raw('COUNT(c.id) as value'))
            ->leftJoin('complaint_types as ct', 'c.complaint_type_id', '=', 'ct.id')
            ->groupBy('ct.name')
            ->get();

        $ehs_maker_count = Complaint::from('complaints as c')
            ->select('ct.name', DB::raw('COUNT(c.id) as y'))
            ->leftJoin('complaint_maker_types as ct', 'c.complaint_maker_type_id', '=', 'ct.id')
            ->groupBy('ct.name')
            ->get();

        $ehs_month_count = Complaint::select(DB::raw('EXTRACT(\'MONTH\' FROM complaint_date) AS published_month, COUNT(id) AS count'))
            ->whereRaw('date_part(\'year\', complaint_date) = date_part(\'year\', CURRENT_DATE)')
            ->groupBy(DB::raw('EXTRACT(\'MONTH\' FROM complaint_date)'))
            ->orderBy(DB::raw('EXTRACT(\'MONTH\' FROM complaint_date)'))
            ->get();

        $ehs_channels_count = Complaint::from('complaints as c')
            ->select('ct.name', DB::raw('COUNT(c.id) as y'))
            ->leftJoin('channels as ct', 'c.channel_id', '=', 'ct.id')
            ->groupBy('ct.name')
            ->get();

        return view('components.dashboard-ehs', ['ehs_tog_count' => $ehs_tog_count, 'ehs_dulaan_count' => $ehs_dulaan_count, 'ehs_category' => $ehs_category, 'ehs_status_count' => $ehs_status_count, 'ehs_type_count' => $ehs_type_count, 'ehs_maker_count' => $ehs_maker_count, 'ehs_month_count' => $ehs_month_count, 'ehs_channels_count' => $ehs_channels_count, 'exp_comp' => $exp_comp]);
    }
}
