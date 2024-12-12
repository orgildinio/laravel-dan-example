<?php

namespace App\Imports;

use App\Models\OrgUserData;
use Maatwebsite\Excel\Concerns\ToModel;

class OrgUserDataImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    private $orgId;

    public function __construct($orgId)
    {
        $this->orgId = $orgId;
    }

    public function model(array $row)
    {
        return OrgUserdata::updateOrCreate(
            [
                'usercode' => $row[0], // Unique column for comparison
                'regnum' => $row[3],    // Add regnum for comparison
            ],
            [
                'lastname' => $row[1],
                'firstname' => $row[2],
                'phone' => $row[4],
                'aimagCityName' => $row[5],
                'sumDistrictName' => $row[6],
                'bagKhorooName' => $row[7],
                'buildingStreet' => $row[8],
                'door' => $row[9],
                'mail' => $row[10],
                'org_id' => $this->orgId,
            ]
        );
    }
}
