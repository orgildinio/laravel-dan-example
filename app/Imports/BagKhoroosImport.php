<?php

namespace App\Imports;

use App\Models\BagKhoroo;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class BagKhoroosImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            // Skip the header row
            if ($index === 0) {
                continue;
            }

            // Ensure the required columns exist
            if (!isset($row[0]) || !isset($row[1])) {
                continue;
            }

            BagKhoroo::firstOrCreate([
                'name' => trim($row[0]),               // Column A
                'soum_district_id' => intval($row[1]), // Column B
            ]);
        }
    }
}
