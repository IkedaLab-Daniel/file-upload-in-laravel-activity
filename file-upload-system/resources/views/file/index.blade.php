<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 py-12">

        <nav class="flex gap-4 mb-8 p-4 bg-white rounded-lg shadow-sm">
            <a href="{{ route('upload.page') }}" class="font-medium text-blue-600 hover:text-blue-700">
                📤 Upload
            </a>
            <a href="{{ route('files.list') }}" class="font-medium text-gray-600 hover:text-gray-900">
                📁 View Files
            </a>
        </nav>


        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Upload File</h1>
        
        <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data" 
              class="bg-white rounded-lg shadow-sm border-2 border-dashed border-gray-300 p-8 text-center hover:border-gray-400 transition">
            @csrf
            <p class="text-gray-600 mb-4">Select a  File [jpg, png, pdf : maximum of 2MB]</p>
            <input type="file" name="file" required 
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 mb-4">
            <button type="submit" 
                    class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition font-medium">
                Upload File
            </button>
        </form>


    </div>
</body>
</html>