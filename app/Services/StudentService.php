<?php

namespace App\Services;

use App\Models\Student;
use Carbon\Carbon;

class StudentService {
    public function prepareForPdf(Student $student){
        $start = new Carbon('first day of last month');
        $end = new Carbon ('last day of last month');
        $attendancesArray = [];
        $attendances = $student->attendances()->where([['attendance_date', '>=' , $start->format('Y-m-d')], ['attendance_date', '<=' , $end->format('Y-m-d')]])->get();
        foreach($attendances as $attendance){
            $rowspan = 1;
            if($attendance->getAttribute('school_hours') && $attendance->getAttribute('company_hours')){
                $rowspan = 2;
            }
            //dd($attendance->school()->first()->getAttribute('address'));
            $singleAttendance = [
                'school' => $attendance->school()->first()->getAttribute('name') . ', ' . $attendance->school()->first()->getAttribute('address'),
                'company' => $attendance->company()->first()->getAttribute('name') . ', ' . $attendance->company()->first()->getAttribute('address'),
                'attendance_date' => $attendance->getAttribute('attendance_date'),
                'school_hours' => $attendance->getAttribute('school_hours'),
                'company_hours' => $attendance->getAttribute('company_hours'),
                'rowspan' => $rowspan
            ];
            $attendancesArray[] = $singleAttendance;
        }
        $result = [
            'student_name' => $student->getAttribute('first_name') . ' ' . $student->getAttribute('last_name'),
            'oib' => $student->getAttribute('oib'),
            'program' => $student->educationalGroup()->first()->program()->first()->getAttribute('name'),
            'qualification' => $student->educationalGroup()->first()->program()->first()->getAttribute('qualification'),
            'start_date' => $student->educationalGroup()->first()->getAttribute('start_date'),
            'end_date'  => $student->educationalGroup()->first()->getAttribute('end_date'),
            'attendances' => $attendancesArray,
            'report_month' => $start->format('m/y'),
            'today' => Carbon::now()->format('d.m.Y'),
            'principal' => $student->school()->first()->getAttribute('principal'),
        ];
        return $result;
       
    }
}