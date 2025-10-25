<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    // > Upload
    public function upload(Request $request)
    {
        $request->validate([
            // > just to be sure it accepts any file type possible
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,webp,svg,pdf,txt,rtf,csv,xml,json,doc,docx,xls,xlsx,ppt,pptx,odt,ods,odp,zip,rar,7z,tar,gz,mp3,wav,ogg,mp4,mov,avi,mkv,wmv,psd,ai,eps|max:2048',
        ]);

        $file = $request->file('file');
        // > get original filename without extension
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        // > get file extension
        $extension = $file->getClientOriginalExtension();
        // > create filename with timestamp
        $filename = $originalName . '-' . date('YmdHis') . '.' . $extension;
        
        // > store file
        $path = $file->storeAs('uploads', $filename, 'public');

        // > save to database
        File::create([
            'filename' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return redirect()->route('files.list')->with('success', 'File uploaded successfully!');
    }

    // > List all uploaded files
    public function list()
    {
        // Get files from database instead of storage
        $files = File::orderBy('created_at', 'desc')->get();
        
        // Format file details
        $fileDetails = [];
        foreach ($files as $file) {
            $fileDetails[] = [
                'id' => $file->id,
                'name' => $file->filename,
                'original_name' => $file->original_name,
                'size' => $file->file_size,
                'mime_type' => $file->mime_type,
                'uploaded_at' => $file->created_at->diffForHumans(),
                'url' => Storage::url($file->file_path)
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
            // Delete from database
            File::where('filename', $filename)->delete();
            return redirect()->route('files.list')->with('success', 'File deleted successfully!');
        }

        return redirect()->route('files.list')->with('error', 'File not found!');
    }
}
