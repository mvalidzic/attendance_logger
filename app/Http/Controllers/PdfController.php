<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class PdfController extends Controller
{
    public function getAllPdfs(){
        $students = Student::all();
        $html = '';
        foreach($students as $student){
            $studentName = $student->getAttribute('first_name');
            $view = view('pdf', ['studentName' => $studentName]);
            $html = $view->render();
            $pdf = Pdf::loadHTML($html)->save(public_path() . '\pdfs\test'. $studentName .'.pdf');
        }
        return dd('bla');
    }
}
