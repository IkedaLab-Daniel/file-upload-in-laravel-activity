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

        return redirect()->route('files.list')->with('success', 'File uploaded successfully!');
    }

    // > List all uploaded files
    public function list()
    {
        $files = Storage::disk('public')->files('uploads');
        
        // Get file details
        $fileDetails = [];
        foreach ($files as $file) {
            $fileDetails[] = [
                'name' => basename($file),
                'size' => Storage::disk('public')->size($file),
                'url' => Storage::url($file)
            ];
        }

        return view('file.list', ['files' => $fileDetails]);
    }

    // > Display single file
    public function show($filename)
    {
        $url = Storage::url("uploads/{$filename}");

        return view('file.show', ['url' => $url]);
    }

    // > Delete file
    public function delete($filename)
    {
        $filePath = 'uploads/' . $filename;
        
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            return redirect()->route('files.list')->with('success', 'File deleted successfully!');
        }

        return redirect()->route('files.list')->with('error', 'File not found!');
    }
}
