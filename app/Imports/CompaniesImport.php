<?php

namespace App\Imports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\ToModel;

class CompaniesImport implements ToModel
{
    /**
    * @param array $row
    */

    public function model(array $row)
    {
        return new Company([
            'name' => $row[0],
            'address' => $row[1],
            'oib' => $row[2]
        ]);
    }
}
