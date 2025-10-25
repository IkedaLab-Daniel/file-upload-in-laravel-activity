<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
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
        // Get original filename without extension
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        // Get file extension
        $extension = $file->getClientOriginalExtension();
        // Create filename with timestamp: originalname-20231025143022.pdf
        $filename = $originalName . '-' . date('YmdHis') . '.' . $extension;
        
        $path = $file->storeAs('uploads', $filename, 'public');

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
