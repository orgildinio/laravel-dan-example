<?php

namespace App\View\Components;

use Carbon\Carbon;
use App\Models\Status;
use App\Models\Complaint;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class DashboardTze extends Component
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
        $tze_tog = Complaint::where('energy_type_id', 1)->whereNotIn('organization_id', [99])->count();
        $tze_dulaan = Complaint::where('energy_type_id', 2)->whereNotIn('organization_id', [99])->count();

        $new_comp = Complaint::where('status_id', 0)->whereNotIn('organization_id', [99])->count();
        $snt_comp = Complaint::where('status_id', 1)->whereNotIn('organization_id', [99])->count();
        $rec_comp = Complaint::where('status_id', 2)->whereNotIn('organization_id', [99])->count();
        $ctl_comp = Complaint::where('status_id', 3)->whereNotIn('organization_id', [99])->count();
        $cnc_comp = Complaint::where('status_id', 4)->whereNotIn('organization_id', [99])->count();
        $rtn_comp = Complaint::where('status_id', 5)->whereNotIn('organization_id', [99])->count();
        $slv_comp = Complaint::where('status_id', 6)->whereNotIn('organization_id', [99])->count();
        $exp_comp = Complaint::where('expire_date', '<=', Carbon::now())->whereNotIn('organization_id', [99])->count();

        $compByMonth = Complaint::select(DB::raw('EXTRACT(\'MONTH\' FROM complaint_date) AS published_month, COUNT(id) AS count'))
            ->whereNotIn('organization_id', [99])
            ->whereRaw('date_part(\'year\', complaint_date) = date_part(\'year\', CURRENT_DATE)')
            ->groupBy(DB::raw('EXTRACT(\'MONTH\' FROM complaint_date)'))
            ->orderBy(DB::raw('EXTRACT(\'MONTH\' FROM complaint_date)'))
            ->get();
        $lineChartData = json_encode($compByMonth);

        $resultTog = DB::table('organizations as o')
            ->crossJoin('statuses as s')
            ->leftJoin('complaints as c', function ($join) {
                $join->on('o.id', '=', 'c.organization_id')
                    ->on('s.id', '=', 'c.status_id');
            })
            ->where(function ($query) {
                $query->whereNull('s.id')
                    ->orWhereNotIn('s.id', [7, 8]);
            })
            ->where('o.plant_id', 1)
            ->whereNotIn('o.id', [99])
            ->groupBy('o.id', 'o.name', 's.id')
            ->orderBy('o.name')
            ->orderBy('s.id')
            ->select('o.name', DB::raw('COALESCE(COUNT(c.status_id), 0) as total_count'), 's.id as status')
            ->get();
        $stackedChartDataTog = json_encode($resultTog);

        $resultDulaan = DB::table('organizations as o')
            ->crossJoin('statuses as s')
            ->leftJoin('complaints as c', function ($join) {
                $join->on('o.id', '=', 'c.organization_id')
                    ->on('s.id', '=', 'c.status_id');
            })
            ->where(function ($query) {
                $query->whereNull('s.id')
                    ->orWhereNotIn('s.id', [7, 8]);
            })
            ->where('o.plant_id', 2)
            ->groupBy('o.id', 'o.name', 's.id')
            ->orderBy('o.name')
            ->orderBy('s.id')
            ->select('o.name', DB::raw('COALESCE(COUNT(c.status_id), 0) as total_count'), 's.id as status')
            ->get();
        $stackedChartDataDulaan = json_encode($resultDulaan);

        $compTypeMakersTog = DB::table('complaints as c')
            ->leftJoin('complaint_maker_types as ct', 'ct.id', '=', 'c.complaint_maker_type_id')
            ->leftJoin('organizations as o', 'o.id', '=', 'c.organization_id')
            ->where('o.plant_id', '=', 1)
            ->groupBy('ct.name')
            ->select('ct.name', DB::raw('COUNT(c.id) AS y'))
            ->get();
        $compMakerTogCount = json_encode($compTypeMakersTog);

        $compTypeMakersDulaan = DB::table('complaints as c')
            ->leftJoin('complaint_maker_types as ct', 'ct.id', '=', 'c.complaint_maker_type_id')
            ->leftJoin('organizations as o', 'o.id', '=', 'c.organization_id')
            ->where('o.plant_id', '=', 2)
            ->groupBy('ct.name')
            ->select('ct.name', DB::raw('COUNT(c.id) AS y'))
            ->get();
        $compMakerDulaanCount = json_encode($compTypeMakersDulaan);

        $compTogChannels = Complaint::from('complaints as c')
            ->select('ct.name', DB::raw('COUNT(c.id) as y'))
            ->leftJoin('channels as ct', 'c.channel_id', '=', 'ct.id')
            ->leftJoin('organizations as o', 'o.id', '=', 'c.organization_id')
            ->where('o.plant_id', '=', 1)
            ->groupBy('ct.name')
            ->get();
        $compTogChannelsCount = json_encode($compTogChannels);

        $compDulaanChannels = Complaint::from('complaints as c')
            ->select('ct.name', DB::raw('COUNT(c.id) as y'))
            ->leftJoin('channels as ct', 'c.channel_id', '=', 'ct.id')
            ->leftJoin('organizations as o', 'o.id', '=', 'c.organization_id')
            ->where('o.plant_id', '=', 2)
            ->groupBy('ct.name')
            ->get();
        $compDulaanChannelsCount = json_encode($compDulaanChannels);

        $compStatusTog = Status::select('statuses.id', 'statuses.name')
            ->selectRaw('COALESCE(COUNT(complaints.id), 0) AS status_count')
            ->leftJoin('complaints', 'statuses.id', '=', 'complaints.status_id')
            ->whereNotIn('statuses.id', [7, 8])
            ->whereNotIn('complaints.organization_id', [99])
            ->where('complaints.energy_type_id', 1)
            ->groupBy('statuses.name', 'statuses.id')
            ->orderBy('statuses.id')
            ->get();
        $statusCountTog = json_encode($compStatusTog);
        $statusExpireTog = Complaint::where('expire_date', '<=', Carbon::now())
            ->whereNotIn('organization_id', [99])
            ->where('energy_type_id', 1)
            ->count();

        $compStatusDulaan = Status::select('statuses.id', 'statuses.name')
            ->selectRaw('COALESCE(COUNT(complaints.id), 0) AS status_count')
            ->leftJoin('complaints', 'statuses.id', '=', 'complaints.status_id')
            ->whereNotIn('statuses.id', [7, 8])
            ->whereNotIn('complaints.organization_id', [99])
            ->where('complaints.energy_type_id', 2)
            ->groupBy('statuses.name', 'statuses.id')
            ->orderBy('statuses.id')
            ->get();
        $statusCountDulaan = json_encode($compStatusDulaan);
        $statusExpireDulaan = Complaint::where('expire_date', '<=', Carbon::now())
            ->whereNotIn('organization_id', [99])
            ->where('energy_type_id', 2)
            ->count();

        $statusTog = Status::leftJoin('complaints as c', function ($join) {
            $join->on('statuses.id', '=', 'c.status_id')
                ->where('c.energy_type_id', '=', 1)
                ->whereNotIn('c.organization_id', [99]);
        })
            ->whereNotIn('statuses.id', [7, 8])
            ->groupBy('statuses.id', 'statuses.name')
            ->orderBy('statuses.id')
            ->select('statuses.id as status_id', 'statuses.name as status_name', DB::raw('COUNT(c.id) as status_count'))
            ->get();
        $statusDulaan = Status::leftJoin('complaints as c', function ($join) {
            $join->on('statuses.id', '=', 'c.status_id')
                ->where('c.energy_type_id', '=', 2)
                ->whereNotIn('c.organization_id', [99]);
        })
            ->whereNotIn('statuses.id', [7, 8])
            ->groupBy('statuses.id', 'statuses.name')
            ->orderBy('statuses.id')
            ->select('statuses.id as status_id', 'statuses.name as status_name', DB::raw('COUNT(c.id) as status_count'))
            ->get();



        return view('components.dashboard-tze', ['tze_tog' => $tze_tog, 'tze_dulaan' => $tze_dulaan, 'new_comp' => $new_comp, 'snt_comp' => $snt_comp, 'rec_comp' => $rec_comp, 'ctl_comp' => $ctl_comp, 'rtn_comp' => $rtn_comp, 'slv_comp' => $slv_comp, 'cnc_comp' => $cnc_comp, 'exp_comp' => $exp_comp, 'lineChartData' => $lineChartData, 'stackedChartDataTog' => $stackedChartDataTog, 'stackedChartDataDulaan' => $stackedChartDataDulaan, 'compMakerTogCount' => $compMakerTogCount, 'compMakerDulaanCount' => $compMakerDulaanCount, 'compTogChannelsCount' => $compTogChannelsCount, 'compDulaanChannelsCount' => $compDulaanChannelsCount, 'statusCountTog' => $statusCountTog, 'statusExpireTog' => $statusExpireTog, 'statusCountDulaan' => $statusCountDulaan, 'statusExpireDulaan' => $statusExpireDulaan, 'statusTog' => $statusTog, 'statusDulaan' => $statusDulaan]);
    }
}
