<!-- Lesson Tab -->

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lessons</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <script src="{{asset('js/app.js')}}"></script>

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
<div class="outerDiv flex flex-wrap flex-row pb-5 pl-5 pr-5 bg-gradient-to-r from-blue-800 to-blue-600 min-h-auto ">
    <!--Inner div-->
    <div class="innerDiv xl:flex bg-gray-50 h-full w-full rounded-lg xl overflow-auto">
        <!-------------------------Start leftPanel----------------------->
        <div class="left-panel flex flex-col  bg-trnsparent h-screen w-full p-10">

            <!--1 div-->
            <div class ="lbl-course p-5 bg-transparent rounded-md">
                <h1 class="text-4xl font-bold text-blue-800">References</h1>
                <h3 class="text-1xl text-blue-600">Books used as basis for Agra Courses</h1>
            </div>

            <!--2 div Page Tabs -->
            <div class="nav-section flex content-center bg-transparent h-16 w-full pl-2">
                <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 w-full flex justify-start">
                    <a href="/agraCourses" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-blue-500 dark:hover:text-gray-300 text-lg font-semibold">Back to Courses</a>
                </div>
            </div>

            <!--3 div Courses Content-->
            <div class="learM-section flex flex-col bg-gray-200 h-screen w-full rounded-lg overflow-auto items-center p-10 shadow-inner gap-y-4">
                <!-- JAVA Section -->
                <div class="course-section w-full">
                    <h2 class="text-3xl font-bold text-blue-800 mb-4">JAVA:</h2>
                    <div class="grid grid-cols-4 gap-4 mb-8">
                        <a class="group course-box bg-white shadow p-4 hover:bg-blue-800 hover:transform hover:scale-105 transition-all duration-300">
                            <div class="bg-gray-300 mb-4 h-1/2 w-full overflow-hidden">
                                <img src="/ReferenceAssets/Head-First-Java.png" alt="Head First Java Thumbnail" class="h-full w-full">
                            </div>
                            <h3 class="text-xl font-semibold">Head First Java (3rd Edition)</h3>
                            <p class="text-gray-600 group-hover:text-white">Kathy Sierra & Bert Bates <span class="float-right group-hover:text-white">(2005)</span></p>
                        </a>
                        <a class="course-box bg-white shadow p-4 hover:bg-blue-800 hover:transform hover:scale-105 transition-all duration-300">
                            <div class="bg-gray-300 mb-4 h-1/2 w-full overflow-hidden">
                                <img src="/ReferenceAssets/Java-Fundamentals.jpg" alt="Core Java Volume I Thumbnail" class="h-full w-full">
                            </div>
                            <h3 class="text-xl font-semibold">Core Java Volume I - Fundamentals (11th Edition)</h3>
                            <p class="text-gray-600 hover:text-white transition-colors duration-300">Cay S. Horstmann <span class="float-right">(2018)</span></p>
                        </a>
                        <a class="course-box bg-white shadow p-4 hover:bg-blue-800 hover:transform hover:scale-105 transition-all duration-300">
                            <div class="bg-gray-300 mb-4 h-24 overflow-hidden">
                                <img src="/ReferenceAssets/Effective-Java.jpg" alt="Effective Java Thumbnail" class="h-full w-full object-cover">
                            </div>
                            <h3 class="text-xl font-semibold">Effective Java (3rd Edition)</h3>
                            <p class="text-gray-600 hover:text-white transition-colors duration-300">Joshua Bloch <span class="float-right">(2017)</span></p>
                        </a>
                        <a class="course-box bg-white shadow p-4 hover:bg-blue-800 hover:transform hover:scale-105 transition-all duration-300">
                            <div class="bg-gray-300 mb-4 h-24 overflow-hidden">
                                <img src="/ReferenceAssets/Thinking-Java.jpg" alt="Thinking in Java Thumbnail" class="h-full w-full object-cover">
                            </div>
                            <h3 class="text-xl font-semibold">Thinking in Java (4th Edition)</h3>
                            <p class="text-gray-600 hover:text-white transition-colors duration-300">Bruce Eckel <span class="float-right">(2006)</span></p>
                        </a>
                    </div>
                    <div class="grid grid-cols-4 gap-4 mb-8">
                        <a class="course-box bg-white shadow p-4 hover:bg-blue-800 hover:transform hover:scale-105 transition-all duration-300">
                            <div class="bg-gray-300 mb-4 h-24 overflow-hidden">
                                <img src="/ReferenceAssets/Java-Complete-Reference.jpg" alt="Java: The Complete Reference Thumbnail" class="h-full w-full object-cover">
                            </div>
                            <h3 class="text-xl font-semibold">Java: The Complete Reference (11th Edition)</h3>
                            <p class="text-gray-600 hover:text-white transition-colors duration-300">Herbert Schildt <span class="float-right">(2018)</span></p>
                        </a>
                        <a class="course-box bg-white shadow p-4 hover:bg-blue-800 hover:transform hover:scale-105 transition-all duration-300">
                            <div class="bg-gray-300 mb-4 h-24 overflow-hidden">
                                <img src="/ReferenceAssets/Java-Puzzlers.jpg" alt="Java Puzzlers Thumbnail" class="h-full w-full object-cover">
                            </div>
                            <h3 class="text-xl font-semibold">Java Puzzlers</h3>
                            <p class="text-gray-600 hover:text-white transition-colors duration-300">Joshua Bloch & Neal Gafter <span class="float-right">(2005)</span></p>
                        </a>
                        <a class="course-box bg-white shadow p-4 hover:bg-blue-800 hover:transform hover:scale-105 transition-all duration-300">
                            <div class="bg-gray-300 mb-4 h-24 overflow-hidden">
                                <img src="/ReferenceAssets/Java-Tutorial.jpg" alt="The Java Tutorial Thumbnail" class="h-full w-full object-cover">
                            </div>
                            <h3 class="text-xl font-semibold">The Java Tutorial</h3>
                            <p class="text-gray-600 hover:text-white transition-colors duration-300">Oracle <span class="float-right">(2021)</span></p>
                        </a>
                    </div>
                </div>

                <!-- C# Section -->
                <div class="course-section w-full">
                    <h2 class="text-3xl font-bold text-blue-800 mb-4">C#:</h2>
                    <div class="grid grid-cols-4 gap-4 mb-8">
                        <a class="course-box bg-white shadow p-4 hover:bg-blue-800 hover:transform hover:scale-105 transition-all duration-300">
                            <div class="bg-gray-300 mb-4 h-24 overflow-hidden">
                                <img src="/ReferenceAssets/C-Fundamentals.jpg" alt="C# Fundamentals Thumbnail" class="h-full w-full object-cover">
                            </div>
                            <h3 class="text-xl font-semibold">C# Fundamentals - C# 10 and .NET 6 using Visual Studio 2022: Course in a Book</h3>
                            <p class="text-gray-600 hover:text-white transition-colors duration-300">Adam Seebak <span class="float-right">(2022)</span></p>
                        </a>
                        <a class="course-box bg-white shadow p-4 hover:bg-blue-800 hover:transform hover:scale-105 transition-all duration-300">
                            <div class="bg-gray-300 mb-4 h-24 overflow-hidden">
                                <img src="/ReferenceAssets/Pro-C.jpg" alt="Pro C# Thumbnail" class="h-full w-full object-cover">
                            </div>
                            <h3 class="text-xl font-semibold">Pro C# 10 with .Net 6: Foundational Principles and Practices in Programming</h3>
                            <p class="text-gray-600 hover:text-white transition-colors duration-300">Andrew Troelsen & Phil Japikse <span class="float-right">(2021)</span></p>
                        </a>
                        <a class="course-box bg-white shadow p-4 hover:bg-blue-800 hover:transform hover:scale-105 transition-all duration-300">
                            <div class="bg-gray-300 mb-4 h-24 overflow-hidden">
                                <img src="/ReferenceAssets/Starting-C.jpg" alt="The Java Tutorial Thumbnail" class="h-full w-full object-cover">
                            </div>
                            <h3 class="text-xl font-semibold">Starting out with C# (Early Objects)</h3>
                            <p class="text-gray-600 hover:text-white transition-colors duration-300">Tony Gaddis <span class="float-right">(2019)</span></p>
                        </a>
                        <a class="course-box bg-white shadow p-4 hover:bg-blue-800 hover:transform hover:scale-105 transition-all duration-300">
                            <div class="bg-gray-300 mb-4 h-24 overflow-hidden">
                                <img src="/ReferenceAssets/C-Depth.jpg" alt="The Java Tutorial Thumbnail" class="h-full w-full object-cover">
                            </div>
                            <h3 class="text-xl font-semibold">C# in Depth (Fourth Edition)</h3>
                            <p class="text-gray-600 hover:text-white transition-colors duration-300">Jon Skeet <span class="float-right">(2019)</span></p>
                        </a>
                    </div>
                    <div class="grid grid-cols-4 gap-4 mb-8">
                        <a class="course-box bg-white shadow p-4 hover:bg-blue-800 hover:transform hover:scale-105 transition-all duration-300">
                            <div class="bg-gray-300 mb-4 h-24 overflow-hidden">
                                <img src="/ReferenceAssets/C-Headstart.jpg" alt="The Java Tutorial Thumbnail" class="h-full w-full object-cover">
                            </div>
                            <h3 class="text-xl font-semibold">Head First C# (5th Edition)</h3>
                            <p class="text-gray-600 hover:text-white transition-colors duration-300">Jennifer Greene <span class="float-right">(2021)</span></p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-------------------------End leftPanel----------------------->

        <!-------------------------Start RightPanel----------------------->
        <div class="right-panel flex flex-col bg-transparent rounded-r-lg h-screen xl:w-2/5 w-full p-5 gap-8">


            <!--------------Start Agenda-------------->
            <div class="agenda flex flex-col pl-7 pr-7 pb-7 pt-2 bg-white h-[30rem] w-full rounded-lg overflow-auto shadow">
                <!----Start lbl and border line---->
                <h1 class="flex mb-3 text-2xl font-semibold text-gray-900 dark:text-white border-b-2 border-gray-300 pb-2">
                    Agenda
                </h1>

                <ol class="relative border-s border-gray-200 dark:border-gray-700">

                    <!----Agenda deadline 1---->
                    @foreach($tasks as $task)
                        <li class="mb-10 ms-6">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </span>Type

                            <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">{{$task->TaskName}}</h3>
                            <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ $task->DateGiven->format('m-d-Y') }} - {{ $task->Deadline->format('m-d-Y') }}</time>
                            <a href="/agraTasks/{{$task->id}}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700 gap-5">
                                Go
                                <svg class="w-5 h-3.5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" >
                                    <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>
                                </svg>
                            </a>

                        </li>

                    @endforeach
                    <!----End Agenda deadline---->
                </ol>
                <!----End lbl and border line---->
            </div>
            <!--------------End Agenda-------------->


            <!--------------Start Calendar-------------->

            @if ($allTasks->count() > 0)
                <x-calendar :tasks="$allTasks" />
            @endif
        </div>
        <!--------------End Calendar-------------->

    </div>
</div>
<!--=====================================End outerDiv/MainDiv-=====================================-->

<script>
    const sectionId = "{{$user->section->id}}";
    const username = "{{Auth::user()->name}}";
</script>
<script src="agraNotification.js"></script>

</body>
</html>
