<?php

namespace App\View\Components;

use Carbon\Carbon;
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

        $all_comp = Complaint::where('organization_id', $org_id)->count();
        $new_comp = Complaint::where('status_id', 0)->where('organization_id', $org_id)->count();
        $snt_comp = Complaint::where('status_id', 1)->where('organization_id', $org_id)->count();
        $rec_comp = Complaint::where('status_id', 2)->where('organization_id', $org_id)->count();
        $ctl_comp = Complaint::where('status_id', 3)->where('organization_id', $org_id)->count();
        $cnc_comp = Complaint::where('status_id', 4)->where('organization_id', $org_id)->count();
        $rtn_comp = Complaint::where('status_id', 5)->where('organization_id', $org_id)->count();
        $slv_comp = Complaint::where('status_id', 6)->where('organization_id', $org_id)->count();
        $exp_comp = Complaint::where('expire_date', '<=', Carbon::now())->where('organization_id', $org_id)->count();

        $ehzh_tog_count = Complaint::where('energy_type_id', 1)->where('organization_id', $org_id)->count();
        $ehzh_dulaan_count = Complaint::where('energy_type_id', 2)->where('organization_id', $org_id)->count();

        $compCategory = Complaint::from('complaints as c')
            ->select('ct.name', DB::raw('COUNT(c.id) as y'))
            ->leftJoin('categories as ct', 'c.category_id', '=', 'ct.id')
            ->where('c.organization_id', $org_id)
            ->groupBy('ct.name')
            ->get();
        $compCategoryCounts = json_encode($compCategory);
        // dd($data);

        $compType = Complaint::from('complaints as c')
            ->select('ct.name', DB::raw('COUNT(c.id) as y'))
            ->leftJoin('complaint_types as ct', 'c.complaint_type_id', '=', 'ct.id')
            ->where('c.organization_id', $org_id)
            ->groupBy('ct.name')
            ->get();
        $compTypeCounts = json_encode($compType);

        $compTypeMakers = Complaint::from('complaints as c')
            ->select('ct.name', DB::raw('COUNT(c.id) as y'))
            ->leftJoin('complaint_maker_types as ct', 'c.complaint_maker_type_id', '=', 'ct.id')
            ->where('c.organization_id', $org_id)
            ->groupBy('ct.name')
            ->get();
        $compTypeMakersCount = json_encode($compTypeMakers);

        $compChannels = Complaint::from('complaints as c')
            ->select('ct.name', DB::raw('COUNT(c.id) as y'))
            ->leftJoin('channels as ct', 'c.channel_id', '=', 'ct.id')
            ->where('c.organization_id', $org_id)
            ->groupBy('ct.name')
            ->get();
        $compChannelsCount = json_encode($compChannels);

        $compCounts = Complaint::select(DB::raw('EXTRACT(\'MONTH\' FROM complaint_date) AS published_month, COUNT(id) AS count'))
            ->where('organization_id', $org_id)
            ->whereRaw('date_part(\'year\', complaint_date) = date_part(\'year\', CURRENT_DATE)')
            ->groupBy(DB::raw('EXTRACT(\'MONTH\' FROM complaint_date)'))
            ->orderBy(DB::raw('EXTRACT(\'MONTH\' FROM complaint_date)'))
            ->get();
        $compCountsCurrentYear = json_encode($compCounts);

        $orgs_tog = Organization::select('name')->where('plant_id', 1)->orderBy('name', 'asc')->get();
        $orgs_dulaan = Organization::select('name')->where('plant_id', 2)->orderBy('name', 'asc')->get();
        // dd(json_encode($orgs));

        $compTzeTog = Complaint::from('complaints as c')
            ->select(DB::raw('o.NAME AS org_name, COUNT ( C.ID ) AS COUNT'))
            ->leftJoin('organizations as o', 'c.organization_id', '=', 'o.id')
            ->where('c.status_id', 6)
            ->groupBy('o.name')
            ->orderBy('o.name')
            ->get();
        $compTzeTogCounts = json_encode($compTzeTog);
        // dd($compTzeTogCounts);


        return view('components.dashboard-ehzh', ['all_comp' => $all_comp, 'new_comp' => $new_comp, 'snt_comp' => $snt_comp, 'rec_comp' => $rec_comp, 'ctl_comp' => $ctl_comp, 'rtn_comp' => $rtn_comp, 'slv_comp' => $slv_comp, 'cnc_comp' => $cnc_comp, 'exp_comp' => $exp_comp, 'ehzh_tog_count' => $ehzh_tog_count, 'ehzh_dulaan_count' => $ehzh_dulaan_count, 'compCategoryCounts' => $compCategoryCounts, 'compTypeCounts' => $compTypeCounts, 'compTypeMakersCount' => $compTypeMakersCount, 'compChannelsCount' => $compChannelsCount, 'compCountsCurrentYear' => $compCountsCurrentYear, 'orgs_dulaan' => $orgs_dulaan, 'orgs_tog' => $orgs_tog, 'compTzeTogCounts' => $compTzeTogCounts]);
    }
}
