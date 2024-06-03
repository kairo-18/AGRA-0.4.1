<!-- Module Tab -->

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Courses</title>
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
<div class="outerDiv flex flex-wrap flex-row pb-5 pl-5 pr-5 bg-gradient-to-r from-blue-800 to-blue-600 min-h-10 ">
    <!--Inner div-->
    <div class="innerDiv xl:flex bg-gray-50 h-auto w-full rounded-lg xl overflow-auto">
        <!-------------------------Start leftPanel----------------------->
        <div class="left-panel flex flex-col  bg-trnsparent h-full w-full p-10">

            <!--1 div-->
            <div class ="lbl-course p-5 bg-transparent rounded-md">
                <h1 class="text-4xl font-bold text-blue-800">Learn to {{$lesson->LessonName}}</h1>
                <h1 class="text-1xl text-blue-600">Time to learn back to square one but with fun.</h1>
            </div>

            <!--2 div Page Tabs -->
            <div class="nav-section flex content-center bg-transparent h-16 w-full pl-2">
                <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 w-full">
                    <ul class="flex flex-wrap -mb-px">
                        <li class="me-2">
                            <a href="/courses" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-blue-500 dark:hover:text-gray-300 text-lg font-semibold" >Courses</a>
                        </li>
                        <li class="me-2">
                            <a href="/courses/{{$course->id}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-blue-500 dark:hover:text-gray-300 text-lg font-semibold">Lessons</a>
                        </li>
                        <li class="me-2">
                            <a href="/lessons/{{$course->id}}/{{$lesson->id}}" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 text-lg font-semibold" aria-current="page">Modules</a>
                        </li>
                        <li class="me-2">
                            <a href="/task/{{$course->id}}/{{$lesson->id}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-blue-500 dark:hover:text-gray-300 text-lg font-semibold">Tasks</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--3 div Courses Content-->
            <div class = "learM-section flex flex-col bg-gray-200 h-full w-full rounded-lg overflow-auto p-5 shadow-inner gap-y-4">
                <h1 class="font-bold text-2xl text-blue-800">Materials </h1>
                <div id="indicators-carousel" class="relative w-full h-full overflow-auto" data-carousel="static">
                    <!-- Carousel wrapper -->
                    <div class="relative h-full overflow-hidden rounded-lg">
                        <!-- Item 1 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                            <div class="Recommed-panel flex flex-col justify-start bg-white h-full xl:w-full w-full p-5 gap-5">
                                <h1 class="font-semibold text-xl text-blue-800">Module</h1>
                                <div class="Recommed-panel flex flex-col flex-wrap justify-start bg-gray-100 h-full gap-5 overflow-x-auto overflow-y-hidden scrollbar-thin rounded-xl shadow-inner pl-20 pr-10 pt-10">
                                    <iframe frameborder="0" class="w-full h-full rounded-xl" src="{{asset("storage/" . $lesson->LessonFile)}}" allowfullscreen allow="autoplay"></iframe>
                                </div>
                            </div>
                        </div>
                        <!-- Item 2 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <div class="Recommed-panel flex flex-col justify-start bg-white h-full xl:w-full w-full p-5 gap-5">
                                <h1 class="font-semibold text-xl text-blue-800">Videos</h1>

                                <div class="Recommed-panel flex flex-wrap justify-center bg-gray-100 h-full p-5 gap-5 rounded-xl shadow-inner">

                                    <div class="flex flex-col md:flex-row justify-start gap-5 p-3">
                                        @php
                                            $index = 1;
                                        @endphp

                                        @foreach($ytLinks as $webLink)
                                            <a href="{{ $webLink }}" class="yt-vid w-80 h-80 xl:h-72 focus:outline-none transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 rounded-xl">
                                                <div class="h-4/5">
                                                    <iframe class="mx-auto w-full lg:max-w-xl h-full rounded-lg shadow-xl" src="{{ $webLink }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </div>
                                                <div class="h-1/5 flex">
                                                    <div class="w-2/5">
                                                        <h1 class="font-bold text-xl text-blue-800">Youtube Video #{{ $index }}</h1>
                                                        <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                                                    </div>
                                                    <div class="w-3/5 p-3 flex flex-row-reverse flex-wrap">
                                                        @foreach($lesson->categories as $category)
                                                            <div class="badge mb-2 ml-2">
                                                                <span class="hover:bg-blue-800 hover:text-white bg-blue-200 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 mb-3">{{$category->name}}</span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </a>
                                            @php
                                                $index++;
                                            @endphp
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Item 3 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <div class="Recommed-panel flex flex-col justify-start bg-white h-full xl:w-full w-full p-5 gap-5">
                                <h1 class="font-semibold text-xl text-blue-800">Articles</h1>
                                <div class="Recommed-panel flex flex-wrap justify-center bg-gray-100 h-full p-5 gap-5 rounded-xl shadow-inner">
                                    <div class="flex flex-col md:flex-row justify-start gap-5 p-3">
                                        @php
                                            $index = 1;
                                        @endphp

                                        @foreach($webLinks as $webLink)
                                            <a href="{{ $webLink }}" class="yt-vid w-[27rem] h-72 focus:outline-none transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 rounded-xl">
                                                <div class="h-4/5">
                                                    <iframe class="w-full h-full rounded-lg shadow-xl" src="{{ $webLink }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </div>
                                                <div class="h-1/5 flex">
                                                    <div class="w-2/5">
                                                        <h1 class="font-bold text-xl text-blue-800">Web Article {{ $index }}</h1>
                                                        <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                                                    </div>
                                                    <div class="w-3/5 p-3 flex flex-row-reverse flex-wrap">
                                                        @foreach($lesson->categories as $category)
                                                            <div class="badge mb-2 ml-2 ">
                                                                <span class="hover:bg-blue-800 hover:text-white bg-blue-200 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 mb-3">{{$category->name}}</span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </a>
                                            @php
                                                $index++;
                                            @endphp
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slider indicators -->
                    <div class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2 bg-gray-400 p-2 rounded-full">
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                    </div>
                    <!-- Slider controls -->
                    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-400/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-blue-400 dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-blue-600 dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-400/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-blue-400 dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-blue-600 dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
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
                    <a href="{{ url(request()->path() . '/grades') }}" class="ml-auto text-base text-blue-600 mt-1">View grades</a>
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
                        <a href="/tasks/{{$task->id}}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700 gap-5">
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

                @if ($tasks->count() > 0)
                    <x-calendar :tasks="$allTasks" />
                @endif
            </div>
            <!--------------End Calendar-------------->

        </div>
    </div>
    <!--=====================================End outerDiv/MainDiv-=====================================-->




</body>
</html>
