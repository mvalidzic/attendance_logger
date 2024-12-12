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
        $resultArray = [];
        foreach($students as $student){
            $resultArray[] = $this->studentService->prepareForPdf($student);
            /*$studentName = $student->getAttribute('first_name');
            $view = view('pdf', ['studentName' => $studentName]);
            $html = $view->render();
            $pdf = Pdf::loadHTML($html)->save(public_path() . '\pdfs\test'. $studentName .'.pdf');*/
        }
        dd($resultArray);
    }
}
