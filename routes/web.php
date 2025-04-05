<?php

use App\Http\Controllers\PdfController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [TestController::class, 'test']);
Route::get('/pdf', [PdfController::class, 'getAllPdfs'] );
Route::get('/pdf/{id}', [PdfController::class, 'printPdf'] )->name('pdf.print');
