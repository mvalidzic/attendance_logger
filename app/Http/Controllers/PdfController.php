<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class PdfController extends Controller
{
    public function __construct(protected StudentService $studentService)
    {
        
    }
    public function getAllPdfs(){
        $students = Student::all();
        $html = '';
        
        foreach($students as $student){
            $singleStudent = $this->studentService->prepareForPdf($student);
            if($singleStudent['attendances']){
                $studentName = $student->getAttribute('first_name');
                $view = view('pdf', ['studentData' => $singleStudent]);
                $html = $view->render();
                $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
                $pdf = Pdf::loadHTML($html)->save(public_path() . '/pdfs/'. $studentName .'.pdf');
            }
        }
        return view('test');
    }
}
