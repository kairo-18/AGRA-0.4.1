<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <script src="{{asset('js/app.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('tasks.css') }}">
    <link rel="stylesheet" href="{{ asset('tasks2.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
    <script src="/ace-builds/src-noconflict/ext-language_tools.js"></script>
    <title>AGRA</title>
    <style>
        .coding-area{
            flex-grow: 1;
        }

        .top-6{
            top: 7.5rem;
        }

        .alert-box {
            transition: opacity 1.5s ease-out;
        }
        .fade-out {
            opacity: 0;
        }
    </style>
</head>
<body>

<!--=====================================Start Navbar=====================================-->
<x-navbar>
    <div class="z-50 hidden my-4 text-base list-none  bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
        <div class="px-4 py-3">
            <span class="block text-sm text-gray-900 dark:text-white"><a class="text-black">{{$user->name}}</a></span>
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
<div class="outerDiv flex flex-wrap flex-col pb-5 pl-5 pr-5 bg-gradient-to-r from-blue-800 to-blue-600 min-h-auto ">
    <div class="innerDiv lg:flex bg-gray-50 h-full w-full rounded-t-lg overflow-auto">

        <div class = "leftDiv flex flex-col  bg-gray-200 h-screen w-full p-5 gap-10">
            <div class="stu-progress">
            <!--Information: Score, time, prog-bar-->
                <div class="info-bar">
                    <div class="score">Score <span id="score">0</span></div>
                    <div class="timer">Timer <span id="timer">{{$task->TaskMaxTime}}</span></div>
                    <div class="pb">
                        <div class="progress-bar bg-gray-300 rounded-full dark:bg-gray-700 h-10 w-40 md:w-40 xl:w-80 mt-1.5">
                            <div class="progress-barc bg-blue-900 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full h-10 w-0"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Compiler -->
            <div class="coding-area relative h-full w-full">
                <!-- Ace Editor Div -->
                <div id="code-editor" class="w-full h-full border border-gray-300 text-lg"></div>
            </div>
            <!--idk-->
            <div id="code" style="display: none;"></div>
        </div>
        <div class = "RightDiv flex flex-col bg-gray-200 rounded-r-lg h-screen xl:w-3/5 w-full p-5 gap-8">
            <div class="mini-game" id="minigame"></div>
        </div>
</div>

<div id="startPanel" class="w-full h-full fixed inset-0 backdrop-blur-md">
        <div class="startPaneldiv2 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-blue-800 rounded-lg border shadow dark:bg-blue-700 text-white flex flex-col items-center justify-center p-4 w-3/4 max-w-md h-32">
            <h2 id="startText" class="text-center mb-2">Press start when you are ready.</h2>
            <button id="startButton" class="mt-4 mb-4 rounded-md border border-white bg-green-500 text-white text-lg px-4 py-2" onclick="startGame()">Start</button>
        </div>
    </div>


<div class="endPanel" id="endPanel">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-blue-600 rounded-lg border shadow dark:bg-blue-700 text-white flex flex-col items-center justify-center p-4 w-3/4 max-w-md h-32">
        <h2 id="endText">Your score is: <span id="score2"></span></h2>
    </div>
</div>

<div id="alertContainer" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-1/4 space-y-2">

</div>



<form method="GET" id="scoreForm" action="{{ route('score.store') }}">
    <input type="hidden" id="userid" value="{{$user->id}}" name="userid">
    <input type="hidden" value="{{$task->id}}" name="taskid">
    <input type="hidden" value="{{$user->section->id}}" name="sectionid">
    <input type="hidden" id="TotalScore" value="" name="score">
    <input type="hidden" id="MaxScore" value="" name="MaxScore">
    <input type="hidden" id="Percentage" value="" name="Percentage">
    <input type="hidden" id="TaskStatus" value="" name="TaskStatus">
    <input type="hidden" id="errors" value="" name="errors">
    <input type="hidden" id="timeTaken" value="" name="timeTaken">
    <input type="hidden" id="timeLeft" value="" name="timeLeft">
    {{csrf_field()}}
</form>

<script src="https://cdn.jsdelivr.net/npm/phaser@3.80.0/dist/phaser.js"></script>
<script type="text/javascript">

    var checkmarks = [];
    let counter = 0; // Initialize a counter for incrementing id
    let template = `{{$task->TaskCodeTemplate}}`;
    let language = "{{$task->lesson->LessonCategory}}";

    @foreach($instructions as $instruction)
        <?php
        // Split the answer into lines by newline character
        $lines = explode("\n", $instruction->answer);

        // Calculate points per line (assuming points are equally divided)
        $pointsPerLine = $instruction->points / count($lines);
        ?>

    @foreach ($lines as $line)
    checkmarks.push({
        id: counter,
        instruction: `{!! $instruction->instruction !!}`,
        answer: `{!! $line !!}`,
        points: {{ $pointsPerLine }}, // No need for number_format here
        done: false
    });
    counter++; // Increment counter after each checkmark object
    @endforeach
    @endforeach

    console.log(checkmarks)

    let maxMonsterHealth = (20 * checkmarks.length);
    let timerSeconds = {{$task->TaskMaxTime}};

</script>

<script src="/game.js"></script>
<script src="/index.js"></script>
<<<<<<< Updated upstream
<script src="/tutorial.js"></script>
    <script>
        const sectionId = "{{$user->section->id}}";
        const username = "{{Auth::user()->name}}";
    </script>
    <script src="agraNotification.js"></script>
=======


>>>>>>> Stashed changes

</body>
</html>
