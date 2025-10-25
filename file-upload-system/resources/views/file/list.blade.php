<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File List</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 py-12">

        <nav class="flex gap-4 mb-8 p-4 bg-white rounded-lg shadow-sm">
            <a href="{{ route('upload.page') }}" class="font-medium text-gray-600 hover:text-gray-900">
                Upload File
            </a>
            <a href="{{ route('files.list') }}" class="font-medium text-gray-600 hover:text-gray-900">
                View Files
            </a>
        </nav>

        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Uploaded Files</h1>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- File List -->
        @if(count($files) > 0)
            <ul class="space-y-3">
                @foreach($files as $file)
                    <li class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-sm transition">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 min-w-0">
                                <div class="font-medium text-gray-900 truncate">{{ $file['original_name'] }}</div>
                                <div class="text-sm text-gray-500 mt-1">
                                    {{ number_format($file['size'] / 1024, 2) }} KB • 
                                    Uploaded {{ $file['uploaded_at'] }}
                                </div>
                            </div>
                            <div class="flex gap-2 ml-4">
                                <a href="{{ route('files.show', $file['name']) }}" 
                                   class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition" 
                                   target="_blank">
                                    View
                                </a>
                                <form action="{{ route('files.delete', $file['name']) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this file?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <h3 class="text-lg font-medium text-gray-900 mb-2">No files uploaded yet</h3>
                <p class="text-gray-600 mb-6">Upload your first file to get started!</p>
                <a href="{{ route('upload.page') }}" 
                   class="inline-block px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition">
                    Go to Upload
                </a>
            </div>
        @endif
    </div>
</body>
</html>
