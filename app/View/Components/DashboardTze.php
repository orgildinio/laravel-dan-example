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
        // Get the date range from the request
        $start_date = request('startdate', Carbon::now()->subMonth()->toDateString());
        $end_date = request('enddate', Carbon::now()->toDateString());

        $startDate = $start_date != null ? $start_date : Carbon::now()->subMonth()->toDateString();
        $endDate = $end_date != null ? $end_date : Carbon::now()->toDateString();

        $tze_tog = Complaint::where('energy_type_id', 1)->whereBetween('created_at', [$startDate, $endDate])->whereNotIn('organization_id', [99])->count();
        $tze_dulaan = Complaint::where('energy_type_id', 2)->whereBetween('created_at', [$startDate, $endDate])->whereNotIn('organization_id', [99])->count();

        // $new_comp = Complaint::where('status_id', 0)->whereNotIn('organization_id', [99])->count();
        // $snt_comp = Complaint::where('status_id', 1)->whereNotIn('organization_id', [99])->count();
        // $rec_comp = Complaint::where('status_id', 2)->whereNotIn('organization_id', [99])->count();
        // $ctl_comp = Complaint::where('status_id', 3)->whereNotIn('organization_id', [99])->count();
        // $cnc_comp = Complaint::where('status_id', 4)->whereNotIn('organization_id', [99])->count();
        // $rtn_comp = Complaint::where('status_id', 5)->whereNotIn('organization_id', [99])->count();
        // $slv_comp = Complaint::where('status_id', 6)->whereNotIn('organization_id', [99])->count();
        $exp_comp = Complaint::where('expire_date', '<=', Carbon::now())->whereBetween('created_at', [$startDate, $endDate])->whereNotIn('organization_id', [99])->where('status_id', '!=', 6)->count();

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
        // dd($resultTog);

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

        // $compTypeMakersTog = DB::table('complaints as c')
        //     ->leftJoin('complaint_maker_types as ct', 'ct.id', '=', 'c.complaint_maker_type_id')
        //     ->where('c.energy_type_id', '=', 1)
        //     ->whereNotIn('c.organization_id', [99])
        //     ->groupBy('ct.name')
        //     ->select('ct.name', DB::raw('COUNT(c.id) AS y'))
        //     ->get();
        // $compMakerTogCount = json_encode($compTypeMakersTog);

        // $compTypeMakersDulaan = DB::table('complaints as c')
        //     ->leftJoin('complaint_maker_types as ct', 'ct.id', '=', 'c.complaint_maker_type_id')
        //     ->where('c.energy_type_id', '=', 2)
        //     ->whereNotIn('c.organization_id', [99])
        //     ->groupBy('ct.name')
        //     ->select('ct.name', DB::raw('COUNT(c.id) AS y'))
        //     ->get();
        // $compMakerDulaanCount = json_encode($compTypeMakersDulaan);

        $compTogChannels = DB::table('channels as ct')
            ->leftJoin('complaints as c', function ($join) {
                $join->on('ct.id', '=', 'c.channel_id')
                    ->where('c.organization_id', '<>', 99)
                    ->where('c.energy_type_id', '=', 1);
            })
            ->selectRaw('ct.name, COUNT(c.id) as y')
            ->groupBy('ct.name')
            ->orderBy('ct.name', 'asc')
            ->get();

        $compTogChannelsCount = json_encode($compTogChannels);

        $compDulaanChannels = DB::table('channels as ct')
            ->leftJoin('complaints as c', function ($join) {
                $join->on('ct.id', '=', 'c.channel_id')
                    ->where('c.organization_id', '<>', 99)
                    ->where('c.energy_type_id', '=', 2);
            })
            ->selectRaw('ct.name, COUNT(c.id) as y')
            ->groupBy('ct.name')
            ->orderBy('ct.name', 'asc')
            ->get();

        $compDulaanChannelsCount = json_encode($compDulaanChannels);

        $statusExpireTog = Complaint::where('expire_date', '<=', Carbon::now())
            ->whereNotIn('organization_id', [99])
            ->where('energy_type_id', 1)
            ->where('status_id', '!=', 6)
            ->count();
        $statusExpireDulaan = Complaint::where('expire_date', '<=', Carbon::now())
            ->whereNotIn('organization_id', [99])
            ->where('energy_type_id', 2)
            ->where('status_id', '!=', 6)
            ->count();


        // $data = DB::table('organizations as o')
        //     ->crossJoin('statuses as s')
        //     ->leftJoin('complaints as c', function ($join) {
        //         $join->on('o.id', '=', 'c.organization_id')
        //             ->on('s.id', '=', 'c.status_id');
        //     })
        //     ->where('o.plant_id', 2)
        //     ->whereNotIn('o.id', [99])
        //     ->where(function ($query) {
        //         $query->whereNull('s.id')->orWhereNotIn('s.id', [7, 8]);
        //     })
        //     ->groupBy('o.id', 'o.name')
        //     ->orderBy('o.name')
        //     ->select(
        //         'o.name as organization_name',
        //         DB::raw('COUNT(CASE WHEN s.id = 1 THEN c.status_id END) AS status_1_count'),
        //         DB::raw('COUNT(CASE WHEN s.id = 2 THEN c.status_id END) AS status_2_count'),
        //         DB::raw('COUNT(CASE WHEN s.id = 3 THEN c.status_id END) AS status_3_count'),
        //         DB::raw('COUNT(CASE WHEN s.id = 4 THEN c.status_id END) AS status_4_count'),
        //         DB::raw('COUNT(CASE WHEN s.id = 5 THEN c.status_id END) AS status_5_count'),
        //         DB::raw('COUNT(CASE WHEN s.id = 6 THEN c.status_id END) AS status_6_count')
        //     )
        //     ->get();
        $data = DB::table('organizations as o')
            ->leftJoin('complaints as c', 'o.id', '=', 'c.organization_id')
            ->leftJoin('statuses as s', 'c.status_id', '=', 's.id')
            ->where('o.plant_id', 2)
            ->whereNotIn('o.id', [99])
            ->whereNotIn('s.id', [7, 8])
            ->groupBy('o.id', 'o.name')
            ->havingRaw('COUNT(c.id) > 0') // Зөвхөн гомдолтой байгууллагуудыг үлдээх
            ->orderBy('o.name')
            ->select(
                'o.name as organization_name',
                DB::raw('COUNT(CASE WHEN s.id = 0 THEN c.id END) AS status_0_count'),
                DB::raw('COUNT(CASE WHEN s.id = 1 THEN c.id END) AS status_1_count'),
                DB::raw('COUNT(CASE WHEN s.id = 2 THEN c.id END) AS status_2_count'),
                DB::raw('COUNT(CASE WHEN s.id = 3 THEN c.id END) AS status_3_count'),
                DB::raw('COUNT(CASE WHEN s.id = 4 THEN c.id END) AS status_4_count'),
                DB::raw('COUNT(CASE WHEN s.id = 5 THEN c.id END) AS status_5_count'),
                DB::raw('COUNT(CASE WHEN s.id = 6 THEN c.id END) AS status_6_count')
            )
            ->get();


        // dd($data);

        // Format data for Highcharts
        $categories = [];
        $statusCounts = [
            'Status 0' => [],
            'Status 1' => [],
            'Status 2' => [],
            'Status 3' => [],
            'Status 4' => [],
            'Status 5' => [],
            'Status 6' => [],
        ];

        foreach ($data as $row) {
            $categories[] = $row->organization_name;
            $statusCounts['Status 0'][] = (int) $row->status_0_count;
            $statusCounts['Status 1'][] = (int) $row->status_1_count;
            $statusCounts['Status 2'][] = (int) $row->status_2_count;
            $statusCounts['Status 3'][] = (int) $row->status_3_count;
            $statusCounts['Status 4'][] = (int) $row->status_4_count;
            $statusCounts['Status 5'][] = (int) $row->status_5_count;
            $statusCounts['Status 6'][] = (int) $row->status_6_count;
        }




        return view('components.dashboard-tze', ['tze_tog' => $tze_tog, 'tze_dulaan' => $tze_dulaan, 'exp_comp' => $exp_comp, 'lineChartData' => $lineChartData, 'stackedChartDataTog' => $stackedChartDataTog, 'stackedChartDataDulaan' => $stackedChartDataDulaan, 'compTogChannelsCount' => $compTogChannelsCount, 'compDulaanChannelsCount' => $compDulaanChannelsCount, 'statusExpireTog' => $statusExpireTog, 'statusExpireDulaan' => $statusExpireDulaan, 'categories' => $categories, 'statusCounts' => $statusCounts]);
    }
}