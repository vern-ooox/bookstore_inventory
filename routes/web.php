<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('books.index'));

// Breeze sends users here after login, so forward them to the book list
Route::get('/dashboard', fn () => redirect()->route('books.index'))
    ->middleware('auth')
    ->name('dashboard');

// Every book, report and export route requires an administrator to be logged in
Route::middleware('auth')->group(function () {
    Route::resource('books', BookController::class);

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/pdf', [ReportController::class, 'exportPdf'])->name('reports.pdf');
    Route::get('/reports/excel', [ReportController::class, 'exportExcel'])->name('reports.excel');
});

require __DIR__.'/auth.php';