<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 Internal server error</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class=" bg-gray-100 text-black font-sans flex justify-center items-center h-screen">

    <div class="container mx-auto text-center">
        <h1 class="text-6xl font-bold">500</h1>
        <h2 class="text-4xl mb-4">Internal server error</h2>
        <div class="mb-8">
            <img src="{{ asset('images/500-image.png') }}" alt="500 Image" class="max-w-xs mx-auto">
        </div>
        <p class="text-lg mb-8">We apologize. It seems like those pesky bugs are causing trouble, and our server isn't
            feeling well.
            Please be patient or try again later.</p>
        <a href="{{ url('/') }}"
            class="inline-block bg-white text-blue-700 px-6 py-3 rounded-lg text-lg font-medium transition duration-300 hover:bg-blue-600 hover:text-white">Go
            Home</a>
        <button onclick="window.location.reload()"
            class="ml-4 inline-block bg-white text-blue-700 px-6 py-3 rounded-lg text-lg font-medium transition duration-300 hover:bg-blue-600 hover:text-white">Try
            Again</button>
    </div>

</body>

</html>
