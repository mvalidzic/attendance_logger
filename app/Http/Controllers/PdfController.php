<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Services\StudentService;

class PdfController extends Controller
{
    public function __construct(protected StudentService $studentService)
    {
        
    }
    public function getlastMonthPdfs(){
        $this->studentService->generatePdfs('last');
        return view('test');
    }

    public function getCurrentMonthPdfs(){
        $this->studentService->generatePdfs('current');
        return view('test');
    }

    public function printPdf($id){
        $student = Student::find($id);
        $filenameMonth = $this->studentService->getLastMonth();
        $filename = $student->getAttribute('last_name') . '_' .$student->getAttribute('first_name'). '_' . $filenameMonth . '.pdf';
        $file = public_path() . '/pdfs' .'/' . $filename;
        if(file_exists($file)) {
            $headers = array(
                'Content-Type: application/pdf',
              );
              return response()->download($file, $filename, $headers);
        } else {
            echo "Lista nije generirana.";
        }
    }

    public function printCurrentPdf($id){
        $student = Student::find($id);
        $filenameMonth = $this->studentService->getCurrentMonth();
        $filename = $student->getAttribute('last_name') . '_' .$student->getAttribute('first_name'). '_' . $filenameMonth . '.pdf';
        $file = public_path() . '/pdfs' .'/' . $filename;
        if(file_exists($file)) {
            $headers = array(
                'Content-Type: application/pdf',
              );
              return response()->download($file, $filename, $headers);
        } else {
            echo "Lista nije generirana.";
        }
    }
}
