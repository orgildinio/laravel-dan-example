<?php

namespace App\Exports;

use App\Models\Complaint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithMapping;


class ExportComplaint implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithColumnWidths, WithEvents, WithMapping
{
    public function columnWidths(): array
    {
        return [
            'N' => 55,
            'L' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
            'J' => ['alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ]],
            'L' => ['alignment' => [
                // 'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ]],
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return Complaint::all();
        // $complaints = Complaint::with('complaintSteps')->get();

        // dd(json_encode($complaints));

        $complaints = Complaint::join('categories', 'complaints.category_id', '=', 'categories.id')
            ->join('channels', 'complaints.channel_id', '=', 'channels.id')
            ->join('statuses', 'complaints.status_id', '=', 'statuses.id')
            ->join('users', 'complaints.controlled_user_id', '=', 'users.id')
            ->join('organizations as org1', 'complaints.organization_id', '=', 'org1.id')
            // ->join('organizations as org2', 'complaints.second_org_id', '=', 'org2.id')
            ->join('energy_types', 'complaints.energy_type_id', '=', 'energy_types.id')
            ->join('complaint_maker_types', 'complaints.complaint_maker_type_id', '=', 'complaint_maker_types.id')
            ->select(
                'complaints.serial_number',
                'categories.name as category',
                'channels.name as channel',
                'statuses.name as status',
                'users.name as name',
                'org1.name as org_name',
                'complaints.second_org_id',
                'energy_types.name as energytype',
                'complaint_maker_types.name as orgtype',
                'complaints.lastname',
                'complaints.firstname',
                'complaints.complaint_maker_org_name',
                'complaints.phone',
                'complaints.complaint',
                'complaints.complaint_date',
            )
            ->when(isset($_GET['daterange']), function ($query) {
                $date_range = explode(' to ', $_GET['daterange']);
                $date['start'] = \Carbon\Carbon::parse($date_range[0])->format('Y-m-d H:i:s');
                $date['end'] = \Carbon\Carbon::parse($date_range[1])->format('Y-m-d H:i:s');
                $query->whereBetween('complaint_date', [$date['start'], $date['end']]);
            })
            ->when(isset($_GET['search_text']), function ($query) {
                $query->where('complaint', 'like', "%{$_GET['search_text']}%");
            })
            ->when(isset($_GET['status_id']), function ($query) {
                $query->where('status_id', $_GET['status_id']);
            })
            ->when(isset($_GET['org_id']), function ($query) {
                $query->where('organization_id', $_GET['org_id']);
            })
            ->when(isset($_GET['second_org_id']), function ($query) {
                $query->where('second_org_id', $_GET['second_org_id']);
            })
            ->when(Auth::user()->org_id != 99, function ($query) {
                $query->where('organization_id', Auth::user()->org_id);
            })
            ->when(isset($_GET['energy_type_id']), function ($query) {
                $query->where('energy_type_id', $_GET['energy_type_id']);
            })
            ->when(isset($_GET['controlled_user_id']), function ($query) {
                $query->where('controlled_user_id', $_GET['controlled_user_id']);
            })
            ->when(isset($_GET['channel_id']), function ($query) {
                $query->where('channel_id', $_GET['channel_id']);
            })
            ->when(isset($_GET['second_org_id']), function ($query) {
                $query->where('second_org_id', $_GET['second_org_id']);
            })
            ->orderBy('complaints.complaint_date', 'desc')
            ->get();

        return $complaints;
    }

    public function map($row): array
    {
        if (Auth::user()->org_id == 99) {
            return [
                $row->serial_number,
                $row->category,
                $row->channel,
                $row->status,
                $row->name,
                $row->org_name,
                $row->secondOrg?->name,
                $row->energytype,
                $row->orgtype,
                $row->lastname,
                $row->firstname,
                $row->complaint_maker_org_name,
                $row->phone,
                $row->complaint,
                $row->complaint_date,
            ];
        } else {
            return [
                $row->serial_number,
                $row->category,
                $row->channel,
                $row->status,
                $row->name,
                // $row->org_name,
                // $row->secondOrg?->name,
                // $row->energytype,
                $row->orgtype,
                $row->lastname,
                $row->firstname,
                $row->complaint_maker_org_name,
                $row->phone,
                $row->complaint,
                $row->complaint_date,
            ];
        }
    }

    public function headings(): array
    {
        if (Auth::user()->org_id == 99) {
            return [
                'Дугаар',
                'Төрөл',
                'Суваг',
                'Төлөв',
                'Хариуцсан мэргэжилтэн',
                'Хариуцсан байгууллага',
                'Холбогдох ТЗЭ',
                'Энергийн төрөл',
                'Өргөдөл гаргагчийн төрөл',
                'Овог',
                'Нэр',
                'ААН-н нэр',
                'Утас',
                'Санал хүсэлт',
                'Бүртгэсэн огноо'
            ];
        } else {
            return [
                'Дугаар',
                'Төрөл',
                'Суваг',
                'Төлөв',
                'Хариуцсан мэргэжилтэн',
                // 'Хариуцсан байгууллага',
                // 'Холбогдох ТЗЭ',
                // 'Энергийн төрөл',
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

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $cellRange = 'A1:O1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle($cellRange)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFFF00');
            },
        ];
    }
}
