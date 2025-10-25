<?php

use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('file.index');
});

Route::post('/upload', [FileUploadController::class, 'upload'])->name('upload');