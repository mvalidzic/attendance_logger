<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Services\StudentService;
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
                $studentName = $student->getAttribute('last_name') . '_' .$student->getAttribute('first_name'). '_' .$singleStudent['filename_month'];
                $view = view('pdf', ['studentData' => $singleStudent]);
                $html = $view->render();
                $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
                $pdf = Pdf::loadHTML($html)->save(public_path() . '/pdfs/'. $studentName .'.pdf');
            }
        }
        return view('test');
    }

    public function printPdf($id){
        $student = Student::find($id);
        $filenameMonth = $this->studentService->getFilenameMonth();
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
