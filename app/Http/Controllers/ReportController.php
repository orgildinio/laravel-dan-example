<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        $transferred = $request->query('transferred') ?? 1;

        $org_id = $request->query('transferred', 'second_org_id') ? 'second_org_id' : 'organization_id';


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
            ->leftJoin('complaints as c', function ($join) use ($org_id) {
                $join->on("c.$org_id", "=", "o.id");
            })
            // ->leftJoin('complaints as c', 'c.organization_id', '=', 'o.id')
            ->when(!is_null($energy_type_id), function ($query) use ($energy_type_id) {
                return $query->where('c.energy_type_id', $energy_type_id);
            })
            ->when(!is_null($complaint_type_id), function ($query) use ($complaint_type_id) {
                return $query->where('c.complaint_type_id', $complaint_type_id);
            })
            ->when(!is_null($transferred), function ($query) use ($transferred) {
                return $query->where('c.transferred', $transferred);
            })
            ->whereBetween('c.created_at', [
                \Carbon\Carbon::parse($startDate)->startOfDay(),
                \Carbon\Carbon::parse($endDate)->endOfDay()
            ])
            ->leftJoin('complaint_types as ct', 'c.complaint_type_id', '=', 'ct.id')
            ->select($selectFields)  // Pass as a single array
            ->groupBy('o.id', 'o.name')
            ->orderBy(DB::raw("total_channels"), 'desc')
            ->get();



        $energy_types = EnergyType::all();
        $complaint_types = ComplaintType::all();

        return view('reports.report1', ['reportData' => $reportData, 'energy_types' => $energy_types, 'energy_type_id' => $energy_type_id, 'start_date' => $start_date, 'end_date' => $end_date, 'complaint_types' => $complaint_types, 'complaint_type_id' => $complaint_type_id]);
    }

    public function energyReport(Request $request)
    {
        $start_date = $request->query('startdate');
        $end_date = $request->query('enddate');

        $energy_type_id = $request->query('energy_type_id');
        $complaint_type_id = $request->query('complaint_type_id');
        $category_id = $request->query('category_id');

        $transferred = $request->query('transferred') ?? 1;

        $org_id = $request->query('transferred', 'second_org_id') ? 'second_org_id' : 'organization_id';

        $complaint_type_summaries = collect();
        if (isset($energy_type_id) && isset($complaint_type_id)) {
            $complaint_type_summaries = ComplaintTypeSummary::where('energy_type_id', $energy_type_id)
                ->where('complaint_type_id', $complaint_type_id)
                ->get();
        }

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
            DB::raw('SUM(CASE WHEN c.channel_id = 8 THEN 1 ELSE 0 END) AS c_8'),
            DB::raw('SUM(CASE WHEN c.channel_id = 9 THEN 1 ELSE 0 END) AS c_9'),
            DB::raw('SUM(CASE WHEN c.channel_id = 10 THEN 1 ELSE 0 END) AS c_10'),
            DB::raw('COUNT(c.id) AS total_channel'),
        ];

        // **🔹 Combine Columns (Static + Dynamic)**
        $selectColumns = array_merge($staticColumns, $summaryColumns);
        // dd($selectColumns);

        // **🔹 Build Query**
        // $complaints = DB::table('organizations as org')
        //     ->select($selectColumns)
        //     ->leftJoin('complaints as c', function ($join) use ($org_id) {
        //         $join->on("c.$org_id", '=', 'org.id');
        //     })
        //     ->leftJoin('complaint_type_summaries as cts', 'cts.id', '=', 'c.complaint_type_summary_id')
        //     ->when(!is_null($category_id), function ($query) use ($category_id) {
        //         return $query->where('c.category_id', $category_id);
        //     })
        //     ->when(!is_null($energy_type_id), function ($query) use ($energy_type_id) {
        //         return $query->where('c.energy_type_id', $energy_type_id);
        //     })
        //     ->when(!is_null($complaint_type_id), function ($query) use ($complaint_type_id) {
        //         return $query->where('c.complaint_type_id', $complaint_type_id);
        //     })
        //     ->when(!is_null($transferred), function ($query) use ($transferred) {
        //         return $query->where('c.transferred', $transferred);
        //     })
        //     ->whereBetween('c.created_at', [
        //         \Carbon\Carbon::parse($startDate)->startOfDay(),
        //         \Carbon\Carbon::parse($endDate)->endOfDay()
        //     ])
        //     ->groupBy('org.name')
        //     ->orderBy(DB::raw("total_channel"), 'desc')
        //     ->get();

        // **🔹 Шилжүүлсэн гомдлууд **
        $complaintsTransferred = DB::table('organizations as org')
            ->selectRaw(implode(', ', $selectColumns))
            ->leftJoin('complaints as c', function ($join) use ($startDate, $endDate, $category_id, $complaint_type_id) {
                $join->on('c.second_org_id', '=', 'org.id')
                    ->whereBetween('c.created_at', [$startDate, $endDate])
                    ->where('c.category_id', $category_id)
                    ->where('c.complaint_type_id', $complaint_type_id)
                    ->where('c.transferred', true);
            })
            ->leftJoin('complaint_type_summaries as cts', 'cts.id', '=', 'c.complaint_type_summary_id')
            ->where('org.plant_id', $energy_type_id)
            ->groupBy('org.name')
            ->orderBy('organization_name')
            ->get();

        // **🔹 Шилжүүлээгүй гомдлууд **
        $complaintsNotTransferred = DB::table('organizations as org')
            ->selectRaw(implode(', ', $selectColumns))
            ->leftJoin('complaints as c', function ($join) use ($startDate, $endDate, $category_id, $complaint_type_id) {
                $join->on('c.organization_id', '=', 'org.id')
                    ->whereBetween('c.created_at', [$startDate, $endDate])
                    ->where('c.category_id', $category_id)
                    ->where('c.complaint_type_id', $complaint_type_id)
                    ->where('c.transferred', false);
            })
            ->leftJoin('complaint_type_summaries as cts', 'cts.id', '=', 'c.complaint_type_summary_id')
            ->where('org.plant_id', $energy_type_id)
            ->groupBy('org.name')
            ->orderBy('organization_name')
            ->get();

        // dd($complaintsTransferred);

        // Combine both collections
        $allComplaints = $complaintsTransferred->concat($complaintsNotTransferred);

        // Group by organization and sum the values
        $mergedComplaints = $allComplaints->groupBy('organization_name')->map(function ($group) use ($complaint_type_summaries) {
            $merged = (object)[
                'organization_name' => $group->first()->organization_name,
                'total_channel' => $group->sum('total_channel'),
            ];

            // Sum complaint type summary counts
            foreach ($complaint_type_summaries as $summary) {
                $key = 'c' . $summary->id . '_cnt';
                $merged->{$key} = $group->sum($key);
            }

            // Keep channels separate but with clear labels
            foreach ($group as $item) {
                foreach (range(1, 10) as $i) {
                    $channelKey = 'c_' . $i;
                    $transferredKey = 'transferred_c_' . $i;
                    $notTransferredKey = 'not_transferred_c_' . $i;

                    // Determine if transferred (you might need to adjust this logic)
                    $isTransferred = isset($item->transferred) ? $item->transferred : (strpos(json_encode($item), 'second_org_id') !== false);

                    if ($isTransferred) {
                        $merged->{$transferredKey} = ($merged->{$transferredKey} ?? 0) + ($item->{$channelKey} ?? 0);
                    } else {
                        $merged->{$notTransferredKey} = ($merged->{$notTransferredKey} ?? 0) + ($item->{$channelKey} ?? 0);
                    }
                }
            }

            return $merged;
        })->values();

        // dd($mergedComplaints);


        $energy_types = EnergyType::all();
        $complaint_types = ComplaintType::all();
        $categories = Category::all();

        return view('reports.energy-report', [
            'complaintsTransferred' => $complaintsTransferred,
            'complaintsNotTransferred' => $complaintsNotTransferred,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'energy_types' => $energy_types,
            'complaint_types' => $complaint_types,
            'energy_type_id' => $energy_type_id,
            'complaint_type_id' => $complaint_type_id,
            'complaint_type_summaries' => $complaint_type_summaries,
            'categories' => $categories,
            'mergedComplaints' => $mergedComplaints,
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
        $energy_type_id = $request->query('energy_type_id') ?? 1;
        $start_date = $request->query('startdate');
        $end_date = $request->query('enddate');

        $transferred = $request->query('transferred') ?? 1;

        $org_id = $request->query('transferred', 'second_org_id') ? 'second_org_id' : 'organization_id';

        // If start_date is null, set it to 1 month before the current date
        $startDate = $start_date != null ? $start_date : Carbon::now()->subMonth()->toDateString();

        // If end_date is null, set it to the current date
        $endDate = $end_date != null ? $end_date : Carbon::now()->toDateString();

        // $complaints = Complaint::with('complaintSteps')->first();
        // $complaints = DB::table('complaints as c')
        //     ->leftJoin('complaints as c', function ($join) use ($org_id) {
        //         $join->on("c.$org_id", "=", "o.id");
        //     })
        //     // ->join('organizations as o', 'o.id', '=', 'c.second_org_id')
        //     ->select(
        //         'o.name as organization_name',
        //         DB::raw('COUNT(CASE WHEN c.second_status_id = 0 THEN 1 END) AS s_0_cnt'),
        //         DB::raw('COUNT(CASE WHEN c.second_status_id = 2 THEN 1 END) AS s_2_cnt'),
        //         DB::raw('COUNT(CASE WHEN c.second_status_id = 3 THEN 1 END) AS s_3_cnt'),
        //         DB::raw('COUNT(CASE WHEN c.second_status_id = 4 THEN 1 END) AS s_4_cnt'),
        //         DB::raw('COUNT(CASE WHEN c.second_status_id = 6 THEN 1 END) AS s_6_cnt'),
        //         // DB::raw('COUNT(*) AS total_count'),
        //         DB::raw('(
        //             COUNT(CASE WHEN c.second_status_id = 0 THEN 1 END) +
        //             COUNT(CASE WHEN c.second_status_id = 2 THEN 1 END) +
        //             COUNT(CASE WHEN c.second_status_id = 3 THEN 1 END) +
        //             COUNT(CASE WHEN c.second_status_id = 4 THEN 1 END) +
        //             COUNT(CASE WHEN c.second_status_id = 6 THEN 1 END)
        //         ) AS total_count'),
        //         DB::raw('COUNT(CASE WHEN c.expire_date < CURRENT_DATE AND c.second_status_id != 6 AND c.status_id != 6 THEN 1 END) AS expired_count')
        //     )
        //     // ->where('c.energy_type_id', $energyTypeId)
        //     ->when(!is_null($energy_type_id), function ($query) use ($energy_type_id) {
        //         return $query->where('c.energy_type_id', $energy_type_id);
        //     })
        //     // ->where('c.second_org_id', '!=', 99)
        //     ->whereBetween('c.created_at', [
        //         \Carbon\Carbon::parse($startDate)->startOfDay(),
        //         \Carbon\Carbon::parse($endDate)->endOfDay()
        //     ])
        //     ->when(!is_null($transferred), function ($query) use ($transferred) {
        //         return $query->where('c.transferred', $transferred);
        //     })
        //     ->groupBy('o.name')
        //     ->orderBy('total_count', 'DESC')
        //     ->get();

        // $complaints = DB::table('complaints as c')
        //     ->join('organizations as o', function ($join) use ($org_id) {
        //         $join->on("c.$org_id", "=", "o.id");
        //     })
        //     ->select(
        //         'o.name as organization_name',
        //         DB::raw('COUNT(*) FILTER (WHERE c.second_status_id = 0) AS s_0_cnt'),
        //         DB::raw('COUNT(*) FILTER (WHERE c.second_status_id = 2) AS s_2_cnt'),
        //         DB::raw('COUNT(*) FILTER (WHERE c.second_status_id = 3) AS s_3_cnt'),
        //         DB::raw('COUNT(*) FILTER (WHERE c.second_status_id = 4) AS s_4_cnt'),
        //         DB::raw('COUNT(*) FILTER (WHERE c.second_status_id = 6) AS s_6_cnt'),
        //         DB::raw('(
        //     COUNT(*) FILTER (WHERE c.second_status_id = 0) +
        //     COUNT(*) FILTER (WHERE c.second_status_id = 2) +
        //     COUNT(*) FILTER (WHERE c.second_status_id = 3) +
        //     COUNT(*) FILTER (WHERE c.second_status_id = 4) +
        //     COUNT(*) FILTER (WHERE c.second_status_id = 6)
        // ) AS total_count'),
        //         DB::raw('COUNT(*) FILTER (WHERE c.expire_date < NOW() AND c.second_status_id != 6 AND c.status_id != 6) AS expired_count')
        //     )
        //     ->when(!is_null($energy_type_id), function ($query) use ($energy_type_id) {
        //         return $query->where('c.energy_type_id', $energy_type_id);
        //     })
        //     ->whereBetween('c.created_at', [
        //         \Carbon\Carbon::parse($startDate)->startOfDay(),
        //         \Carbon\Carbon::parse($endDate)->endOfDay()
        //     ])
        //     ->when(!is_null($transferred), function ($query) use ($transferred) {
        //         return $query->where('c.transferred', $transferred);
        //     })
        //     ->groupBy('o.name')
        //     ->orderBy('total_count', 'DESC')
        //     ->get();

        if ($transferred == 0) {
            $complaints = DB::table('complaints as c')
                ->join('organizations as o', 'c.organization_id', '=', 'o.id')
                ->select(
                    'o.name as organization_name',
                    DB::raw('COUNT(*) FILTER (WHERE c.status_id = 0) AS s_0_cnt'),
                    DB::raw('COUNT(*) FILTER (WHERE c.status_id = 1) AS s_1_cnt'),
                    DB::raw('COUNT(*) FILTER (WHERE c.status_id = 2) AS s_2_cnt'),
                    DB::raw('COUNT(*) FILTER (WHERE c.status_id = 3) AS s_3_cnt'),
                    DB::raw('COUNT(*) FILTER (WHERE c.status_id = 4) AS s_4_cnt'),
                    DB::raw('COUNT(*) FILTER (WHERE c.status_id = 5) AS s_5_cnt'),
                    DB::raw('COUNT(*) FILTER (WHERE c.status_id = 6) AS s_6_cnt'),
                    DB::raw('COUNT(*) FILTER (WHERE c.status_id = 7) AS s_7_cnt'),
                    DB::raw('COUNT(*) FILTER (WHERE c.status_id = 8) AS s_8_cnt'),
                    DB::raw('COUNT(*) AS total_count'),
                    DB::raw('COUNT(*) FILTER (WHERE c.expire_date < NOW() AND c.second_status_id != 6 AND c.status_id != 6) AS expired_count')
                )
                ->whereBetween('c.created_at', [
                    \Carbon\Carbon::parse($startDate)->startOfDay(),
                    \Carbon\Carbon::parse($endDate)->endOfDay()
                ])
                ->when(!is_null($energy_type_id), function ($query) use ($energy_type_id) {
                    return $query->where('c.energy_type_id', $energy_type_id);
                })
                ->where('c.transferred', false)
                ->groupBy('o.name')
                ->orderByDesc('total_count')
                ->get();
        } else {
            $complaints = DB::table('complaints as c')
                ->join('organizations as o', 'c.second_org_id', '=', 'o.id')
                ->select(
                    'o.name as organization_name',
                    DB::raw('COUNT(*) FILTER (WHERE c.second_status_id = 0) AS s_0_cnt'),
                    DB::raw('COUNT(*) FILTER (WHERE c.second_status_id = 1) AS s_1_cnt'),
                    DB::raw('COUNT(*) FILTER (WHERE c.second_status_id = 2) AS s_2_cnt'),
                    DB::raw('COUNT(*) FILTER (WHERE c.second_status_id = 3) AS s_3_cnt'),
                    DB::raw('COUNT(*) FILTER (WHERE c.second_status_id = 4) AS s_4_cnt'),
                    DB::raw('COUNT(*) FILTER (WHERE c.second_status_id = 5) AS s_5_cnt'),
                    DB::raw('COUNT(*) FILTER (WHERE c.second_status_id = 6) AS s_6_cnt'),
                    DB::raw('COUNT(*) FILTER (WHERE c.second_status_id = 7) AS s_7_cnt'),
                    DB::raw('COUNT(*) FILTER (WHERE c.second_status_id = 8) AS s_8_cnt'),
                    DB::raw('COUNT(*) AS total_count'),
                    DB::raw('COUNT(*) FILTER (WHERE c.expire_date < NOW() AND c.second_status_id != 6 AND c.status_id != 6) AS expired_count')
                )
                ->when(!is_null($energy_type_id), function ($query) use ($energy_type_id) {
                    return $query->where('c.energy_type_id', $energy_type_id);
                })
                ->whereBetween('c.created_at', [
                    \Carbon\Carbon::parse($startDate)->startOfDay(),
                    \Carbon\Carbon::parse($endDate)->endOfDay()
                ])
                ->where('c.transferred', true)
                ->groupBy('o.name')
                ->orderByDesc('total_count')
                ->get();
        }

        // dd($complaints);

        $energy_types = EnergyType::all();

        return view('reports.report-status', ['complaints' => $complaints, 'energy_types' => $energy_types, 'energy_type_id' => $energy_type_id, 'start_date' => $start_date, 'end_date' => $end_date]);
    }
}
