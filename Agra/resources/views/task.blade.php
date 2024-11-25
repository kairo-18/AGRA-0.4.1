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
    <link rel="stylesheet" href="{{ asset('css/introjs.min.css') }}">
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

        .background-wrapper {
            top: 0;
            left: 0;
            z-index: 0; /* Layer behind the content */
            width: 100%; /* Adjust to fit the container size */
            height: 100vh; /* Full viewport height */
            overflow: hidden; /* Hide overflow if the image doesn’t fit exactly */
            position: relative;
            background-size: cover; /* Ensure the background image covers the entire container */
            background-position: center; /* Center the background image */
            background-repeat: no-repeat; /* Prevent image repetition */
        }

        .bg-slide {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            display: flex;
        }

        /* Make the images fade in and out in sequence */
        .bg-slide img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%; /* Ensure images cover the entire container */
            height: 100%;
            object-fit: contain; /* Ensures the image covers the screen without distortion */
            opacity: 0; /* Initially set to invisible for all images */
            animation: fadeInOut 12s infinite; /* Apply fadeInOut animation with 12s cycle */
        }

        /* Delay the animation for each image to create a sequential fade-in and fade-out effect */
        .bg-slide img:nth-child(1) {
            animation-delay: 0s; /* First image appears immediately */
        }

        .bg-slide img:nth-child(2) {
            animation-delay: 4s; /* Second image fades in after 4 seconds */
        }

        .bg-slide img:nth-child(3) {
            animation-delay: 8s; /* Third image fades in after 8 seconds */
        }

        /* Keyframes for the fade-in and fade-out effect */
        @keyframes fadeInOut {
            0%, 100% {
                opacity: 0; /* Start and end with image invisible */
            }
            25%, 75% {
                opacity: 1; /* Fade in and remain visible */
            }
        }

        .vignette-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: radial-gradient(circle, transparent 30%, rgba(0, 0, 0, 0.7) 70%);
            pointer-events: none; /* allows interaction with elements under the overlay */
            z-index: 1000; /* make sure it’s on top */
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

        <div class = "leftDiv flex flex-col  bg-gray-300 h-screen w-full p-5 gap-10">
            <div class="stu-progress">
            <!--Information: Score, time, prog-bar-->
                <div class="info-bar">
                    <div class="score" data-title="Score" data-intro="This is your current score on this task. Each correct answer will grant you corresponding points.">Score <span id="score">0</span></div>
                    <div class="timer" data-title="Timer" data-intro="Track the time! You can check the allotted time here. When you run out of time, the game will end.">Timer <span id="timer">{{$task->TaskMaxTime}}</span></div>
                    <div class="pb" data-title="Progress Bar" data-intro="You can track your progress here. Every correct answer will make the progress bar advance.">
                        <div class="progress-bar bg-gray-300 rounded-full dark:bg-gray-700 h-10 w-40 md:w-40 xl:w-80 mt-1.5">
                            <div class="progress-barc bg-blue-900 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full h-10 w-0"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Compiler -->
            <div class="coding-area relative h-full w-full">
                <!-- Ace Editor Div -->
                <div id="code-editor" class="w-full h-full border border-gray-300 text-lg" data-title="Agra Code Editor" data-intro="This is the platform where you will execute your coding skills. Practice clean coding, observe putting proper spaces, capitalization, and punctuations."></div>
            </div>
            <!--idk-->
            <div id="code" style="display: none;"></div>
        </div>
        <div class = "RightDiv flex flex-col bg-gray-300 rounded-r-lg h-screen xl:w-3/5 w-full p-5 gap-8">
            <div class="mini-game" id="minigame" data-title="Intermediate Game Panel" data-intro="This is the game panel. In this scenario, Marga is in the intermediate challenge where a correct answer will trigger her attack, otherwise, running out of time or typing an incorrect answer will cause the hostiles to retaliate. The count of monsters you will encounter will depend upon the number of instructions you need to accomplish. Watch out for your healthbar, running out of health will result into losing."></div>
        </div>
</div>

    <div id="startPanel" class="w-full h-full fixed inset-0 bg-white overflow-hidden">
        <div class="background-wrapper">
            <div class="bg-slide">
                <img src="/bg-Intermediate4.png" alt="Background 1">
                <img src="/bg-Intermediate5.png" alt="Background 2">
                <img src="/bg-Intermediate6.png" alt="Background 3">
            </div>
        </div>
        <div class="startPaneldiv2 absolute left-0 top-0 transform -translate-x-0 -translate-y-0 flex flex-col items-center justify-center p-4 w-3/4 max-w-md h-max m-5">
            <div class="flex flex-col justify-center items-center opacity-40 bg-gray-300 h-full w-full rounded-lg border shadow p-5">
                <h1 id="startText" class="text-start text-xl text-blue-600 mb-2"><strong>Press start when you are ready.</strong> </h1>
                <h2 id="startText" class="text-center mb-2 text-blue-900">The best defense is offense. Marga stumbles upon a dungeon and the way back is blocked. Navigate the dungeon by completing this activity and help Marga defeat the hostile mercenaries on her way out. Getting a correct answer will trigger Marga's attack. On the other hand, running out of time will give the hostiles their turn to charge towards Marga. Good luck!.</h2>
            </div>
            
        </div>

        <!-- Overall Objective Section -->
        <div id="overallObjective" class="absolute inset-x-0 bottom-0 flex opacity-70 items-center justify-center pointer-events-none">
            <div class="bg-white rounded-lg shadow-lg border p-6 max-w-2xl w-11/12 text-center pointer-events-auto">
                <h1 class="text-xl font-bold text-blue-700 mb-4">Overall Objective</h1>
                @if ($instructions->isNotEmpty())
                    <ol class="list-inside text-md flex flex-col justify-start items-center text-gray-800 w-3/4 mx-auto">
                        @foreach ($instructions as $index => $instruction)
                            @if (!empty($instruction->objective))
                                <li class="list-disc">{{  $instruction->objective }}</li>
                            @endif
                        @endforeach
                    </ol>
                @else
                    <p class="text-lg text-gray-800">
                        <strong>Learn: </strong>No objectives generated yet.
                    </p>
                @endif
                <div class="flex justify-center items-end h-full w-full">
                    <button id="startButton" class="mt-4 mb-4 opacity-100 rounded-md border shadow-xl bg-green-500 text-white text-lg px-4 py-2 w-full">Start</button>
                </div>
            </div>
        </div>

    </div>

    <div id="hit-overlay" class="hit-overlay"></div>

<div id="endPanel" class="hidden fixed inset-0 bg-gray-900 bg-opacity-90 text-white rounded-lg flex justify-between items-center transform">
    <div class="background-wrapper">
        <div class="h-full flex justify-center items-center text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-700 rounded-l-lg shadow-md">
                <span id="resultMessage" class="bg-cover bg-center" ></span>
        </div>
    </div>
    <div class ="pr-0">
        <div class="flex flex-col bg-white h-[50vh] w-[40rem] justify-center absolute right-0 inset-y-0 my-auto mr-10 rounded-lg shadow-lg">
            <h2 id="endMessage" class="text-center text-2xl font-bold text-white bg-blue-800 mb-4"></h2>
            <div class="text-center text-sm text-blue-800 mb-4 ">
                <p><strong>Course: {{$task->lesson->course->CourseName}}</strong></p>
                <p>Lesson: {{$task->lesson->LessonName}}</p>
                <p>Task: {{$task->TaskName}}</p>
            </div>
            <div class="text-center text-baseflex justify-center gap-10 text-xs text-blue-800 my-4">
                <p class="flex justify-center flex-col items-center"><strong>Time Elapsed</strong><br><span id="timeTaken2"></span></p>
                <p class="flex justify-center flex-col items-center"><strong>Score</strong><br><span id="globalScore">%</span></p>
                <p class="flex justify-center flex-col items-center"><strong>Errors</strong><br><span id="globalUserError"></span></p>
                
            </div>
            <div class="obj flex justify-center">
                <ul id="objectivesList" class="text-blue-800 bg-gray-300 rounded-lg text-sm p-5 my-2 gap-3">
                    <!-- Objectives will be populated here -->
                </ul>
            </div>
            <div class="flex justify-center gap-4 mt-4 px-5">
                <button id="playAgain" class="bg-blue-800 text-white py-2 px-4 rounded-lg text-sm hover:bg-blue-900" onclick="window.history.back();">Go back</button>
            </div>
        </div>
    </div>

</div>


    <div id="alertContainer" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-1/4 space-y-2">

</div>

    <div id="instructionDiv">
        <p id="instructionText"></p>
        <p class="mb-5">Note: Do the instruction in a single line of code only.</p>
        <button id="checkButton" data-title="Check your code!" data-intro="Click this button to validate your answer. Be careful as a wrong answer will result in the monster attacking you and your error count increasing.">Check Answer</button>
    </div>
    <div id="instructions-container"></div>

    <form method="GET" id="scoreForm" action="{{ route('score.store') }}">
        <input type="hidden" id="userid" value="{{$user->id}}" name="userid">
        <input type="hidden" id="taskid" value="{{$task->id}}" name="taskid">
        <input type="hidden" id="sectionid" value="{{$user->section->id}}" name="sectionid">
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
    let template = `{!! $task->TaskCodeTemplate !!}`;
    let language = "{{$task->lesson->LessonCategory}}";

    @foreach($instructions as $instruction)
        <?php
        // Split the answer by comma to get multiple answers
        $answerVariants = explode("\n", $instruction->answer);

        // Calculate points per instruction (assuming points are equally divided)
        $pointsPerLine = $instruction->points;
        ?>

    checkmarks.push({
        id: counter,
        instruction: {!! json_encode($instruction->instruction) !!}, // JSON-encoded instruction
        answers: {!! json_encode($answerVariants) !!}, // JSON-encoded array of answers
        points: {{ $pointsPerLine }},
        objective: "{{$instruction->objective}}",
        done: false
    });
    counter++; // Increment counter after each checkmark object
    @endforeach


    console.log(checkmarks)

    let maxMonsterHealth = (20 * checkmarks.length);
    let timerSeconds = {{$task->TaskMaxTime}};

</script>

    <script src="{{ asset('js/intro.min.js') }}"></script>
<script src="/game.js"></script>
<script src="/index.js"></script>
    <script>
        const sectionId = "{{$user->section->id}}";
        const username = "{{Auth::user()->name}}";

    </script>

</body>
</html>
