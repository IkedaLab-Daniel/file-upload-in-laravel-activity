<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View File</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-12">
        <!-- Navigation -->
        <nav class="flex gap-4 mb-8 p-4 bg-white rounded-lg shadow-sm">
            <a href="{{ route('upload.page') }}" class="font-medium text-gray-600 hover:text-gray-900">
                📤 Upload
            </a>
            <a href="{{ route('files.list') }}" class="font-medium text-gray-600 hover:text-gray-900">
                📁 View Files
            </a>
        </nav>

        <h1 class="text-2xl font-semibold text-gray-900 mb-6">File Preview</h1>
        
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            @if(str_ends_with($url, '.pdf'))
                <iframe src="{{ $url }}" class="w-full h-[600px] rounded"></iframe>
            @else
                <img src="{{ $url }}" alt="File preview" class="max-w-full h-auto rounded">
            @endif
        </div>
    </div>
</body>
</html>
