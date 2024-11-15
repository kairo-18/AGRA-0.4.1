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
            <span class="block text-xs text-gray-900 dark:text-white">{{$user->name}}</span>
            <span class="block text-xs  text-gray-500 truncate dark:text-gray-400">{{$user->name}}@example.com</span>
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


<div class="outerDiv flex flex-wrap flex-row pb-5 pl-5 pr-5 bg-gradient-to-r from-blue-800 to-blue-600 min-h-auto ">
    <!--Inner div-->
    <div class="innerDiv xl:flex bg-gray-50 h-full w-full rounded-lg xl overflow-auto">
        <!-------------------------Start leftPanel----------------------->
        <div class="left-panel flex flex-col  bg-trnsparent h-screen w-full p-10">

            <!--1 div-->
            <div class ="lbl-course p-5 bg-transparent rounded-md">
                <h1 class="text-3xl font-bold text-blue-800">Hello, {{$user->name}}!</h1>
                <h3 class="text-xl text-blue-600">Time to learn back to square one but with fun.</h3>
            </div>

            <!--2 div Page Tabs -->
            <div class="nav-section flex content-center bg-transparent h-16 w-full pl-2">
                <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 w-full">
                    <ul class="flex flex-wrap -mb-px">
                    <li class="me-2">
                            <a href="/courses" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-blue-500 dark:hover:text-gray-300 text-xs font-semibold" >Courses</a>
                        </li>
                        <li class="me-2">
                            <a class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-xs font-semibold cursor-not-allowed">Lessons</a>
                        </li>
                        <li class="me-2">
                            <a class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-xs font-semibold cursor-not-allowed">Modules</a>
                        </li>
                        <li class="me-2">
                            <a class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 text-xs font-semibold" aria-current="page">Tasks</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--3 div Courses Content-->
            <div class = "learM-section flex flex-col bg-gray-200 h-full w-full rounded-lg overflow-auto items-center p-10 shadow-inner gap-y-4">
                <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div id="accordion-arrow-icon" data-accordion="open">
                    <span class="mb-2 text-md font-bold text-blue-900 dark:text-gray-400">{{$task->TaskName}}</span>
                    <p class="mb-2 text-gray-400 text-sm font-medium dark:text-gray-400">{{$task->Description}}</p>

                    <h2 id="accordion-arrow-icon-heading-2">
                        <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right bg-gray-200 rounded-xl text-gray-600 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-400 dark:hover:bg-blue-800 gap-3" data-accordion-target="#accordion-arrow-icon-body-2" aria-expanded="true" aria-controls="accordion-arrow-icon-body-2">
                        <span>Instruction: </span>
                        <svg class="w-4 h-4 shrink-0 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.529 7.988a2.502 2.502 0 0 1 5 .191A2.441 2.441 0 0 1 10 10.582V12m-.01 3.008H10M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        </button>
                    </h2>
                    <div id="accordion-arrow-icon-body-2" class="hidden" aria-labelledby="accordion-arrow-icon-heading-2">
                        <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                            <p class="mb-2 text-gray-500 dark:text-gray-400 text-sm"><span class="font-bold">Difficulty:</span> {!!$task->TaskDifficulty !!}</p>
                        <p class="mb-2 text-gray-500 dark:text-gray-400 text-sm">{!!$task->TaskInstruction !!}</p>
                        </div>
                    </div>
                    <h2 id="accordion-arrow-icon-heading-3">
                        <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right bg-gray-200 rounded-xl text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-400 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-arrow-icon-body-3" aria-expanded="true" aria-controls="accordion-arrow-icon-body-3">
                        <span>Due Date</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                        </button>
                    </h2>
                    <div id="accordion-arrow-icon-body-3" class="hidden" aria-labelledby="accordion-arrow-icon-heading-3">
                        <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
                        <p class="mb-2 text-gray-500 dark:text-gray-400 text-sm"><strong>Date Given:</strong> {{ Carbon\Carbon::parse($task->DateGiven)->format('d F, Y g:i A') }}</p>
                        <p class="mb-2 text-gray-500 dark:text-gray-400 text-sm"><strong>Deadline:</strong> {{ Carbon\Carbon::parse($task->Deadline)->format('d F, Y g:i A') }}</p>
                        </ul>
                        </div>
                    </div>
                    <h2 id="accordion-arrow-icon-heading-4">
                        <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right bg-gray-200 rounded-xl text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-400 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-arrow-icon-body-4" aria-expanded="false" aria-controls="accordion-arrow-icon-body-4">
                        <span>Progress</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                        </button>
                    </h2>
                    <div id="accordion-arrow-icon-body-4" class="hidden" aria-labelledby="accordion-arrow-icon-heading-3">
                        <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700 text-sm">
                        @php
                            $latestScore = null;
                        @endphp

                        @foreach($task->score as $sc)
                            @if ($sc->user_id == $user->id)
                                @if (is_null($latestScore) || $sc->created_at > $latestScore->created_at)
                                        @php
                                            $latestScore = $sc;
                                        @endphp
                                @endif
                            @endif
                        @endforeach
                        @if ($latestScore)
                        <p class="mb-2 text-gray-500 dark:text-gray-400"><strong>Score:</strong> {{ $latestScore->score }} / {{ $latestScore->MaxScore }}</p>
                        <p class="mb-2 text-gray-500 dark:text-gray-400"><strong>Percentage:</strong> {{ $latestScore->Percentage }}%</p>
                        @else
                        <p class="mb-2 text-gray-500 dark:text-gray-400"><strong>Score:</strong> No submission yet</p>
                        <p class="mb-2 text-gray-500 dark:text-gray-400"><strong>Percentage:</strong> No submission yet</p>
                        @endif

                        @php
                            $taskRoutes = [
                                'Intermediate' => 'fight',
                                'Beginner' => 'fitb',
                                'Advanced' => 'output'
                            ];
                        @endphp
                        </ul>
                        </div>
                    </div>
                        <div class="flex justify-end pt-10">
                        @if (array_key_exists($task->TaskDifficulty, $taskRoutes))
                            <a href="/tasks/{{ $taskRoutes[$task->TaskDifficulty] }}/{{ $task->id }}" class="inline-flex items-center px-3 py-2 text-lg font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Play
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-------------------------End leftPanel----------------------->

        <!-------------------------Start RightPanel----------------------->
        <div class="right-panel flex flex-col bg-transparent rounded-r-lg h-screen xl:w-2/5 w-full p-5 gap-8">


            <!--------------Start Agenda-------------->
            <div class="agenda flex flex-col pl-7 pr-7 pb-7 pt-2 bg-white h-[48rem] w-full rounded-lg overflow-auto shadow">
                <!----Start lbl and border line---->
                <h1 class="flex  mb-3 text-xl font-semibold text-gray-900 dark:text-white border-b-2 border-gray-300 pb-2">Agenda
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
                                            {{$task->lesson->LessonName}}
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
                <!----End lbl and border line---->
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




<!--=====================================End outerDiv/MainDiv-=====================================-->
<script>
    const sectionId = "{{$user->section->id}}";
    const username = "{{Auth::user()->name}}";
</script>
<script src="/agraNotification.js"></script>


</body>
</html>
