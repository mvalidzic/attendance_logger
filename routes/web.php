<?php

use App\Http\Controllers\PdfController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [TestController::class, 'test']);
Route::get('/pdf', [PdfController::class, 'getLastMonthPdfs'] )->name('pdf.generate');
Route::get('/current-pdf', [PdfController::class, 'getCurrentMonthPdfs'] )->name('pdf.generateCurrent');
Route::get('/pdf/{id}', [PdfController::class, 'printPdf'] )->name('pdf.print');
Route::get('/current-pdf/{id}', [PdfController::class, 'printCurrentPdf'] )->name('pdf.printCurrent');
