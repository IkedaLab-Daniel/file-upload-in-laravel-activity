<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    // > Upload
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,png,pdf|max:2048',
        ]);

        $file = $request->file('file');
        $path = $file->store('uploads', 'public');

        // TODO Additional logic (e.g., storing file information in the database)

        return "File uploaded successfully!";
    }

    // > Diesplay
    public function show($filename)
    {
        $url = Storage::url("uploads/{$filename}");

        return view('file.show', ['url' => $url]);
    }
}
