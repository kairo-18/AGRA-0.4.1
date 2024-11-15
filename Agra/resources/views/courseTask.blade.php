<!-- Course Tab -->

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
<div class="outerDiv flex flex-wrap flex-row pb-5 pl-5 pr-5 bg-gradient-to-r from-blue-800 to-blue-600 min-h-auto ">
    <!--Inner div-->
    <div class="innerDiv xl:flex bg-gray-50 h-full w-full rounded-lg xl overflow-auto">
        <!-------------------------Start leftPanel----------------------->
        <div class="left-panel flex flex-col  bg-trnsparent h-screen xl:3/5 w-full p-10">

            <!--1 div-->
            <div class ="lbl-course p-5 bg-transparent rounded-md">
                <h1 class="text-3xl font-bold text-blue-800">Hello   {{$user->name}}!</h1>
                <h3 class="text-xl text-blue-600">Time to learn back to square one but with fun.</h1>
            </div>

            <!--2 div Page Tabs -->
            <div class="nav-section flex content-center bg-transparent h-16 w-full pl-2">
                <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 w-full">
                    <ul class="flex flex-wrap -mb-px">
                       <li class="me-2">
                            <a href="/courses" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-blue-500 dark:hover:text-gray-300 text-xs font-semibold" >Courses</a>
                        </li>
                        <li class="me-2">
                            <a href="/courses/{{$course->id}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-blue-500 dark:hover:text-gray-300 text-xs font-semibold">Lessons</a>
                        </li>
                        <li class="me-2">
                            <a href="/lessons/{{$course->id}}/{{$lesson->id}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-blue-500 dark:hover:text-gray-300 text-xs font-semibold">Modules</a>
                        </li>
                        <li class="me-2">
                            <a class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 text-xs font-semibold" aria-current="page">Tasks</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--3 div Courses Content-->
            <div class = "learM-section flex flex-col bg-gray-200 h-full w-full rounded-lg overflow-auto items-center p-3 shadow-inner gap-y-4">
            @php
                // Ensure tasks are unique before processing
                $distinctTasks = $tasks->unique('id'); // Assuming 'id' is the unique identifier

                // Define a function to sort tasks
                $getSortedTasks = function ($tasks) {
                    return $tasks->sortBy(function($task) {
                        $now = \Carbon\Carbon::now();
                        $deadline = \Carbon\Carbon::parse($task->Deadline);

                        if ($deadline->isToday()) {
                            return 0; // Today has the highest priority
                        } elseif ($deadline->isTomorrow()) {
                            return 1; // Tomorrow next
                        } elseif ($deadline->isFuture()) {
                            return 2; // Future dates after Today and Tomorrow
                        } else {
                            return 3; // Past due is last
                        }
                    });
                };
            @endphp

            <div class="flex flex-row flex-wrap justify-start gap-3 pl-9 pt-5 bg-gray-200 rounded-xl" id="lessonsContainer">
                @foreach($getSortedTasks($distinctTasks) as $task)
                    @php
                        // Define the deadline variable
                        $deadline = \Carbon\Carbon::parse($task->Deadline);

                        // Get the word representation of the deadline and color class
                        if ($deadline->isToday()) {
                            $deadlineWord = 'Today';
                            $deadlineClass = 'text-green-500'; // Color class for "Today"
                        } elseif ($deadline->isTomorrow()) {
                            $deadlineWord = 'Tomorrow';
                            $deadlineClass = 'text-blue-500'; // Color class for "Tomorrow"
                        } elseif ($deadline->isFuture()) {
                            $deadlineWord = 'Upcoming'; // You can customize this
                            $deadlineClass = 'text-blue-900'; // Color class for future dates
                        } else {
                            $deadlineWord = 'Past Due';
                            $deadlineClass = 'text-red-600'; // Color class for past due
                        }
                    @endphp

                    <a href="/tasks/{{$task->id}}" class="yt-vid w-[18rem] h-[13rem] mt-2 focus:outline-none transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bg-white shadow-lg rounded-xl lesson-card">
                        <div class="h-1/5">
                            <div class="w-full h-32 p-3 rounded-xl bg-cover bg-center bg-image shadow-md flex justify-between">
                                <h1 class="font-bold text-xs text-blue-900">Task</h1>
                                <div class="badge mb-2 ml-2">
                                    <span class="hover:bg-blue-800 hover:text-white bg-blue-200 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 mb-3">
                                        {{$course->category->name}}
                                    </span>
                                </div>
                            </div>
                            <div class="w-full p-3 bg-white rounded-xl">
                                <h1 class="font-bold text-xs text-blue-800">{{$task->TaskName}}</h1>
                                <span class="text-gray-500 font-bold text-xs">Deadline: {{ $deadline->format('g:i A') }}</span>
                                <span class="{{ $deadlineClass }} font-bold text-xs">{{ $deadlineWord }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            </div>
        </div>
        <!-------------------------End leftPanel----------------------->

        <!-------------------------Start RightPanel----------------------->
        <div class="right-panel flex flex-col bg-transparent rounded-r-lg h-screen xl:w-2/5 w-full p-5 gap-8">


            <!--------------Start Agenda-------------->
            <div class="agenda flex flex-col pl-7 pr-7 pb-7 pt-2 bg-white h-[48rem] w-full rounded-lg overflow-auto shadow">
                <!----Start lbl and border line---->
                <h1 class="flex  mb-3 text-xl font-semibold text-blue-900 dark:text-white border-b-2 border-gray-300 pb-2">
                    Agenda
                <a href="{{ url(request()->path() . '/grades') }}" class="ml-auto text-base text-blue-600 mt-1">View grades</a>
                </h1>

                @php
                    // Ensure tasks are unique before processing
                    $uniqueTasks = $tasks->unique('id'); // Assuming 'id' is the unique identifier
                @endphp

                <ol class="relative border-s border-gray-200 dark:border-gray-700">
                    <!-- Sort unique tasks with custom ordering: Today > Tomorrow > Upcoming > Past Due -->
                    @foreach($uniqueTasks->sortBy(function($task) {
                        $now = \Carbon\Carbon::now();
                        $deadline = \Carbon\Carbon::parse($task->Deadline);

                        if ($deadline->isToday()) {
                            return 0; // Today has the highest priority
                        } elseif ($deadline->isTomorrow()) {
                            return 1; // Tomorrow next
                        } elseif ($deadline->isFuture()) {
                            return 2; // Future dates after Today and Tomorrow
                        } else {
                            return 3; // Past due is last
                        }
                    }) as $task)
                        @php
                            // Get current date and the task's deadline for each item
                            $now = \Carbon\Carbon::now();
                            $deadline = \Carbon\Carbon::parse($task->Deadline);
                            $deadlineWord = $deadline->isToday() ? 'Today' :
                                            ($deadline->isTomorrow() ? 'Tomorrow' :
                                            ($deadline->isFuture() && $deadline->diffInDays($now) <= 30 ? 'Upcoming' : 'Past Due'));

                            // Set text and background color based on deadline type
                            if ($deadline->isToday()) {
                                $deadlineClass = 'text-green-500 bg-green-100';
                            } elseif ($deadline->isTomorrow()) {
                                $deadlineClass = 'text-blue-500 bg-blue-100';
                            } elseif ($deadline->isFuture()) {
                                $deadlineClass = 'text-blue-900 bg-blue-100';
                            } else {
                                $deadlineClass = 'text-red-600 bg-red-100'; // For past due
                            }
                        @endphp

                        <li class="mb-10 ms-6">
                            <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </span>

                            <div class="flex shadow-xl rounded-md lesson-card">
                                <div class="{{ $deadlineClass }} min-h-[50px] w-2 rounded-sm"></div>
                                <div class="flex justify-between gap-10 w-full">
                                    <div class="p-2">
                                        <h3 class="flex items-center text-xs font-bold text-blue-700 dark:text-white">
                                            {{$task->TaskName}}
                                        </h3>
                                        <h5 class="flex items-center mb-1 text-xs font-bold text-gray-500 dark:text-white">
                                            {{$lesson->LessonName}}
                                        </h5>
                                        <time class="block mb-2 text-xs font-normal leading-none text-gray-500 dark:text-gray-500">
                                            <strong>Deadline:</strong>
                                            <span class="text-gray-500 font-bold text-xs">{{ $deadline->format('g:i A') }}</span>
                                            <span class="{{ $deadlineClass }} font-bold text-xs">{{ $deadlineWord }}</span>
                                        </time>
                                    </div>
                                    <div class="p-3 pt-8">
                                        <a href="/tasks/{{$task->id}}" class="inline-flex items-center px-4 py-2 text-xs font-medium text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-900 transform transition-transform duration-200 ease-in-out hover:scale-105 focus:z-10 focus:ring-4 focus:outline-none focus:ring-blue-100 dark:focus:ring-blue-900 gap-5"
                                        onclick="showTransitionOverlay(event, '/tasks/{{$task->id}}')">
                                            Go
                                            <svg class="w-5 h-3.5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ol>

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

<script>
    // Array of background images
    const backgroundImages = [
        '/bg-STItask1.png', '/bg-STItask2.png', '/bg-STItask3.png',
        '/bg-STItask4.png', '/bg-STItask5.png', '/bg-STItask6.png', '/bg-STItask7.png'
    ];

    // Shuffle the array to randomize the images
    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    // Shuffle images
    shuffleArray(backgroundImages);

    // Get all lesson cards
    const lessonCards = document.querySelectorAll('.lesson-card .bg-image');

    // Keep track of the last used image
    let lastUsedImage = null;

    lessonCards.forEach((card, index) => {
        // Ensure no two consecutive lessons get the same image
        let currentImage = backgroundImages[index % backgroundImages.length];
        if (currentImage === lastUsedImage) {
            currentImage = backgroundImages[(index + 1) % backgroundImages.length];
        }

        // Set the background image
        card.style.backgroundImage = `url(${currentImage})`;

        // Update the last used image
        lastUsedImage = currentImage;
    });
</script>

<script>
    const sectionId = "{{$user->section->id}}";
    const username = "{{Auth::user()->name}}";
</script>
<script src="/agraNotification.js"></script>

</body>
</html>
