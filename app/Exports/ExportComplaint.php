<?php

namespace App\Exports;

use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportComplaint implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    // public function defaultStyles(Style $defaultStyle)
    // {
    //     // Configure the default styles
    //     return $defaultStyle->getFill()->setFillType(Fill::FILL_SOLID);

    //     // Or return the styles array
    //     return [
    //         'fill' => [
    //             'fillType'   => Fill::FILL_SOLID,
    //             'startColor' => ['argb' => Color::COLOR_RED],
    //         ],
    //     ];
    // }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return Complaint::all();

        $complaints = Complaint::join('categories', 'complaints.category_id', '=', 'categories.id')
            ->join('channels', 'complaints.channel_id', '=', 'channels.id')
            ->join('statuses', 'complaints.status_id', '=', 'statuses.id')
            ->join('users', 'complaints.controlled_user_id', '=', 'users.id')
            // ->join('organizations', 'complaints.organization_id', '=', 'organizations.id')
            // ->join('energy_types', 'complaints.energy_type_id', '=', 'energy_types.id')
            // ->join('complaint_maker_types', 'complaints.complaint_maker_type_id', '=', 'complaint_maker_types.id')
            ->select(
                'categories.name as category',
                'channels.name as channel',
                'statuses.name as status',
                'users.name as name',
                // 'organizations.name as org',
                // 'energy_types.name as energy type',
                // 'complaint_maker_types.name as orgtype',
                'complaints.lastname',
                'complaints.firstname',
                'complaints.complaint_maker_org_name',
                'complaints.phone',
                'complaints.complaint',
                'complaints.complaint_date'
            )
            // ->when(isset($_GET['daterange']), function ($query) {
            //     $date_range = explode(' to ', $_GET['daterange']);
            //     $date['start'] = \Carbon\Carbon::parse($date_range[0])->format('Y-m-d H:i:s');
            //     $date['end'] = \Carbon\Carbon::parse($date_range[1])->format('Y-m-d H:i:s');
            //     $query->whereBetween('complaint_date', [$date['start'], $date['end']]);
            // })
            // ->when(isset($_GET['search_text']), function ($query) {
            //     $query->where('complaint', 'like', "%{$_GET['search_text']}%");
            // })
            // ->when(isset($_GET['status_id']), function ($query) {
            //     $query->where('status_id', $_GET['status_id']);
            // })
            // ->when(isset($_GET['org_id']), function ($query) {
            //     $query->where('organization_id', $_GET['org_id']);
            // })
            // ->when(Auth::user()->org_id != 99, function ($query) {
            //     $query->where('organization_id', Auth::user()->org_id);
            // })
            // ->when(isset($_GET['energy_type_id']), function ($query) {
            //     $query->where('energy_type_id', $_GET['energy_type_id']);
            // })
            ->orderBy('complaints.complaint_date', 'desc')
            ->get();
        dd($complaints);
        return $complaints;
    }

    public function headings(): array
    {
        return [
            'Төрөл',
            'Суваг',
            'Төлөв',
            'Хариуцсан мэргэжилтэн',
            'Хариуцсан байгууллага',
            'Энергийн төрөл',
            'Өргөдөл гаргагчийн төрөл',
            'Овог',
            'Нэр',
            'ААН-н нэр',
            'Утас',
            'Санал хүсэлт',
            'Бүртгэсэн огноо'
        ];
    }
}
