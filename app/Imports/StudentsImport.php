<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\EducationalGroup;
use App\Models\School;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
     /**
    * @param array $row
    */

    public function model(array $row)
    {
        return new Student([
            'first_name' => $row[0],
            'last_name' => $row[1],
            'oib' => $row[2],
            'educational_group_id' => EducationalGroup::where('name', $row[3])->first()->id,
            'company_id' => Company::where('name', $row[4])->first()->id,
            'school_id' => School::where('name', env('SCHOOL_NAME'))->first()->id
        ]);
    }
}
