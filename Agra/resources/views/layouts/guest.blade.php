<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AGRA</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <script src="{{ asset('/js.js') }}" defer></script>

    <style>
        /* CSS for the sliding background */
        .background-wrapper {
            position: fixed; /* Use fixed positioning to cover the viewport */
            top: 0;
            left: 0;
            overflow: hidden;
            width: 100%;
            height: 100vh; /* Full height */
            z-index: 0; /* Layer behind the content */
        }
        .bg-slide {
            position: absolute;
            width: 500%; /* 5 images at 100% each */
            height: 100%;
            display: flex;
            animation: slide 25s infinite;
        }
        .bg-slide img {
            width: 50%; /* Each image takes up 20% of the container */
            height: 100%;
            object-fit: cover; /* Cover the area without distortion */
        }

        @keyframes slide {
            0% { transform: translateX(0); }
            20% { transform: translateX(-20%); }
            40% { transform: translateX(-40%); }
            60% { transform: translateX(-60%); }
            80% { transform: translateX(-80%); }
            100% { transform: translateX(0); }
        }
    </style>
    <title>Login Page</title>
</head>
<body class="font-sans text-gray-900 antialiased">
    <div id="app" class="min-h-screen bg-gray-200 flex flex-row md:flex-row">
        <div class="background-wrapper">
            <div class="bg-slide">
                <img src="/bg-login1.png" alt="Background 1">
                <img src="/bg-login2.png" alt="Background 2">
                <img src="/bg-login3.png" alt="Background 3">
                <img src="/bg-login4.png" alt="Background 4">
                <img src="/bg-login5.png" alt="Background 5">
            </div>
        </div>
        <div class="inner-div min-h-screen flex flex-row md:flex-row w-full h-full">
            <div class="left-div w-0 md:w-2/6 lg:w-3/6 xl:w-4/6 flex lg:justify-center items-center pt-6 sm:pt-0">
                <!-- Optional content for left-div -->
            </div>
            <div class="right-div w-full md:w-4/6 lg:w-3/6 xl:w-2/6 flex flex-col lg:justify-center items-center pt-6 sm:pt-0 bg-blue-900/90 rounded-xl m-5 z-10 p-5">
                <div class="flex justify-center h-48 w-48 p-0">
                    <img src="/AGRA-Logo2.png" alt="Background 1">
                </div>
                <div class="w-full sm:max-w-xl h-96 px-6 py-4 bg-white/5 dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>