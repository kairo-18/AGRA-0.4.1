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
            <span class="block text-lm text-gray-900 dark:text-white">{{$user->name}}</span>
            <span class="block text-lm  text-gray-500 truncate dark:text-gray-400">{{$user->name}}@example.com</span>
        </div>

        <ul class="py-2" aria-labelledby="user-menu-button">
            <li>
                <a href="#" class="block px-4 py-2 text-lm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Profile</a>
            </li>
            <li>
                <a href="#" class="block px-4 py-2 text-lm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Analytics</a>
            </li>
            <li>
                <a href="#" class="block px-4 py-2 text-lm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
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
                <h1 class="text-4xl font-bold text-blue-800">Hello {{$user->name}}, Here are your grades!</h1>
                <h1 class="text-1xl text-blue-600">Time to learn back to square one but with fun.</h1>
            </div>

            <div class="panel-content p-4 overflow-auto">
                <table class="panel-table min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-2xl font-medium text-gray-500 uppercase tracking-wider">Activities</th>
                        <th class="px-6 py-3 text-left text-2xl font-medium text-gray-500 uppercase tracking-wider">Start</th>
                        <th class="px-6 py-3 text-left text-2xl font-medium text-gray-500 uppercase tracking-wider">Due</th>
                        <th class="px-6 py-3 text-left text-2xl font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-2xl font-medium text-gray-500 uppercase tracking-wider">Score</th>
                        <th class="px-6 py-3 text-left text-2xl font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tasks as $task)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap hover:bg-gray-600">
                                <div class="text-xl font-medium text-gray-900 "><a href="/tasks/{{$task->id}}">{{$task->TaskName}}</a></div>
                                <div class="text-l text-gray-500">{{$task->lesson->LessonName}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-xl text-gray-900">{{ Carbon\Carbon::parse($task->DateGiven)->format('d F, Y g:i A') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-xl text-gray-900">{{ Carbon\Carbon::parse($task->Deadline)->format('d F, Y g:i A') }}</div>
                            </td>
                                <?php
                                $taskStatus = 'Pending';  // Initialize with default status

                                foreach($doneTasks as $doneTask) {
                                    if($task->id === $doneTask->id) {
                                        $taskStatus = 'Done';
                                        break;  // Exit loop once a match is found
                                    }
                                }
                                ?>
                            <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xl leading-5 font-semibold rounded-full {{ $taskStatus == 'Done' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $taskStatus }}
                    </span>
                            </td>
                            @if($taskStatus == "Done")
                                @php
                                    $latestScore = null;
                                @endphp

                                @foreach($task->score as $sc)
                                    @if ($sc->user_id == $user->id)
                                        @if (is_null($latestScore) || $sc->created_at->gt($latestScore->created_at))
                                            @php
                                                $latestScore = $sc;
                                            @endphp
                                        @endif
                                    @endif
                                @endforeach

                                @if ($latestScore)
                                    <td class="px-6 py-4 text-xl whitespace-nowrap">{{ $latestScore->score }} / {{ $latestScore->MaxScore }}</td>
                                    <td class="px-6 py-4 text-xl whitespace-nowrap">{{ $latestScore->Percentage }}%</td>
                                @else
                                    <td class="px-6 py-4 text-xl whitespace-nowrap">N/A</td>
                                @endif
                            @else
                                <td class="px-6 py-4 text-xl whitespace-nowrap">N/A</td>
                                <td class="px-6 py-4 text-xl whitespace-nowrap">N/A</td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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

</body>
</html>
