<?php

namespace App\Exports;

use App\Models\Complaint;
use App\Models\Registration;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ExportComplaint implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithColumnWidths, WithEvents, WithMapping
{
    public function columnWidths(): array
    {
        return [
            'F' => 30,
            'G' => 30,
            'N' => 30,
            'P' => 60,
            'S' => 60,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
            'P' => ['alignment' => [
                // 'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ]],
            'S' => ['alignment' => [
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

        $complaints = Complaint::with(['complaintSteps', 'category', 'channel', 'status', 'controlledUser', 'organization', 'energyType', 'complaintType', 'complaintTypeSummary'])
            ->select('complaints.*') // Select all fields from complaints
            ->when(isset($_GET['daterange']), function ($query) {
                $date_range = explode(' to ', $_GET['daterange']);
                $query->whereBetween('created_at', [
                    \Carbon\Carbon::parse($date_range[0])->startOfDay(),
                    \Carbon\Carbon::parse($date_range[1])->endOfDay()
                ]);
            })
            ->when(isset($_GET['search_text']), function ($query) {
                $query->where('complaint', 'like', "%" . $_GET['search_text'] . "%");
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
            ->when(isset($_GET['phone']), function ($query) {
                $query->where('phone', $_GET['phone']);
            })
            ->when(isset($_GET['complaint_type_id']), function ($query) {
                $query->where('complaint_type_id', $_GET['complaint_type_id']);
            })
            ->when(isset($_GET['complaint_type_summary_id']), function ($query) {
                $query->where('complaint_type_summary_id', $_GET['complaint_type_summary_id']);
            })
            ->when(isset($_GET['expire_status']), function ($query) {
                if ($_GET['expire_status'] === 'expired') {
                    $query->where('expire_date', '<', now())->where('status_id', '!=', 6);
                } elseif ($_GET['expire_status'] === 'not_expired') {
                    $query->where('expire_date', '>', now());
                }
            })
            ->when(isset($_GET['category_id']), function ($query) {
                $query->where('category_id', $_GET['category_id']);
            })
            ->when(isset($_GET['complaint_date']), function ($query) {
                $query->whereDate('complaint_date', $_GET['complaint_date']);
            })
            ->when(isset($_GET['created_at']), function ($query) {
                $query->whereDate('created_at', $_GET['created_at']);
            })
            ->orderBy('created_at', 'desc')
            ->get();


        return $complaints;
    }

    public function map($row): array
    {
        // Get only the last complaint step, if available
        $lastStep = $row->complaintSteps->last();

        $complaintSteps = $lastStep ?
            '(' . $lastStep->created_at->format('Y-m-d') . ') ' . $lastStep->desc :
            'No steps available';  // Fallback text if no steps exist

        $mappedData = [
            $row->serial_number,
            $row->category?->name,
            $row->channel?->name,
            $row->status?->name,
            $row->controlledUser?->name,
            $row->organization?->name,
            $row->secondOrg?->name,
            $row->energyType?->name,
            $row->complaintType?->name,
            $row->complaintTypeSummary?->name,
            $row->complaintMakerType?->name,
            $row->lastname,
            $row->firstname,
            $row->complaint_maker_org_name,
            $row->phone,
            $row->complaint,
            $row->complaint_date,
            $row->created_at,
            \Carbon\Carbon::parse($row->created_at)->diffInDays($row->updated_at),
            $complaintSteps
        ];

        // Add `amount_pay` and `amount_receive` if `complaint_type_id` equals 1
        if ($row->complaint_type_id == 1) {
            $mappedData[] = $lastStep?->amount_pay ?? '';  // Add amount_pay or N/A
            $mappedData[] = $lastStep?->amount_recieve ?? '';  // Add amount_receive or N/A
        }

        if (Auth::user()->org_id == 99) {
            return $mappedData; // Return all data if org_id is 99
        } else {
            return [
                $row->serial_number,
                $row->category?->name,
                $row->channel?->name,
                $row->status?->name,
                $row->controlledUser?->name,
                $row->complaintMakerType?->name,
                $row->lastname,
                $row->firstname,
                $row->complaint_maker_org_name,
                $row->phone,
                $row->complaint,
                $row->complaint_date,
                $row->created_at,
            ];
        }
    }

    public function headings(): array
    {
        // Base headings for all users
        $headings = [
            'Дугаар',
            'Төрөл',
            'Суваг',
            'Төлөв',
            'Хариуцсан мэргэжилтэн',
            'Хариуцсан байгууллага',
            'Холбогдох ТЗЭ',
            'Энергийн төрөл',
            'Гомдлын төрөл',
            'Өргөдлийн товч утга',
            'Өргөдөл гаргагчийн төрөл',
            'Овог',
            'Нэр',
            'ААН-н нэр',
            'Утас',
            'Санал хүсэлт',
            'Өргөдөл гомдол гаргасан огноо',
            'Бүртгэсэн огноо',
            'Шийдвэрлэсэн хоног',
            'Шийдвэрлэлт',
            'Хэрэглэгч төлөх дүн',
            'Хэрэглэгчид буцаах дүн'
        ];

        // For users with org_id != 99, simplified headings
        if (Auth::user()->org_id != 99) {
            return [
                'Дугаар',
                'Төрөл',
                'Суваг',
                'Төлөв',
                'Хариуцсан мэргэжилтэн',
                'Өргөдөл гаргагчийн төрөл',
                'Овог',
                'Нэр',
                'ААН-н нэр',
                'Утас',
                'Санал хүсэлт',
                'Өргөдөл гомдол гаргасан огноо',
                'Бүртгэсэн огноо'
            ];
        }

        return $headings;
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $cellRange = 'A1:U1'; // All headers
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
