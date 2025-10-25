<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View File</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
        }
        .nav {
            margin-bottom: 30px;
            padding: 10px;
            background: #f0f0f0;
            border-radius: 5px;
        }
        .nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        .nav a:hover {
            color: #007bff;
        }
        .file-preview {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }
        .file-preview img {
            max-width: 100%;
            height: auto;
        }
        .file-preview iframe {
            width: 100%;
            height: 600px;
            border: none;
        }
    </style>
</head>
<body>
    <div class="nav">
        <a href="{{ route('upload.page') }}">📤 Upload</a>
        <a href="{{ route('files.list') }}">📁 View Files</a>
    </div>

    <h1>File Preview</h1>
    
    <div class="file-preview">
        @if(str_ends_with($url, '.pdf'))
            <iframe src="{{ $url }}"></iframe>
        @else
            <img src="{{ $url }}" alt="File preview">
        @endif
    </div>
</body>
</html>
