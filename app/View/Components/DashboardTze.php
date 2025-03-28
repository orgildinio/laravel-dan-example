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

        $energy_type = request('energy_type');
        // dd($energy_type);

        $tze_tog = Complaint::where('energy_type_id', 1)->whereBetween('created_at', [$startDate, $endDate])->whereNotIn('organization_id', [99])->count();
        $tze_dulaan = Complaint::where('energy_type_id', 2)->whereBetween('created_at', [$startDate, $endDate])->whereNotIn('organization_id', [99])->count();

        $exp_comp = Complaint::where('expire_date', '<=', Carbon::now())->whereBetween('created_at', [$startDate, $endDate])->whereNotIn('organization_id', [99])->where('status_id', '!=', 6)->count();

        $compByMonth = Complaint::select(DB::raw('EXTRACT(\'MONTH\' FROM complaint_date) AS published_month, COUNT(id) AS count'))
            ->whereNotIn('organization_id', [99])
            ->whereRaw('date_part(\'year\', complaint_date) = date_part(\'year\', CURRENT_DATE)')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy(DB::raw('EXTRACT(\'MONTH\' FROM complaint_date)'))
            ->orderBy(DB::raw('EXTRACT(\'MONTH\' FROM complaint_date)'))
            ->get();
        $lineChartData = json_encode($compByMonth);

        $compTogChannels = DB::table('channels as ct')
            ->leftJoin('complaints as c', function ($join) {
                $join->on('ct.id', '=', 'c.channel_id')
                    ->where('c.organization_id', '<>', 99)
                    ->where('c.energy_type_id', '=', 1);
            })
            ->whereBetween('c.created_at', [$startDate, $endDate])
            ->selectRaw('ct.name as category, COUNT(c.id) as value')
            ->groupBy('ct.name')
            ->orderBy('ct.name', 'asc')
            ->get();

        $compDulaanChannels = DB::table('channels as ct')
            ->leftJoin('complaints as c', function ($join) {
                $join->on('ct.id', '=', 'c.channel_id')
                    ->where('c.organization_id', '<>', 99)
                    ->where('c.energy_type_id', '=', 2);
            })
            ->whereBetween('c.created_at', [$startDate, $endDate])
            ->selectRaw('ct.name as category, COUNT(c.id) as value')
            ->groupBy('ct.name')
            ->orderBy('ct.name', 'asc')
            ->get();

        $compTogChannelsCount = json_encode($compTogChannels);
        $compDulaanChannelsCount = json_encode($compDulaanChannels);


        $data = DB::table('organizations as o')
            ->leftJoin('complaints as c', 'o.id', '=', 'c.organization_id')
            ->leftJoin('statuses as s', 'c.status_id', '=', 's.id')
            ->when(!is_null($energy_type), function ($query) use ($energy_type) {
                return $query->where('o.plant_id', $energy_type);
            })
            ->whereNotIn('o.id', [99])
            ->whereBetween('c.created_at', [$startDate, $endDate])
            ->groupBy('o.id', 'o.name')
            ->havingRaw('COUNT(c.id) > 0') // Зөвхөн гомдолтой байгууллагуудыг үлдээх
            ->orderBy('o.name')
            ->select(
                'o.name as organization_name',
                DB::raw('COUNT(CASE WHEN s.id = 0 THEN c.id END) AS status_0_count'),
                DB::raw('COUNT(CASE WHEN s.id = 1 THEN c.id END) AS status_1_count'),
                DB::raw('COUNT(CASE WHEN s.id = 2 THEN c.id END) AS status_2_count'),
                DB::raw('COUNT(CASE WHEN s.id = 3 THEN c.id END) AS status_3_count'),
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
            'Status 6' => [],
        ];

        foreach ($data as $row) {
            $categories[] = $row->organization_name;
            $statusCounts['Status 0'][] = (int) $row->status_0_count;
            $statusCounts['Status 1'][] = (int) $row->status_1_count;
            $statusCounts['Status 2'][] = (int) $row->status_2_count;
            $statusCounts['Status 3'][] = (int) $row->status_3_count;
            $statusCounts['Status 6'][] = (int) $row->status_6_count;
        }

        return view('components.dashboard-tze', ['tze_tog' => $tze_tog, 'tze_dulaan' => $tze_dulaan, 'exp_comp' => $exp_comp, 'lineChartData' => $lineChartData, 'compTogChannelsCount' => $compTogChannelsCount, 'compDulaanChannelsCount' => $compDulaanChannelsCount, 'categories' => $categories, 'statusCounts' => $statusCounts]);
    }
}