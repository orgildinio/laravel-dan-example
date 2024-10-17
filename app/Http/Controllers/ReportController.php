<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Complaint;
use App\Models\EnergyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function showReport(Request $request)
    {
        $energy_type_id = $request->query('energy_type_id');
        $start_date = $request->query('startdate');
        $end_date = $request->query('enddate');

        $energyTypeId = $energy_type_id != null ? $energy_type_id : 1;

        // If start_date is null, set it to 1 month before the current date
        $startDate = $start_date != null ? $start_date : Carbon::now()->subMonth()->toDateString();

        // If end_date is null, set it to the current date
        $endDate = $end_date != null ? $end_date : Carbon::now()->toDateString();

        $reportData = DB::table('complaints as c')
            ->join('organizations as o', 'c.second_org_id', '=', 'o.id')
            ->join('complaint_types as ct', 'c.complaint_type_id', '=', 'ct.id')
            ->select(
                'o.id as second_org_id',
                'o.name',
                DB::raw("COUNT(CASE WHEN ct.name = 'Төлбөр тооцоо' AND c.channel_id = 1 THEN 1 END) AS type1_channel1_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Төлбөр тооцоо' AND c.channel_id = 2 THEN 1 END) AS type1_channel2_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Төлбөр тооцоо' AND c.channel_id = 3 THEN 1 END) AS type1_channel3_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Төлбөр тооцоо' AND c.channel_id = 4 THEN 1 END) AS type1_channel4_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Төлбөр тооцоо' AND c.channel_id = 5 THEN 1 END) AS type1_channel5_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Төлбөр тооцоо' AND c.channel_id = 6 THEN 1 END) AS type1_channel6_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Төлбөр тооцоо' AND c.channel_id = 7 THEN 1 END) AS type1_channel7_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Төлбөр тооцоо' THEN 1 END) AS type1_count_all"),

                DB::raw("COUNT(CASE WHEN ct.name = 'Чанар, хангамж' AND c.channel_id = 1 THEN 1 END) AS type2_channel1_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Чанар, хангамж' AND c.channel_id = 2 THEN 1 END) AS type2_channel2_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Чанар, хангамж' AND c.channel_id = 3 THEN 1 END) AS type2_channel3_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Чанар, хангамж' AND c.channel_id = 4 THEN 1 END) AS type2_channel4_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Чанар, хангамж' AND c.channel_id = 5 THEN 1 END) AS type2_channel5_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Чанар, хангамж' AND c.channel_id = 6 THEN 1 END) AS type2_channel6_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Чанар, хангамж' AND c.channel_id = 7 THEN 1 END) AS type2_channel7_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Чанар, хангамж' THEN 1 END) AS type2_count_all"),

                DB::raw("COUNT(CASE WHEN ct.name = 'Хэмжих хэрэгсэл' AND c.channel_id = 1 THEN 1 END) AS type3_channel1_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Хэмжих хэрэгсэл' AND c.channel_id = 2 THEN 1 END) AS type3_channel2_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Хэмжих хэрэгсэл' AND c.channel_id = 3 THEN 1 END) AS type3_channel3_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Хэмжих хэрэгсэл' AND c.channel_id = 4 THEN 1 END) AS type3_channel4_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Хэмжих хэрэгсэл' AND c.channel_id = 5 THEN 1 END) AS type3_channel5_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Хэмжих хэрэгсэл' AND c.channel_id = 6 THEN 1 END) AS type3_channel6_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Хэмжих хэрэгсэл' AND c.channel_id = 7 THEN 1 END) AS type3_channel7_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Хэмжих хэрэгсэл' THEN 1 END) AS type3_count_all"),

                DB::raw("COUNT(CASE WHEN ct.name = 'Харилцаа, ёс зүй' AND c.channel_id = 1 THEN 1 END) AS type4_channel1_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Харилцаа, ёс зүй' AND c.channel_id = 2 THEN 1 END) AS type4_channel2_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Харилцаа, ёс зүй' AND c.channel_id = 3 THEN 1 END) AS type4_channel3_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Харилцаа, ёс зүй' AND c.channel_id = 4 THEN 1 END) AS type4_channel4_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Харилцаа, ёс зүй' AND c.channel_id = 5 THEN 1 END) AS type4_channel5_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Харилцаа, ёс зүй' AND c.channel_id = 6 THEN 1 END) AS type4_channel6_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Харилцаа, ёс зүй' AND c.channel_id = 7 THEN 1 END) AS type4_channel7_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Харилцаа, ёс зүй' THEN 1 END) AS type4_count_all"),

                DB::raw("COUNT(CASE WHEN ct.name = 'Бусад' AND c.channel_id = 1 THEN 1 END) AS type5_channel1_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Бусад' AND c.channel_id = 2 THEN 1 END) AS type5_channel2_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Бусад' AND c.channel_id = 3 THEN 1 END) AS type5_channel3_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Бусад' AND c.channel_id = 4 THEN 1 END) AS type5_channel4_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Бусад' AND c.channel_id = 5 THEN 1 END) AS type5_channel5_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Бусад' AND c.channel_id = 6 THEN 1 END) AS type5_channel6_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Бусад' AND c.channel_id = 7 THEN 1 END) AS type5_channel7_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Бусад' THEN 1 END) AS type5_count_all"),

                DB::raw("COUNT(CASE WHEN ct.name = 'Халаалт' AND c.channel_id = 1 THEN 1 END) AS type6_channel1_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Халаалт' AND c.channel_id = 2 THEN 1 END) AS type6_channel2_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Халаалт' AND c.channel_id = 3 THEN 1 END) AS type6_channel3_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Халаалт' AND c.channel_id = 4 THEN 1 END) AS type6_channel4_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Халаалт' AND c.channel_id = 5 THEN 1 END) AS type6_channel5_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Халаалт' AND c.channel_id = 6 THEN 1 END) AS type6_channel6_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Халаалт' AND c.channel_id = 7 THEN 1 END) AS type6_channel7_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Халаалт' THEN 1 END) AS type6_count_all"),

                DB::raw("COUNT(CASE WHEN ct.name = 'Халуун ус' AND c.channel_id = 1 THEN 1 END) AS type7_channel1_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Халуун ус' AND c.channel_id = 2 THEN 1 END) AS type7_channel2_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Халуун ус' AND c.channel_id = 3 THEN 1 END) AS type7_channel3_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Халуун ус' AND c.channel_id = 4 THEN 1 END) AS type7_channel4_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Халуун ус' AND c.channel_id = 5 THEN 1 END) AS type7_channel5_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Халуун ус' AND c.channel_id = 6 THEN 1 END) AS type7_channel6_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Халуун ус' AND c.channel_id = 7 THEN 1 END) AS type7_channel7_count"),
                DB::raw("COUNT(CASE WHEN ct.name = 'Халуун ус' THEN 1 END) AS type7_count_all"),

                DB::raw("COUNT(CASE WHEN c.channel_id = 1 THEN 1 END) AS channel1_all"),
                DB::raw("COUNT(CASE WHEN c.channel_id = 2 THEN 1 END) AS channel2_all"),
                DB::raw("COUNT(CASE WHEN c.channel_id = 3 THEN 1 END) AS channel3_all"),
                DB::raw("COUNT(CASE WHEN c.channel_id = 4 THEN 1 END) AS channel4_all"),
                DB::raw("COUNT(CASE WHEN c.channel_id = 5 THEN 1 END) AS channel5_all"),
                DB::raw("COUNT(CASE WHEN c.channel_id = 6 THEN 1 END) AS channel6_all"),
                DB::raw("COUNT(CASE WHEN c.channel_id = 7 THEN 1 END) AS channel7_all")
            )
            ->whereBetween('c.complaint_date', [$startDate, $endDate])
            ->where('c.energy_type_id', $energyTypeId)
            ->groupBy('o.id', 'o.name')
            ->orderBy('o.id')
            ->get();

        $energy_types = EnergyType::all();

        return view('reports.report1', ['reportData' => $reportData, 'energy_types' => $energy_types, 'energy_type_id' => $energy_type_id, 'start_date' => $start_date, 'end_date' => $end_date]);
    }

    public function energyReport(Request $request)
    {
        $start_date = $request->query('startdate');
        $end_date = $request->query('enddate');

        // If start_date is null, set it to 1 month before the current date
        $startDate = $start_date != null ? $start_date : Carbon::now()->subMonth()->toDateString();

        // If end_date is null, set it to the current date
        $endDate = $end_date != null ? $end_date : Carbon::now()->toDateString();

        $complaints = DB::table('organizations as org')
            ->select(
                'org.name as organization_name',
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 1 THEN 1 ELSE 0 END) AS c1_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 9 THEN 1 ELSE 0 END) AS c9_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 10 THEN 1 ELSE 0 END) AS c10_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 11 THEN 1 ELSE 0 END) AS c11_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 12 THEN 1 ELSE 0 END) AS c12_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 13 THEN 1 ELSE 0 END) AS c13_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 14 THEN 1 ELSE 0 END) AS c14_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 15 THEN 1 ELSE 0 END) AS c15_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 29 THEN 1 ELSE 0 END) AS c29_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 30 THEN 1 ELSE 0 END) AS c30_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 31 THEN 1 ELSE 0 END) AS c31_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 32 THEN 1 ELSE 0 END) AS c32_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 33 THEN 1 ELSE 0 END) AS c33_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 34 THEN 1 ELSE 0 END) AS c34_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 39 THEN 1 ELSE 0 END) AS c39_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 40 THEN 1 ELSE 0 END) AS c40_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 42 THEN 1 ELSE 0 END) AS c42_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 78 THEN 1 ELSE 0 END) AS c78_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 79 THEN 1 ELSE 0 END) AS c79_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 80 THEN 1 ELSE 0 END) AS c80_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 81 THEN 1 ELSE 0 END) AS c81_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 82 THEN 1 ELSE 0 END) AS c82_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 83 THEN 1 ELSE 0 END) AS c83_cnt'),
                DB::raw('SUM(CASE WHEN c.complaint_type_summary_id = 84 THEN 1 ELSE 0 END) AS c84_cnt'),
                DB::raw('COUNT(c.id) as total_complaints')
            )
            ->leftJoin('complaints as c', function ($join) use ($startDate, $endDate) {
                $join->on('c.second_org_id', '=', 'org.id')
                    ->where('c.complaint_type_id', '=', 2)
                    ->whereBetween('c.complaint_date', [$startDate, $endDate]); // Add whereBetween here
            })
            ->leftJoin('complaint_type_summaries as cts', 'cts.id', '=', 'c.complaint_type_summary_id')
            ->where('org.plant_id', '=', 1)
            ->groupBy('org.name')
            ->orderBy('org.name')
            ->get();

        $complaintsByType = DB::table('organizations as org')
            ->select(
                'org.name as organization_name',
                DB::raw('SUM(CASE WHEN c.complaint_type_id = 1 THEN 1 ELSE 0 END) AS c_1'),
                DB::raw('SUM(CASE WHEN c.complaint_type_id = 2 THEN 1 ELSE 0 END) AS c_2'),
                DB::raw('SUM(CASE WHEN c.complaint_type_id = 3 THEN 1 ELSE 0 END) AS c_3'),
                DB::raw('SUM(CASE WHEN c.complaint_type_id = 5 THEN 1 ELSE 0 END) AS c_5'),
                DB::raw('SUM(CASE WHEN c.complaint_type_id = 6 THEN 1 ELSE 0 END) AS c_6'),
                DB::raw('COUNT(c.id) AS total')
            )
            // ->leftJoin('complaints as c', 'c.second_org_id', '=', 'org.id')
            ->leftJoin('complaints as c', function ($join) use ($startDate, $endDate) {
                $join->on('c.second_org_id', '=', 'org.id')
                    ->whereBetween('c.complaint_date', [$startDate, $endDate]); // Add whereBetween here
            })
            ->where('org.plant_id', '=', 1)
            ->groupBy('org.name')
            ->orderBy('org.name')
            ->get();

        $complaintsByChannel = DB::table('organizations as org')
            ->select(
                'org.name as organization_name',
                DB::raw('SUM(CASE WHEN c.channel_id = 1 THEN 1 ELSE 0 END) AS c_1'),
                DB::raw('SUM(CASE WHEN c.channel_id = 2 THEN 1 ELSE 0 END) AS c_2'),
                DB::raw('SUM(CASE WHEN c.channel_id = 3 THEN 1 ELSE 0 END) AS c_3'),
                DB::raw('SUM(CASE WHEN c.channel_id = 4 THEN 1 ELSE 0 END) AS c_4'),
                DB::raw('SUM(CASE WHEN c.channel_id = 5 THEN 1 ELSE 0 END) AS c_5'),
                DB::raw('SUM(CASE WHEN c.channel_id = 6 THEN 1 ELSE 0 END) AS c_6'),
                DB::raw('SUM(CASE WHEN c.channel_id = 7 THEN 1 ELSE 0 END) AS c_7'),
                DB::raw('COUNT(c.id) AS total')
            )
            // ->leftJoin('complaints as c', 'c.second_org_id', '=', 'org.id')
            ->leftJoin('complaints as c', function ($join) use ($startDate, $endDate) {
                $join->on('c.second_org_id', '=', 'org.id')
                    ->whereBetween('c.complaint_date', [$startDate, $endDate]); // Add whereBetween here
            })
            ->where('org.plant_id', '=', 1)
            ->groupBy('org.name')
            ->orderBy('org.name')
            ->get();



        return view('reports.energy-report', ['complaints' => $complaints, 'complaintsByType' => $complaintsByType, 'complaintsByChannel' => $complaintsByChannel, 'start_date' => $start_date, 'end_date' => $end_date]);
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
                CASE WHEN channel_id = 1 THEN 1 ELSE 0 END AS ch1,
                CASE WHEN channel_id = 2 THEN 1 ELSE 0 END AS ch2,
                CASE WHEN channel_id = 3 THEN 1 ELSE 0 END AS ch3,
                CASE WHEN channel_id = 4 THEN 1 ELSE 0 END AS ch4,
                CASE WHEN channel_id = 5 THEN 1 ELSE 0 END AS ch5,
                CASE WHEN channel_id = 6 THEN 1 ELSE 0 END AS ch6,
                CASE WHEN channel_id = 7 THEN 1 ELSE 0 END AS ch7
            ')
            ->where('energy_type_id', $energyTypeId)
            // ->whereBetween('complaint_date', [$startDate, $endDate])
            ->orderByDesc('complaint_date')
            ->orderByDesc('complaint_date')
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
                DB::raw('COUNT(*) AS total_count'),
                DB::raw('COUNT(CASE WHEN c.expire_date < CURRENT_DATE AND c.second_status_id != 6 AND c.status_id != 6 THEN 1 END) AS expired_count')
            )
            ->where('c.energy_type_id', $energyTypeId)
            ->where('c.second_org_id', '!=', 99)
            ->whereBetween('c.complaint_date', [$startDate, $endDate])
            ->groupBy('o.name')
            ->orderBy('total_count', 'DESC')
            ->get();

        // dd($complaints);

        $energy_types = EnergyType::all();

        return view('reports.report-status', ['complaints' => $complaints, 'energy_types' => $energy_types, 'energy_type_id' => $energy_type_id, 'start_date' => $start_date, 'end_date' => $end_date]);
    }
}
