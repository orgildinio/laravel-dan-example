<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Complaint;
use App\Models\ComplaintType;
use App\Models\ComplaintTypeSummary;
use App\Models\EnergyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function showReport(Request $request)
    {
        $energy_type_id = $request->query('energy_type_id');
        $complaint_type_id = $request->query('complaint_type_id');
        $start_date = $request->query('startdate');
        $end_date = $request->query('enddate');

        $transfer_status = $request->query('transfer_status') ?? 'second_org_id';

        // If start_date is null, set it to 1 month before the current date
        $startDate = $start_date != null ? $start_date : Carbon::now()->subMonth()->toDateString();

        // If end_date is null, set it to the current date
        $endDate = $end_date != null ? $end_date : Carbon::now()->toDateString();

        // Fetch all available channels dynamically
        $channels = DB::table('channels')->select('id', 'name')->get();

        $channelSelects = [];
        $channelSums = [];

        foreach ($channels as $channel) {
            $alias = "channel{$channel->id}_all";
            $channelSelects[] = DB::raw("COALESCE(COUNT(CASE WHEN c.channel_id = {$channel->id} THEN 1 END), 0) AS $alias");
            $channelSums[] = "COUNT(CASE WHEN c.channel_id = {$channel->id} THEN 1 END)";
        }

        // Construct the total sum dynamically
        $totalSumQuery = DB::raw("COALESCE(" . implode(" + ", $channelSums) . ", 0) AS total_channels");

        // Merge all selected columns into an array
        $selectFields = array_merge(
            ['o.id', 'o.name'],                   // Static fields
            $channelSelects,                      // Dynamically generated fields
            [$totalSumQuery]                      // Total count field
        );

        $reportData = DB::table('organizations as o')
            ->leftJoin('complaints as c', function ($join) use ($transfer_status) {
                $join->on("c.$transfer_status", "=", "o.id");
            })
            ->when(!is_null($energy_type_id), function ($query) use ($energy_type_id) {
                return $query->where('c.energy_type_id', $energy_type_id);
            })
            ->when(!is_null($complaint_type_id), function ($query) use ($complaint_type_id) {
                return $query->where('c.complaint_type_id', $complaint_type_id);
            })
            ->when($transfer_status === 'organization_id', function ($query) {
                return $query->whereNull('c.second_org_id'); // second_org_id нь NULL байх нөхцөл
            })
            ->whereBetween('c.created_at', [$startDate, $endDate])
            ->leftJoin('complaint_types as ct', 'c.complaint_type_id', '=', 'ct.id')
            ->select($selectFields)  // Pass as a single array
            ->groupBy('o.id', 'o.name')
            ->orderBy(DB::raw("total_channels"), 'desc')
            ->get();



        $energy_types = EnergyType::all();
        $complaint_types = ComplaintType::all();

        return view('reports.report1', ['reportData' => $reportData, 'energy_types' => $energy_types, 'energy_type_id' => $energy_type_id, 'start_date' => $start_date, 'end_date' => $end_date, 'complaint_types' => $complaint_types, 'complaint_type_id' => $complaint_type_id]);
    }

    // public function energyReport(Request $request)
    // {
    //     $start_date = $request->query('startdate');
    //     $end_date = $request->query('enddate');

    //     $energy_type_id = $request->query('energy_type_id');
    //     $complaint_type_id = $request->query('complaint_type_id');

    //     if (isset($energy_type_id) && isset($complaint_type_id)) {
    //         $complaint_type_summaries = ComplaintTypeSummary::where('energy_type_id', $energy_type_id)->where('complaint_type_id', $complaint_type_id)->get();
    //     }

    //     // If start_date is null, set it to 1 month before the current date
    //     $startDate = $start_date != null ? $start_date : Carbon::now()->subMonth()->toDateString();

    //     // If end_date is null, set it to the current date
    //     $endDate = $end_date != null ? $end_date : Carbon::now()->toDateString();

    //     $complaints = DB::table('organizations as org')
    //         ->select(
    //             'org.name as organization_name',
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 1 THEN 1 ELSE 0 END) AS c1_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 9 THEN 1 ELSE 0 END) AS c9_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 10 THEN 1 ELSE 0 END) AS c10_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 11 THEN 1 ELSE 0 END) AS c11_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 12 THEN 1 ELSE 0 END) AS c12_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 13 THEN 1 ELSE 0 END) AS c13_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 14 THEN 1 ELSE 0 END) AS c14_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 15 THEN 1 ELSE 0 END) AS c15_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 29 THEN 1 ELSE 0 END) AS c29_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 30 THEN 1 ELSE 0 END) AS c30_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 31 THEN 1 ELSE 0 END) AS c31_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 32 THEN 1 ELSE 0 END) AS c32_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 33 THEN 1 ELSE 0 END) AS c33_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 34 THEN 1 ELSE 0 END) AS c34_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 39 THEN 1 ELSE 0 END) AS c39_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 40 THEN 1 ELSE 0 END) AS c40_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 42 THEN 1 ELSE 0 END) AS c42_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 78 THEN 1 ELSE 0 END) AS c78_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 79 THEN 1 ELSE 0 END) AS c79_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 80 THEN 1 ELSE 0 END) AS c80_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 81 THEN 1 ELSE 0 END) AS c81_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 82 THEN 1 ELSE 0 END) AS c82_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 83 THEN 1 ELSE 0 END) AS c83_cnt'),
    //             DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 84 THEN 1 ELSE 0 END) AS c84_cnt'),
    //             DB::raw('COUNT(c.id) as total_complaints'),
    //             // complaint channel
    //             DB::raw('SUM(CASE WHEN c.channel_id = 1 THEN 1 ELSE 0 END) AS c_1'),
    //             DB::raw('SUM(CASE WHEN c.channel_id = 2 THEN 1 ELSE 0 END) AS c_2'),
    //             DB::raw('SUM(CASE WHEN c.channel_id = 3 THEN 1 ELSE 0 END) AS c_3'),
    //             DB::raw('SUM(CASE WHEN c.channel_id = 4 THEN 1 ELSE 0 END) AS c_4'),
    //             DB::raw('SUM(CASE WHEN c.channel_id = 5 THEN 1 ELSE 0 END) AS c_5'),
    //             DB::raw('SUM(CASE WHEN c.channel_id = 6 THEN 1 ELSE 0 END) AS c_6'),
    //             DB::raw('SUM(CASE WHEN c.channel_id = 7 THEN 1 ELSE 0 END) AS c_7'),
    //             DB::raw('COUNT(c.id) AS total_channel')
    //         )
    //         ->leftJoin('complaints as c', function ($join) use ($startDate, $endDate) {
    //             $join->on('c.second_org_id', '=', 'org.id')
    //                 ->where('c.complaint_type_id', '=', 2)
    //                 ->whereBetween('c.created_at', [$startDate, $endDate]); // Add whereBetween here
    //         })
    //         ->leftJoin('complaint_type_summaries as cts', 'cts.id', '=', 'c.complaint_type_summary_id')
    //         ->where('org.plant_id', '=', 1)
    //         ->groupBy('org.name')
    //         ->orderBy('org.name')
    //         ->get();

    //     $energy_types = EnergyType::all();
    //     $complaint_types = ComplaintType::all();

    //     return view('reports.energy-report', ['complaints' => $complaints, 'start_date' => $start_date, 'end_date' => $end_date, 'energy_types' => $energy_types, 'complaint_types' => $complaint_types, 'energy_type_id' => $energy_type_id, 'complaint_type_id' => $complaint_type_id]);
    // }
    public function energyReport(Request $request)
    {
        $start_date = $request->query('startdate');
        $end_date = $request->query('enddate');

        $energy_type_id = $request->query('energy_type_id');
        $complaint_type_id = $request->query('complaint_type_id');

        $transfer_status = $request->query('transfer_status');

        // Зөвхөн зөвшөөрөгдсөн баганыг ашиглах
        $validColumns = ['second_org_id', 'organization_id'];
        $transferColumn = in_array($transfer_status, $validColumns) ? $transfer_status : 'organization_id';

        dd($transferColumn);

        // dd($request->all());

        $complaint_type_summaries = collect();
        if (isset($energy_type_id) && isset($complaint_type_id)) {
            $complaint_type_summaries = ComplaintTypeSummary::where('energy_type_id', $energy_type_id)
                ->where('complaint_type_id', $complaint_type_id)
                ->get();
        }
        // dd($complaint_type_summaries);

        // If start_date is null, set it to 1 month before the current date
        $startDate = $start_date != null ? $start_date : Carbon::now()->subMonth()->toDateString();
        // If end_date is null, set it to the current date
        $endDate = $end_date != null ? $end_date : Carbon::now()->toDateString();

        // **🔹 Dynamically Generate the Columns**
        $summaryColumns = [];

        foreach ($complaint_type_summaries as $summary) {
            $summary_id = $summary->id;
            $summaryColumns[] = DB::raw("SUM(CASE WHEN c.complaint_type_summary_id = $summary_id THEN 1 ELSE 0 END) AS c{$summary_id}_cnt");
        }

        // **🔹 Static Columns**
        $staticColumns = [
            'org.name as organization_name',
            // Complaint channel breakdown
            DB::raw('SUM(CASE WHEN c.channel_id = 1 THEN 1 ELSE 0 END) AS c_1'),
            DB::raw('SUM(CASE WHEN c.channel_id = 2 THEN 1 ELSE 0 END) AS c_2'),
            DB::raw('SUM(CASE WHEN c.channel_id = 3 THEN 1 ELSE 0 END) AS c_3'),
            DB::raw('SUM(CASE WHEN c.channel_id = 4 THEN 1 ELSE 0 END) AS c_4'),
            DB::raw('SUM(CASE WHEN c.channel_id = 5 THEN 1 ELSE 0 END) AS c_5'),
            DB::raw('SUM(CASE WHEN c.channel_id = 6 THEN 1 ELSE 0 END) AS c_6'),
            DB::raw('SUM(CASE WHEN c.channel_id = 7 THEN 1 ELSE 0 END) AS c_7'),
            DB::raw('COUNT(c.id) AS total_channel'),
        ];

        // **🔹 Combine Columns (Static + Dynamic)**
        $selectColumns = array_merge($staticColumns, $summaryColumns);
        // dd($selectColumns);

        // **🔹 Build Query**
        $complaints = DB::table('organizations as org')
            ->select($selectColumns)
            ->leftJoin('complaints as c', function ($join) use ($startDate, $endDate, $transferColumn) {
                $join->on("c.$transferColumn", '=', 'org.id')
                    ->where("c.$transferColumn", '!=', 99);
                // ->whereBetween('c.created_at', [$startDate, $endDate]);
            })
            ->leftJoin('complaint_type_summaries as cts', 'cts.id', '=', 'c.complaint_type_summary_id')
            ->where('org.plant_id', '=', $energy_type_id)
            ->where('c.complaint_type_id', '=', $complaint_type_id)
            // ->where('c.organization_id', '!=', 99)
            ->whereBetween('c.created_at', [$startDate, $endDate])
            ->groupBy('org.name')
            ->orderBy('org.name')
            ->get();

        // $complaints = DB::table('organizations as org')
        //     ->select(
        //         'org.name as organization_name',
        //         DB::raw('SUM(CASE WHEN c.channel_id = 1 THEN 1 ELSE 0 END) AS c_1'),
        //         DB::raw('SUM(CASE WHEN c.channel_id = 2 THEN 1 ELSE 0 END) AS c_2'),
        //         DB::raw('SUM(CASE WHEN c.channel_id = 3 THEN 1 ELSE 0 END) AS c_3'),
        //         DB::raw('SUM(CASE WHEN c.channel_id = 4 THEN 1 ELSE 0 END) AS c_4'),
        //         DB::raw('SUM(CASE WHEN c.channel_id = 5 THEN 1 ELSE 0 END) AS c_5'),
        //         DB::raw('SUM(CASE WHEN c.channel_id = 6 THEN 1 ELSE 0 END) AS c_6'),
        //         DB::raw('SUM(CASE WHEN c.channel_id = 7 THEN 1 ELSE 0 END) AS c_7'),
        //         DB::raw('COUNT(c.id) AS total_channel'),
        //         DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 2 THEN 1 ELSE 0 END) AS c2_cnt'),
        //         DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 17 THEN 1 ELSE 0 END) AS c17_cnt'),
        //         DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 18 THEN 1 ELSE 0 END) AS c18_cnt'),
        //         DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 16 THEN 1 ELSE 0 END) AS c16_cnt')
        //     )
        //     ->leftJoin('complaints as c', 'c.second_org_id', '=', 'org.id')
        //     ->leftJoin('complaint_type_summaries as cts', 'cts.id', '=', 'c.complaint_type_summary_id')
        //     ->where('org.plant_id', 1)
        //     ->whereBetween('c.created_at', ['2025-01-01', '2025-02-01'])
        //     ->groupBy('org.name')
        //     ->orderBy('org.name', 'ASC')
        //     ->get();

        // dd($complaints);

        $energy_types = EnergyType::all();
        $complaint_types = ComplaintType::all();

        return view('reports.energy-report', [
            'complaints' => $complaints,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'energy_types' => $energy_types,
            'complaint_types' => $complaint_types,
            'energy_type_id' => $energy_type_id,
            'complaint_type_id' => $complaint_type_id,
            'complaint_type_summaries' => $complaint_type_summaries,
        ]);
    }

    public function reportDetail(Request $request)
    {
        $energy_type_id = $request->query('energy_type_id');
        $start_date = $request->query('startdate');
        $end_date = $request->query('enddate');

        $energyTypeId = $energy_type_id != null ? $energy_type_id : 1;

        // If start_date is null, set it to 1 month before the current date
        $startDate = $start_date != null ? $start_date : Carbon::now()->subMonth()->toDateString();

        // If end_date is null, set it to the current date
        $endDate = $end_date != null ? $end_date : Carbon::now()->toDateString();

        // $complaints = Complaint::with('complaintSteps')->first();
        $complaints = Complaint::with(['complaintSteps'])->selectRaw('
                *,
                CASE WHEN complaint_type_id = 1 THEN 1 ELSE 0 END AS t1,
                CASE WHEN complaint_type_id = 2 THEN 1 ELSE 0 END AS t2,
                CASE WHEN complaint_type_id = 3 THEN 1 ELSE 0 END AS t3,
                CASE WHEN complaint_type_id = 5 THEN 1 ELSE 0 END AS t5,
                CASE WHEN complaint_type_id = 6 THEN 1 ELSE 0 END AS t6,
                CASE WHEN complaint_type_id = 7 THEN 1 ELSE 0 END AS t7,
                CASE WHEN complaint_type_id = 8 THEN 1 ELSE 0 END AS t8,
                CASE WHEN channel_id = 1 THEN 1 ELSE 0 END AS ch1,
                CASE WHEN channel_id = 2 THEN 1 ELSE 0 END AS ch2,
                CASE WHEN channel_id = 3 THEN 1 ELSE 0 END AS ch3,
                CASE WHEN channel_id = 4 THEN 1 ELSE 0 END AS ch4,
                CASE WHEN channel_id = 5 THEN 1 ELSE 0 END AS ch5,
                CASE WHEN channel_id = 6 THEN 1 ELSE 0 END AS ch6,
                CASE WHEN channel_id = 7 THEN 1 ELSE 0 END AS ch7
            ')
            ->where('energy_type_id', $energyTypeId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderByDesc('created_at')
            ->orderByDesc('created_at')
            ->get();

        // dd($complaints);

        $energy_types = EnergyType::all();

        return view('reports.report-detail', ['complaints' => $complaints, 'energy_types' => $energy_types, 'energy_type_id' => $energy_type_id, 'start_date' => $start_date, 'end_date' => $end_date]);
    }

    public function reportStatus(Request $request)
    {
        $energy_type_id = $request->query('energy_type_id');
        $start_date = $request->query('startdate');
        $end_date = $request->query('enddate');

        $energyTypeId = $energy_type_id != null ? $energy_type_id : 1;

        // If start_date is null, set it to 1 month before the current date
        $startDate = $start_date != null ? $start_date : Carbon::now()->subMonth()->toDateString();

        // If end_date is null, set it to the current date
        $endDate = $end_date != null ? $end_date : Carbon::now()->toDateString();

        // $complaints = Complaint::with('complaintSteps')->first();
        $complaints = DB::table('complaints as c')
            ->join('organizations as o', 'o.id', '=', 'c.second_org_id')
            ->select(
                'o.name as organization_name',
                DB::raw('COUNT(CASE WHEN c.second_status_id = 0 THEN 1 END) AS s_0_cnt'),
                DB::raw('COUNT(CASE WHEN c.second_status_id = 2 THEN 1 END) AS s_2_cnt'),
                DB::raw('COUNT(CASE WHEN c.second_status_id = 3 THEN 1 END) AS s_3_cnt'),
                DB::raw('COUNT(CASE WHEN c.second_status_id = 4 THEN 1 END) AS s_4_cnt'),
                DB::raw('COUNT(CASE WHEN c.second_status_id = 6 THEN 1 END) AS s_6_cnt'),
                // DB::raw('COUNT(*) AS total_count'),
                DB::raw('(
                    COUNT(CASE WHEN c.second_status_id = 0 THEN 1 END) +
                    COUNT(CASE WHEN c.second_status_id = 2 THEN 1 END) +
                    COUNT(CASE WHEN c.second_status_id = 3 THEN 1 END) +
                    COUNT(CASE WHEN c.second_status_id = 4 THEN 1 END) +
                    COUNT(CASE WHEN c.second_status_id = 6 THEN 1 END)
                ) AS total_count'),
                DB::raw('COUNT(CASE WHEN c.expire_date < CURRENT_DATE AND c.second_status_id != 6 AND c.status_id != 6 THEN 1 END) AS expired_count')
            )
            ->where('c.energy_type_id', $energyTypeId)
            ->where('c.second_org_id', '!=', 99)
            ->whereBetween('c.created_at', [$startDate, $endDate])
            ->groupBy('o.name')
            ->orderBy('total_count', 'DESC')
            ->get();

        // dd($complaints);

        $energy_types = EnergyType::all();

        return view('reports.report-status', ['complaints' => $complaints, 'energy_types' => $energy_types, 'energy_type_id' => $energy_type_id, 'start_date' => $start_date, 'end_date' => $end_date]);
    }
}
