<?php

namespace App\View\Components;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Complaint;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardTzeShow extends Component
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
        $rec_comp = Complaint::where('status_id', 2)->where('organization_id', $org_id)->count();
        $ctl_comp = Complaint::where('status_id', 3)->where('organization_id', $org_id)->count();
        $slv_comp = Complaint::where('status_id', 6)->where('organization_id', $org_id)->count();
        $cnc_comp = Complaint::where('status_id', 4)->where('organization_id', $org_id)->count();
        $exp_comp = Complaint::where('expire_date', '<=', Carbon::now())->where('status_id', '!=', 6)->where('organization_id', $org_id)->count();

        $tze_tog_count = Complaint::where('energy_type_id', 1)->where('organization_id', $org_id)->count();
        $tze_dulaan_count = Complaint::where('energy_type_id', 2)->where('organization_id', $org_id)->count();

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

        $statusCount = DB::table('statuses as s')
            ->select('s.id as status_id', 's.name as status_name', DB::raw('COUNT(c.id) as status_count'))
            ->leftJoin('complaints as c', function ($join) {
                $join->on('s.id', '=', 'c.status_id')
                    ->where('c.organization_id', '=', Auth::user()->org_id);
            })
            ->whereNotIn('s.id', [7, 8])
            ->groupBy('s.id', 's.name')
            ->orderBy('s.id')
            ->get();


        return view('components.dashboard-tze-show', ['all_comp' => $all_comp, 'new_comp' => $new_comp, 'rec_comp' => $rec_comp, 'ctl_comp' => $ctl_comp, 'slv_comp' => $slv_comp, 'cnc_comp' => $cnc_comp, 'exp_comp' => $exp_comp, 'tze_tog_count' => $tze_tog_count, 'tze_dulaan_count' => $tze_dulaan_count, 'compCategoryCounts' => $compCategoryCounts, 'compTypeCounts' => $compTypeCounts, 'compTypeMakersCount' => $compTypeMakersCount, 'compChannelsCount' => $compChannelsCount, 'compCountsCurrentYear' => $compCountsCurrentYear, 'statusCount' => $statusCount]);
    }
}
