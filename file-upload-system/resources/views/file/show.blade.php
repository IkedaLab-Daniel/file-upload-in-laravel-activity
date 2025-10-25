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

        <nav class="flex gap-4 mb-8 py-2 px-4 justify-between items-center bg-white rounded-lg shadow-sm">
            <div class="flex gap-6">
                <a href="{{ route('upload.page') }}" class="font-medium text-gray-600 hover:text-gray-900">
                    Upload File
                </a>
                <a href="{{ route('files.list') }}" class="font-medium text-gray-600 hover:text-gray-900">
                    View Files
                </a>
            </div>
            <div>
                <img src="https://mcc.edu.ph/mcc_website_revamp_2021/img/logo.png" alt="mcc" class="w-8">
            </div>
            
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
