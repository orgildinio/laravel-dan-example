<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
            ->join('organizations as o', 'c.organization_id', '=', 'o.id')
            ->join('complaint_types as ct', 'c.complaint_type_id', '=', 'ct.id')
            ->select(
                'o.id as organization_id',
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
}
