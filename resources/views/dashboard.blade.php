<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KoBoToolbox</title>
    @vite('resources/css/app.css')

</head>

<body class="font-sans bg-gray-100">
    <div class="bg-gray-800 text-white flex items-center p-3">
        <h1 class="text-lg flex-1">KoBoToolbox</h1>
        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition"
            onclick="window.location.href='{{ url('/welcome') }}'">NEW</button>
    </div>
</body>

</html>