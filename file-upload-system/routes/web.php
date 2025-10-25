<?php

use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;

// Upload page
Route::get('/', function () {
    return view('file.index');
})->name('upload.page');

// > Upload file
Route::post('/upload', [FileUploadController::class, 'upload'])->name('upload');

// > get and show all
Route::get('/files', [FileUploadController::class, 'list'])->name('files.list');

// > viewing
Route::get('/files/{filename}', [FileUploadController::class, 'show'])->name('files.show');

//  > delete file
Route::delete('/files/{filename}', [FileUploadController::class, 'delete'])->name('files.delete');