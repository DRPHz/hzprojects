<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class=" bg-gray-200 text-black font-sans flex justify-center items-center h-screen">

    <div class="container mx-auto text-center">
        <h1 class="text-6xl font-bold">404</h1>
        <h2 class="text-4xl mb-4">Level not Found</h2>
        <div class="mb-8">
            <img src="{{ asset('images/404-image.png') }}" alt="404 Image" class="max-w-xs mx-auto">
        </div>
        <p class="text-lg mb-8">We apologize, but there are no secrets to be found here.</p>
        <a href="{{ url('/') }}"
            class="inline-block bg-white text-purple-900 px-6 py-3 rounded-lg text-lg font-medium transition duration-300 hover:bg-purple-800 hover:text-white">Go
            Home</a>
    </div>

</body>

</html>
