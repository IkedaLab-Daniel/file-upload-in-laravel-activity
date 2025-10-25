<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File List</title>
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
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .file-list {
            list-style: none;
            padding: 0;
        }
        .file-item {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .file-info {
            flex: 1;
        }
        .file-name {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .file-size {
            color: #666;
            font-size: 14px;
        }
        .file-actions {
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-view {
            background: #007bff;
            color: white;
        }
        .btn-view:hover {
            background: #0056b3;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background: #c82333;
        }
        .empty-state {
            text-align: center;
            padding: 50px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="nav">
        <a href="{{ route('upload.page') }}">📤 Upload</a>
        <a href="{{ route('files.list') }}">📁 View Files</a>
    </div>

    <h1>Uploaded Files</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if(count($files) > 0)
        <ul class="file-list">
            @foreach($files as $file)
                <li class="file-item">
                    <div class="file-info">
                        <div class="file-name">{{ $file['name'] }}</div>
                        <div class="file-size">{{ number_format($file['size'] / 1024, 2) }} KB</div>
                    </div>
                    <div class="file-actions">
                        <a href="{{ route('files.show', $file['name']) }}" class="btn btn-view" target="_blank">View</a>
                        <form action="{{ route('files.delete', $file['name']) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this file?');" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="empty-state">
            <h3>No files uploaded yet</h3>
            <p>Upload your first file to get started!</p>
            <a href="{{ route('upload.page') }}" class="btn btn-view">Go to Upload</a>
        </div>
    @endif
</body>
</html>
