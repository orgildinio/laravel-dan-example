<?php

namespace App\View\Components;

use Carbon\Carbon;
use App\Models\Status;
use App\Models\Complaint;
use App\Models\Organization;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardEhzh extends Component
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
        $org_id = Auth::user()->org_id;
        // $org_id = 99;

        // Get the date range from the request
        $start_date = request('startdate', Carbon::now()->subMonth()->toDateString());
        $end_date = request('enddate', Carbon::now()->toDateString());

        // If start_date is null, set it to 1 month before the current date
        $startDate = $start_date != null ? $start_date : Carbon::now()->subMonth()->toDateString();

        // If end_date is null, set it to the current date
        $endDate = $end_date != null ? $end_date : Carbon::now()->toDateString();

        $ehzh_tog_count = Complaint::where('energy_type_id', 1)->whereBetween('created_at', [$startDate, $endDate])->where('organization_id', $org_id)->count();
        $ehzh_dulaan_count = Complaint::where('energy_type_id', 2)->whereBetween('created_at', [$startDate, $endDate])->where('organization_id', $org_id)->count();

        $all_comp = Complaint::where('organization_id', $org_id)->whereBetween('created_at', [$startDate, $endDate])->count();
        // dd($all_comp);
        $new_comp = Complaint::where('status_id', 0)->where('organization_id', $org_id)->whereBetween('created_at', [$startDate, $endDate])->count();
        $snt_comp = Complaint::where('status_id', 1)->where('organization_id', $org_id)->whereBetween('created_at', [$startDate, $endDate])->count();
        $rec_comp = Complaint::where('status_id', 2)->where('organization_id', $org_id)->whereBetween('created_at', [$startDate, $endDate])->count();
        $ctl_comp = Complaint::where('status_id', 3)->where('organization_id', $org_id)->whereBetween('created_at', [$startDate, $endDate])->count();
        $cnc_comp = Complaint::where('status_id', 4)->where('organization_id', $org_id)->whereBetween('created_at', [$startDate, $endDate])->count();
        $rtn_comp = Complaint::where('status_id', 5)->where('organization_id', $org_id)->whereBetween('created_at', [$startDate, $endDate])->count();
        $slv_comp = Complaint::where('status_id', 6)->where('organization_id', $org_id)->whereBetween('created_at', [$startDate, $endDate])->count();
        $exp_comp = Complaint::where('expire_date', '<=', Carbon::now())->where('status_id', '!=', 6)->whereBetween('created_at', [$startDate, $endDate])->where('organization_id', $org_id)->count();

        $compCategoryCounts = Complaint::select('categories.name', DB::raw('COUNT(complaints.id) as y'))
            ->join('categories', 'complaints.category_id', '=', 'categories.id')
            ->where('complaints.organization_id', $org_id)
            ->whereBetween('complaints.created_at', [$startDate, $endDate])
            ->groupBy('categories.name')
            ->get()
            ->toJson();

        // Гомдлын тоо гомдлын төрлөөр
        $compSumType = Complaint::from('complaints as c')
            ->select('ct.name', DB::raw('COUNT(c.id) as value'))
            ->leftJoin('complaint_types as ct', 'c.complaint_type_id', '=', 'ct.id')
            ->where('c.organization_id', $org_id)
            ->whereBetween('c.created_at', [$startDate, $endDate])
            ->groupBy('ct.name')
            ->get();
        $compSumType = json_encode($compSumType);

        $compTypeMakers = Complaint::from('complaints as c')
            ->select('ct.name', DB::raw('COUNT(c.id) as y'))
            ->leftJoin('complaint_maker_types as ct', 'c.complaint_maker_type_id', '=', 'ct.id')
            ->where('c.organization_id', $org_id)
            ->whereBetween('c.created_at', [$startDate, $endDate])
            ->groupBy('ct.name')
            ->get();
        $compTypeMakersCount = json_encode($compTypeMakers);

        $compChannels = Complaint::from('complaints as c')
            ->select('ct.name', DB::raw('COUNT(c.id) as y'))
            ->leftJoin('channels as ct', 'c.channel_id', '=', 'ct.id')
            ->where('c.organization_id', $org_id)
            ->whereBetween('c.created_at', [$startDate, $endDate])
            ->groupBy('ct.name')
            ->get();
        $compChannelsCount = json_encode($compChannels);

        $compCounts = Complaint::select(DB::raw('EXTRACT(\'MONTH\' FROM created_at) AS published_month, COUNT(id) AS count'))
            ->where('organization_id', $org_id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->whereRaw('date_part(\'year\', created_at) = date_part(\'year\', CURRENT_DATE)')
            ->groupBy(DB::raw('EXTRACT(\'MONTH\' FROM created_at)'))
            ->orderBy(DB::raw('EXTRACT(\'MONTH\' FROM created_at)'))
            ->get();
        $compCountsCurrentYear = json_encode($compCounts);


        return view('components.dashboard-ehzh', ['all_comp' => $all_comp, 'new_comp' => $new_comp, 'snt_comp' => $snt_comp, 'rec_comp' => $rec_comp, 'ctl_comp' => $ctl_comp, 'rtn_comp' => $rtn_comp, 'slv_comp' => $slv_comp, 'cnc_comp' => $cnc_comp, 'exp_comp' => $exp_comp, 'ehzh_tog_count' => $ehzh_tog_count, 'ehzh_dulaan_count' => $ehzh_dulaan_count, 'compCategoryCounts' => $compCategoryCounts, 'compTypeMakersCount' => $compTypeMakersCount, 'compChannelsCount' => $compChannelsCount, 'compCountsCurrentYear' => $compCountsCurrentYear, 'compSumType' => $compSumType]);
    }
}