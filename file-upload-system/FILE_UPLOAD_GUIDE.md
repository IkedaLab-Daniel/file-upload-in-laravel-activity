# File Upload System - Beginner Guide

## What This Project Does

This is a simple file upload system that allows you to:
- ✅ Upload files
- ✅ View all uploaded files
- ✅ Download files
- ✅ Delete files

## File Structure

```
app/Http/Controllers/FileUploadController.php  ← Main controller with all functions
routes/web.php                                  ← Routes connecting URLs to controller
resources/views/upload.blade.php                ← HTML page for the interface
storage/app/public/uploads/                     ← Where uploaded files are stored
```

## How It Works

### 1. **FileUploadController.php** - The Main Controller

This file has 4 simple functions:

#### `index()` - Shows the upload form and file list
- Gets all files from the uploads folder
- Displays them on the page

#### `upload()` - Handles file uploads
- Checks if the file is valid (max 10MB)
- Saves the file with a unique name (timestamp + original name)
- Shows a success message

#### `download()` - Downloads a file
- Checks if the file exists
- Sends the file to download

#### `delete()` - Deletes a file
- Checks if the file exists
- Removes the file from storage
- Shows a success message

### 2. **web.php** - Routes

Routes connect URLs to controller functions:

| URL | Method | Function | What It Does |
|-----|--------|----------|--------------|
| `/` | GET | index | Shows the upload page |
| `/upload` | POST | upload | Uploads a file |
| `/download/{filename}` | GET | download | Downloads a file |
| `/delete/{filename}` | DELETE | delete | Deletes a file |

### 3. **upload.blade.php** - The View

Simple HTML page with:
- Upload form
- List of uploaded files
- Download and delete buttons for each file

## How to Use

1. **Start the server:**
   ```bash
   php artisan serve
   ```

2. **Open in browser:**
   ```
   http://localhost:8000
   ```

3. **Upload a file:**
   - Click "Choose File"
   - Select a file
   - Click "Upload File"

4. **Download or delete:**
   - Click "Download" to get the file
   - Click "Delete" to remove it (asks for confirmation)

## Important Files Explained

### Controller (`FileUploadController.php`)

```php
// Store file
$file->storeAs('public/uploads', $filename);

// Check if file exists
Storage::exists($filePath)

// Download file
Storage::download($filePath)

// Delete file
Storage::delete($filePath)
```

### Blade View (`upload.blade.php`)

```html
<!-- Upload form -->
<form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <button type="submit">Upload File</button>
</form>

<!-- Show success message -->
@if(session('success'))
    <div class="alert">{{ session('success') }}</div>
@endif

<!-- Loop through files -->
@foreach($files as $file)
    <div>{{ $file['name'] }}</div>
@endforeach
```

## Storage Location

Files are stored in: `storage/app/public/uploads/`

The `php artisan storage:link` command creates a symbolic link from `public/storage` to `storage/app/public`, making files accessible via URLs.

## Validation

Current validation rules:
- File is required
- Maximum file size: 10MB (10240 KB)

To change the max size, edit this line in the controller:
```php
'file' => 'required|file|max:10240', // Change 10240 to your desired size in KB
```

## Common Laravel Methods Used

- `Storage::files()` - Get all files in a directory
- `Storage::exists()` - Check if file exists
- `Storage::size()` - Get file size
- `Storage::url()` - Get file URL
- `Storage::download()` - Download a file
- `Storage::delete()` - Delete a file
- `$request->file()` - Get uploaded file
- `$file->storeAs()` - Store file with custom name

## Tips for Beginners

1. **CSRF Token**: Always include `@csrf` in forms to prevent security issues
2. **File Names**: We add a timestamp to prevent duplicate filenames
3. **Validation**: Always validate uploaded files for security
4. **Storage Link**: Run `php artisan storage:link` once to make files accessible
5. **Delete Method**: Use `@method('DELETE')` in forms for delete routes

## Next Steps to Learn

- Add file type restrictions (only images, PDFs, etc.)
- Add user authentication
- Create folders for different users
- Add file preview for images
- Add progress bar for uploads

Enjoy learning! 🚀
