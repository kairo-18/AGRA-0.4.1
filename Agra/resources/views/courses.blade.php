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
<style>
    .line-clamp {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
        -webkit-line-clamp: 3; /* Change the number to the number of lines you want */
    }
</style>
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
<!-- Circular Transition Overlay -->
<div id="transitionOverlay" class="fixed inset-0 bg-blue-900 opacity-0 pointer-events-none transition-all duration-1500 scale-0 rounded-full z-50 flex items-center justify-center">
    <img src="AGRA-Logo.png" alt="AGRA Logo" class="w-32 h-32 opacity-0 transition-opacity duration-1500" id="transitionImage">
</div>

<!--=====================================Start outerDiv/MainDiv-=====================================-->
<div class="outerDiv flex flex-wrap flex-row pb-5 pl-5 pr-5 bg-gradient-to-r from-blue-800 to-blue-600 min-h-auto ">
    <!--Inner div-->
    <div class="innerDiv xl:flex bg-gray-50 h-full w-full rounded-lg xl overflow-auto">
        <!-------------------------Start leftPanel----------------------->
        <div class="left-panel flex flex-col  bg-trnsparent h-screen w-full p-10">

            <!--1 div-->
            <div class ="lbl-course p-5 bg-transparent rounded-md">
                <h1 class="text-4xl font-bold text-blue-800">Hello {{$user->name}}!</h1>
                <h3 class="text-1xl text-blue-600">Time to learn back to square one but with fun.</h1>
            </div>

            <!--2 div Page Tabs -->
            <div class="nav-section flex content-center bg-transparent h-16 w-full pl-2">
                <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 w-full">
                    <ul class="flex flex-wrap -mb-px">
                        <li class="me-2">
                            <a href="/courses" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 text-lg font-semibold" aria-current="page">Courses</a>
                        </li>
                        <li class="me-2">
                            <a class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-lg font-semibold cursor-not-allowed ">Lessons</a>
                        </li>
                        <li class="me-2">
                            <a class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-lg font-semibold cursor-not-allowed">Tasks</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--3 div Courses Content-->
            <div class = "learM-section flex flex-row flex-wrap justify-center items-start bg-gray-200  h-full xl:w-full w-full rounded-lg overflow-auto p-5 shadow-inner gap-5">
                @foreach($courses as $course)
                <a href="/courses/{{$course->id}}" class="yt-vid w-[23rem] h-[20rem] focus:outline-none transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bg-white shadow-md rounded-xl lesson-card">
                    <div class="h-full">
                        <div class ="w-full h-full p-3 rounded-xl bg-cover bg-center bg-image shadow-md">
                            <h2 class="font-bold text-xl text-white mb-10">Courses</h2>
                            <h1 class="font-bold text-4xl text-white">{{$course->CourseName}}</h1>
                            <h3 class="font-medium text-base text-gray-200 line-clamp">{{$course->CourseDescription}}</h3>
                        </div>
                    </div>
                </a>
                
                @endforeach
            </div>

        </div>
        <!-------------------------End leftPanel----------------------->

        <!-------------------------Start RightPanel----------------------->
        <div class="right-panel flex flex-col bg-transparent rounded-r-lg h-screen xl:w-2/5 w-full p-5 gap-8">


            <!--------------Start Agenda-------------->
            <div class="agenda flex flex-col pl-7 pr-7 pb-7 pt-2 bg-white h-[48rem] w-full rounded-lg overflow-auto shadow">
                <!----Start lbl and border line---->
                <h1 class="flex  mb-3 text-2xl font-semibold text-gray-900 dark:text-white border-b-2 border-gray-300 pb-2">Agenda </h1>


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
                            // Determine if the current task is "Done"
                        $taskStatus = 'Pending'; // Default status
                        $isDone = false;

                        foreach($doneTasks as $doneTask) {
                            if ($task->id === $doneTask->task_id) {
                                $taskStatus = 'Done';
                                $isDone = true;
                                break;
                            }
                        }
                                // Get current date and the task's deadline for each item
                                $now = \Carbon\Carbon::now();
                                $deadline = \Carbon\Carbon::parse($task->Deadline);
                                $deadlineWord = $deadline->isToday() ? 'Today' :
                                                ($deadline->isTomorrow() ? 'Tomorrow' :
                                                ($deadline->isFuture() && $deadline->diffInDays($now) <= 30 ? 'Upcoming' : 'Past Due'));

                                // Set text and background color based on deadline type
                                if(!$isDone){
                                    if ($deadline->isToday()) {
                                        $deadlineClass = 'text-green-500 bg-green-100';
                                    } elseif ($deadline->isTomorrow()) {
                                        $deadlineClass = 'text-blue-500 bg-blue-100';
                                    } elseif ($deadline->isFuture()) {
                                        $deadlineClass = 'text-blue-900 bg-blue-100';
                                    } else {
                                        $deadlineClass = 'text-red-600 bg-red-100'; // For past due
                                    }
                                }else{
                                        $deadlineClass = 'text-green-500 bg-green-100';
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
                                        <h3 class="flex items-center text-lg font-bold text-blue-700 dark:text-white">
                                            {{$task->TaskName}}
                                            @if ($isDone)
                                                <span class="ml-2 text-sm text-green-600 font-semibold">(Done)</span> <!-- Done indicator -->
                                            @endif
                                        </h3>
                                        <h5 class="flex items-center mb-1 text-md font-bold text-gray-500 dark:text-white">
                                            {{ $task->lesson->LessonName}}
                                        </h5>
                                        <time class="block mb-2 text-sm font-normal leading-none text-gray-500 dark:text-gray-500">
                                            <strong>Deadline:</strong>
                                            <span class="text-gray-500 font-bold text-sm">{{ $deadline->format('g:i A') }}</span>
                                            <span class="{{ $deadlineClass }} font-bold text-sm">{{ $deadlineWord }}</span>
                                        </time>
                                    </div>
                                    <div class="p-3 pt-8">
                                        <a href="/tasks/{{$task->id}}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-900 transform transition-transform duration-200 ease-in-out hover:scale-105 focus:z-10 focus:ring-4 focus:outline-none focus:ring-blue-100 dark:focus:ring-blue-900 gap-5"
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
                <x-calendar :tasks="$tasks" />
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

<script>
    // Array of background images
    const backgroundImages = [
        'bg-course1.png', 'bg-course2.png', 'bg-course3.png',
        'bg-course4.png', 'bg-course5.png', 'bg-course6.png', 'bg-course7.png'
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


</body>
</html>
