<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KoBoToolbox</title>
    {{--
    <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite('resources/css/app.css')

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body class="font-sans bg-gray-100 m-0 p-0">
    <div class="bg-blue-500 text-white text-center py-10 px-5">
        <h1 class="text-3xl font-bold">Welcome to KoBoToolbox</h1>
        <p class="text-lg mt-3">A powerful tool for mobile data collection, form design, and analysis.</p>
        <div class="mt-5">
            <a href="#"
                class="border border-white text-white py-2 px-5 text-lg rounded-lg hover:bg-white hover:text-blue-500 transition">Learn
                More</a>
        </div>
    </div>

    <div class="container mx-auto mt-10 px-5">
        <div class="max-w-md mx-auto">
            <div
                class="bg-white text-center p-5 border border-gray-300 rounded-lg shadow-md hover:shadow-lg transition-transform transform hover:-translate-y-1">
                <i class="fas fa-database text-blue-500 text-4xl mb-3"></i>
                <h4 class="text-xl font-semibold">Build Form from Scratch</h4>
                <p class="text-gray-600 mt-2">Build form from scratch using advanced tools like drag-and-drop and
                    question libraries.</p>
                <a href="{{ url('/form') }}"
                    class="mt-4 inline-block bg-blue-500 text-white py-2 px-5 rounded-lg hover:bg-blue-600 transition">Build
                    from Scratch</a>
            </div>
        </div>
    </div>
</body>

</html>