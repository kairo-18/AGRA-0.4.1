<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="{{asset('tailwindcharts/css/flowbite.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <script src="{{asset('js/app.js')}}"></script>
    <style>
        @media (max-width: 1280px){
            body{
                overflow: hidden;
            }
        }
    </style>
</head>
<body class="h-4/6 xl:h-screen">
<!--=====================================Start Navbar=====================================-->
<x-navbar>
    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
        <div class="px-4 py-3">
            <span class="block text-sm text-gray-900 dark:text-white">{{$user->name}}</span>
            <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{$user->name}}@example.com</span>
        </div>

        <ul class="py-2" aria-labelledby="user-menu-button">
            <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Profile</a>
            </li>
            <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Analytics</a>
            </li>
            <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
            </li>
        </ul>
    </div>
</x-navbar>
<!--=====================================End Navbar=====================================-->


<!--=====================================Start outerDiv/MainDiv-=====================================-->


<div class="outerDiv flex flex-wrap flex-row bg-gradient-to-r from-blue-800 to-blue-600  h-full xl:h-[87.5vh] pl-10 pr-10 pb-10 max-h-screen xl:overflow-hidden overflow-y-auto">
    <!-- Inner div -->
    <div class="innerDiv xl:flex bg-white h-full w-full rounded-xl overflow-hidden p-0 xl:p-5">

        <div class="left-panel flex flex-col xl:flex-row bg-gray-200 h-full w-full rounded-xl shadow-xl">
            <section class="dark:bg-gray-900 w-full h-auto">
                <div class="py-2 px-2 sm:py-4 sm:px-3 mx-auto max-w-screen-md lg:py-6">
                    <!-- Tutorial Card -->
                    <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-3 sm:p-5 md:p-6 mb-4">
                        <a href="#" class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2 py-0.5 rounded-md dark:bg-gray-700 dark:text-blue-400 mb-2">
                            <svg class="w-2.5 h-2.5 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                <path d="M11 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm8.585 1.189a.994.994 0 0 0-.9-.138l-2.965.983a1 1 0 0 0-.685.949v8a1 1 0 0 0 .675.946l2.965 1.02a1.013 1.013 0 0 0 1.032-.242A1 1 0 0 0 20 12V2a1 1 0 0 0-.415-.811Z"/>
                            </svg>
                            AGRA
                        </a>
                        <h1 class="text-gray-900 dark:text-white text-lg sm:text-lg font-extrabold mb-2">About Us</h1>
                        <p class="text-xs font-normal text-gray-500 dark:text-gray-400 mb-3">We are dedicated to advancing technological education by providing accessible, innovative programming resources and fostering a community that cultivates creativity, problem-solving, and adaptability for the next generation of innovators.</p>
                        <a href="#" class="inline-flex justify-center items-center py-1 px-3 text-sm font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                            Read more
                            <svg class="w-3 h-3 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Card Grid -->
                    <div class="grid gap-4 md:grid-cols-2">
                        <!-- Design Card -->
                        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-3 sm:p-5">
                            <a href="#" class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2 py-0.5 rounded-md dark:bg-gray-700 dark:text-green-400 mb-2">
                                <svg class="w-2.5 h-2.5 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                    <path d="M17 11h-2.722L8 17.278a5.512 5.512 0 0 1-.9.722H17a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1ZM6 0H1a1 1 0 0 0-1 1v13.5a3.5 3.5 0 1 0 7 0V1a1 1 0 0 0-1-1ZM3.5 15.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2ZM16.132 4.9 12.6 1.368a1 1 0 0 0-1.414 0L9 3.55v9.9l7.132-7.132a1 1 0 0 0 0-1.418Z"/>
                                </svg>
                                Game
                            </a>
                            <h2 class="text-gray-900 dark:text-white text-lg font-extrabold mb-2">Mission</h2>
                            <p class="text-xs font-normal text-gray-500 dark:text-gray-400 mb-3">To enhance programming education through a gamified platform that simplifies evaluation and empowers learning with analytics.</p>
                            <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline font-medium text-base inline-flex items-center">Read more
                                <svg class="w-3 h-3 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>

                        <!-- Code Card -->
                        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-3 sm:p-5">
                            <a href="#" class="bg-purple-100 text-purple-800 text-xs font-medium inline-flex items-center px-2 py-0.5 rounded-md dark:bg-gray-700 dark:text-purple-400 mb-2">
                                <svg class="w-2.5 h-2.5 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4 1 8l4 4m10-8 4 4-4 4M11 1 9 15"/>
                                </svg>
                                Code
                            </a>
                            <h2 class="text-gray-900 dark:text-white text-lg font-extrabold mb-2">Vision</h2>
                            <p class="text-xs font-normal text-gray-500 dark:text-gray-400 mb-3">To be the premier tool for interactive and data-driven programming education.</p>
                            <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline font-medium text-base inline-flex items-center">Read more
                                <svg class="w-3 h-3 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>

            <!-- Right content panel with background image -->
    <div class="profile h-full flex flex-row justify-center items-center w-full xl:w-1/2 bg-white rounded-xl shadow-xl p-5">
        <div class="h-96 w-96 p-1 flex justify-center items-center">
            <img class="h-full max-w-full rounded-lg shadow-xl dark:shadow-gray-800" src="bg-about1.png" alt="image description">
        </div>
    </div>
</div>
<script>
    const sectionId = "{{$user->section->id}}";
    const username = "{{Auth::user()->name}}";
</script>
<script src="/agraNotification.js"></script>

</body>
</html>
