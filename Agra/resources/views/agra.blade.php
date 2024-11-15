<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AGRA</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <script src="{{asset('js/app.js')}}"></script>
    <style>

        .container{
            height: 40vh;
            width: 50vh;
            position: relative;

            transform: translate(-50%, -50%);
            perspective: 1000px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .box{
            height: 250px;
            width: 250px;
            position: static;

            transform-style: preserve-3d;
            animation: animate 10s infinite;
        }
        @keyframes animate{
            0%{
                transform: rotateX(45deg) rotateY(-45deg);
            }
            25%{
                transform: rotateX(-45deg) rotateY(-45deg);
            }
            50%{
                transform: rotateX(45deg) rotateY(45deg);
            }
            75%{
                transform: rotateX(-45deg) rotateY(45deg);
            }
            100%{
                transform: rotateX(45deg) rotateY(-45deg);
            }
        }
        .card{
            height: 250px;
            width: 250px;
            text-align: center;
            padding: 100px 0px;
            background-image: url('bg-box3.png');
            background-size: cover; /* Cover the entire div */
            background-repeat: no-repeat; /* Prevent repeat */
            background-position: center;

            box-sizing: border-box;
            position: absolute;
            transition: all 1s;
        }
        #front{
            transform: translateZ(125px);

        }
        #back{
            transform: translateZ(-125px);
        }
        #left{
            right: 125px;
            transform: rotateY(-90deg);
        }
        #right{
            left: 125px;
            transform: rotateY(90deg);
        }
        #top{
            bottom: 125px;
            transform: rotateX(90deg);
        }
        #bottom{
            top: 125px;
            transform: rotateX(-90deg);
        }
        input{
            background: pink;
            font-size: 22px;
            cursor: pointer;
            position: absolute;
        }
         .active #front {
            transform: translateZ(180px) rotateY(360deg);
        }
        .active #back {
            transform: translateZ(-180px) rotateY(360deg);
        }
        .active #left {
            right: 180px;
        }
        .active #right {
            left: 180px;
        }
        .active #top {
            bottom: 180px;
        }
        .active #bottom {
            top: 180px;
        }
        @media (max-width: 1280px) {
            .container {
                height: 100vh;
                width: 120vh;
                display: flex;
                justify-content: center;
                align-items: end;
            }
        }

        /* 1180px and below */
        @media (max-width: 1180px) {
            .container {
                height: 100vh;
                width: 100vh;
                display: flex;
                justify-content: center;
                align-items: end;
            }
        }

        /* 1080px and below */
        @media (max-width: 1080px) {
            .container {
                height: 100vh;
                width: 90vh;
                display: flex;
                justify-content: center;
                align-items: end;
            }
        }

        /* 980px and below */
        @media (max-width: 980px) {
            .container {
                height: 95vh;
                width: 75vh;
                display: flex;
                justify-content: center;
                align-items: end;
            }
        }

        /* 880px and below */
        @media (max-width: 880px) {
            .container {
                height: 90vh;
                width: 70vh;
                display: flex;
                justify-content: center;
                align-items: end;
            }
        }

        /* 780px and below */
        @media (max-width: 780px) {
            .container {
                height: 100vh;
                width: 60vh;
                display: flex;
                justify-content: center;
                align-items: end;
            }
        }

        /* 680px and below */
        @media (max-width: 680px) {
            .container {
                height: 100vh;
                width: 50vh;
                display: flex;
                justify-content: center;
                align-items: end;
            }
        }

        /* 580px and below */
        @media (max-width: 580px) {
            .container {
                height: 90vh;
                width: 40vh;
                display: flex;
                justify-content: center;
                align-items: end;
            }
            #left{
                right: 87px;
                transform: rotateY(-90deg);
            }
        }

        /* 480px and below */
        @media (max-width: 480px) {
            .container {
                height: 60vh;
                width: 20vh;
                display: flex;
                justify-content: end;
                align-items: end;
            }
            #left{
                right: 60px;
                transform: rotateY(-90deg);
            }
        }
    </style>


</head>
<body>
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
<div class="outerDiv flex flex-wrap flex-row bg-gradient-to-r from-blue-800 to-blue-600 min-h-full pl-5 pr-5 pb-10">
    <!--Inner div-->
    <div class="innerDiv flex-col xl:flex xl:flex-row bg-transparent h-full w-full rounded-xl overflow-hidden">
        <div class="left-panel flex flex-col  bg-gray-900 h-100vh  p-10 gap-y-10 xl:pb-0 pb-30">

            <section class="bg-transparent dark:bg-gray-200">
                <div class="py-8 px-4 mx-auto h-full max-w-screen-2xl text-center lg:py-16">
                    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-200 md:text-6xl sm:text-6xl lg:text-6xl dark:text-white">Learn Programming where it meets Gaming</h1>
                    <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">Here at AGRA we focus on learning where programming can be fun.</p>
                    <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                        <a href="/agraCourses" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                            See AGRA Courses
                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                        <a href="/agraCourses" class="py-3 px-5 sm:ms-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-70">
                            Learn more
                        </a>
                    </div>
                </div>
            </section>


        </div>
        <div class="right-panel p-30 xl:pl-20 flex justify-end flex-row bg-gray-900 h-100vh max-w-screen-3xl 3xl:w-3/5 w-full p-5 gap-8 items-end">
            <div class="space xl:w-2/6 w-4/6 xl:h-screnn h-full p-0"></div>
            <div class="container xl:w-full w-2/6 h-full">
                <div class="box" id="toggleBox">
                    <div class="card" id="front"></div>
                    <div class="card" id="back"></div>
                    <div class="card" id="left"></div>
                    <div class="card" id="right"></div>
                    <div class="card" id="top"></div>
                    <div class="card" id="bottom"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="outerDiv flex flex-row bg-gradient-to-r from-blue-800 to-blue-600 min-h-full pl-10 pr-10 pb-10">
<div class="flex flex-col xl:flex-row gap-20">
                            <div class="bg-gray-50 shadow-2xl dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">
                                <a href="/agraCourses" class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-green-400 mb-2">
                                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                        <path d="M17 11h-2.722L8 17.278a5.512 5.512 0 0 1-.9.722H17a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1ZM6 0H1a1 1 0 0 0-1 1v13.5a3.5 3.5 0 1 0 7 0V1a1 1 0 0 0-1-1ZM3.5 15.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2ZM16.132 4.9 12.6 1.368a1 1 0 0 0-1.414 0L9 3.55v9.9l7.132-7.132a1 1 0 0 0 0-1.418Z"/>
                                    </svg>
                                    Game
                                </a>
                                <h2 class="text-blue-800 dark:text-white text-3xl font-extrabold mb-2">Master Java and C# with Gamified Challenges!</h2>
                                <p class="text-lg font-normal text-blue-800 dark:text-gray-400 mb-4">Our gamified learning platform revolutionizes coding education by integrating analytics scoring, rankings, and time challenges to enhance your Java and C# skills.</p>
                                <a href="/agraCourses" class="text-blue-600 dark:text-blue-500 hover:underline font-medium text-lg inline-flex items-center">Get Started
                                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </a>
                            </div>

                            <div class="bg-gray-50 shadow-2xl dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">
                                <a href="/agraCourses" class="bg-purple-100 text-purple-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-purple-400 mb-2">
                                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4 1 8l4 4m10-8 4 4-4 4M11 1 9 15"/>
                                    </svg>
                                    Code
                                </a>
                                <h2 class="text-blue-800 dark:text-white text-3xl font-extrabold mb-2">Connecting Students and Instructors Through Code.</h2>
                                <p class="text-lg font-normal text-blue-800 dark:text-gray-400 mb-4">Our unified learning platform bridges the gap between students and instructors by providing a curriculum-based system for creating, completing, and tracking programming tasks with analytics and personal recommendations.</p>
                                <a href="/agraCourses" class="text-blue-600 dark:text-blue-500 hover:underline font-medium text-lg inline-flex items-center">Get Started
                                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </a>
                            </div>

                            <div class="bg-gray-50 shadow-2xl dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">
                                <a href="/agraCourses" class="bg-purple-100 text-purple-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-purple-400 mb-2">
                                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4 1 8l4 4m10-8 4 4-4 4M11 1 9 15"/>
                                    </svg>
                                    Code
                                </a>
                                <h2 class="text-blue-800 dark:text-white text-3xl font-extrabold mb-2">Study AGRA </h2>
                                <p class="text-lg font-normal text-blue-800 dark:text-gray-400 mb-4">We are dedicated to advancing technological education by providing accessible, innovative programming resources and fostering a community that cultivates creativity, problem-solving, and adaptability for the next generation of innovators.</p>
                                <a href="/agraCourses" class="text-blue-600 dark:text-blue-500 hover:underline font-medium text-lg inline-flex items-center">Get Started
                                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
</div>





    <script>
        const box = document.getElementById('toggleBox');

        box.addEventListener('click', () => {
            box.classList.toggle('active');
        });
    </script>

    <script>
        const sectionId = "{{$user->section->id}}";
        const username = "{{Auth::user()->name}}";
    </script>
    <script src="/agraNotification.js"></script>

</body>
</html>
