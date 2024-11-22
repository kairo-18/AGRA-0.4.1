<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/tasks.css">
    <link rel="stylesheet" href="/tasks3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <script src="{{asset('js/app.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('css/introjs.min.css') }}">
    <title>AGRA</title>

    <style>
        .coding-area{
            height: 60%;
        }

        .background-wrapper {
            top: 0;
            left: 0;
            z-index: 0; /* Layer behind the content */
            width: 100%; /* Adjust to fit the container size */
            height: 100vh; /* Set height, e.g., full viewport height */
            overflow: hidden; /* Hides any overflow if the image doesn’t fit exactly */
            position: relative;
        }

        .bg-slide {
            position: absolute;
            width: 200%; /* Two images, each 100%, so total width is 200% */
            height: 100%;
            display: flex;
            animation: slide 60s infinite; /* Slower animation speed */
            top: 0;
            left: 0;
        }

        .bg-slide img {
            width: 50%; /* Each image takes up 50% of the container */
            height: 100%;
            object-fit: cover; /* Cover the area without distortion */
        }

        /* Keyframes for sliding effect */
        @keyframes slide {
            0% { transform: translateX(0); } /* Start from the first image */
            50% { transform: translateX(-50%); } /* Slide to the second image */
            100% { transform: translateX(0); } /* Loop back to the first image */
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
<div class="outerDiv flex flex-wrap flex-col pb-5 pl-5 pr-5 bg-gradient-to-r from-blue-800 to-blue-600 min-h-auto">
    <div class="innerDiv lg:flex bg-gray-50 h-full w-full rounded-t-lg overflow-auto">

        <div class="leftDiv flex flex-col bg-gray-500 h-screen w-full p-5 gap-10">

            <!--Information: Score, time, prog-bar-->
            <div class="stu-progress">
                <div class="info-bar">
                    <div class="score" data-title="Score" data-intro="This is your current score on this task. Each correct answer will grant you corresponding points."> Score<span id="score">0</span> </div>
                    <div class="timer" data-title="Timer" data-intro="Track the time! You can check the allotted time for each item here. When you run out of time, certain game consequences will happen."> Timer<span id="timer">{{$task->TaskMaxTime}}</span> </div>

                    <div class="pb" data-title="Progress Bar" data-intro="You can track your progress here. Every correct answer will make the progress bar advance.">
                        <div class="progress-bar bg-gray-200 rounded-full dark:bg-gray-700 h-10 w-40 md:w-40 xl:w-80 mt-1.5">
                            <div class="progress-barc bg-blue-900 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full h-10 w-0"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Compiler-->
            <div class="instrucContainer" data-title="Instructions" data-intro="You can see the specific instructions you need to accomplish here. Practice clean coding. Don't forget spaces such as int number [space]=[space]25;">
                <div class="instrucName text-2xl"></div>
                <div class="instructions bg-blue-800" id="instructions"></div>
            </div>

            <div class="coding-area" id="coding-area" style="height: 30%">
                <div class="userInput" id="userInput" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; gap: 10px;" data-title="Answer Tab" data-intro="This is the panel where you type your answer.">
                    <input type="text" name="userAnswer" placeholder="Type your answer here" id="userAnswer"
                           style="width: 50%; height: 50%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; font-size: 1rem;">
                    <button id="submit" onclick="submitAnswer();"
                            style="width: 30%; height: 50%; padding: 10px; border-radius: 8px; background-color: #4CAF50; color: white; font-size: 1rem; border: none; cursor: pointer;" data-title="Submit Button" data-intro="Click this to submit and verify your answer. When the progress bar advances, your answer is correct, otherwise, the screen would shake to indicate an incorrect answer.">
                        Submit Answer
                    </button>
                </div>
            </div>

            <div class="coding-area" id="coding-area" data-title="Agra Code Editor" data-intro="This is the platform where you will execute your coding skills. Practice clean coding, observe putting proper spaces, capitalization, and punctuations.">
                <div class="code-editor" id="code-editor"></div>
                <div class="code" id="code" style="display: none"></div>
            </div>

        </div>

        <div class="RightDiv flex flex-col bg-gray-900 rounded-r-lg h-screen xl:w-3/5 w-full p-5 gap-8" >
            <div class="mini-game" id="minigame" data-title="Beginner Game Panel" data-intro="In this beginner challenge, a correct answer will trigger your character to advance, on the other hand, when you run out of time for a certain instruction, it will trigger the monster's attack. Running out of health will end the game"></div>
        </div>

    </div>
</div>




<div id="startPanel" class="w-full h-full fixed inset-0 backdrop-blur-md">
    <div class="background-wrapper">
        <div class="bg-slide">
            <img src="/bg-FITTB1.png" alt="Background 1">
            <img src="/bg-FITTB2.png" alt="Background 2">
        </div>
    </div>
    <div class="startPaneldiv2 absolute bottom-0 right-0 transform -translate-x-0 -translate-y-0 flex flex-col items-center justify-center p-4 w-3/4 max-w-md h-max m-5">
        <div class="flex flex-col justify-center items-center bg-gray-300 h-full w-full rounded-lg border shadow p-5">
            <h1 id="startText" class="text-start text-xl text-blue-600 mb-2"> <strong>Press start when you are ready.</strong> </h1>
            <h2 id="startText" class="text-center mb-2 text-blue-900">Marga, our little red hero is lost in the forest and needs to escape, however, he is not safe as a ghostly monster roams around. Help Marga get out of the forest by completing this activity. Keep in mind that you have to be quick, else, the monster might attack.</h2>
        </div>
        <div class="flex justify-end items-end h-full w-full">
            <button id="startButton" class="mt-4 mb-4 rounded-md border shadow-xl bg-green-500 text-white text-lg px-4 py-2">Start</button>
        </div>
    </div>
</div>

<!-- <div id="endPanel" class="hidden fixed inset-0 bg-gray-900 bg-opacity-90 text-white p-8 rounded-lg flex justify-between items-center transform">
    <div class="left-section w-3/4 h-full flex justify-center items-center text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-700 p-8 rounded-l-lg shadow-md">
        <span id="resultMessage">You Win / You Lose</span>
    </div>
    <div class="right-section w-1/4 h-full flex flex-col justify-evenly items-center text-lg p-6 bg-gray-800 rounded-r-lg shadow-md">
        <div class="text-center my-auto">
            <p>Time Taken: <span id="timeTaken2"></span></p>
            <p>Score: <span id="globalScore"></span>%</p>
            <p>Errors: <span id="globalUserError"></span></p>
        </div>
        <div class="text-center my-auto">
            <button onclick="tryAgain()" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md mb-4">Try Again</button>
            <button onclick="reset()" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md">Back to Task</button>
        </div>
    </div>
</div> -->

<div id="endPanel" class="hidden fixed inset-0 bg-gray-900 bg-opacity-90 text-white rounded-lg flex justify-between items-center transform">
    <div class="background-wrapper">
        <div class="h-full flex justify-center items-center text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-700 rounded-l-lg shadow-md">
                <span id="resultMessage" class="bg-cover bg-center" ></span>
        </div>
    </div>
    <div class ="pr-0">
        <div class="flex flex-col bg-white h-1/2 w-[40rem] justify-center absolute right-0 inset-y-0 my-auto mr-10 rounded-lg shadow-lg">
            <h2 id="endMessage" class="text-center text-2xl font-bold text-white bg-blue-800 mb-4"></h2>
            <div class="text-center text-sm text-blue-800 mb-4 ">
                <p><strong>Course: {{$task->lesson->course->CourseName}}</strong></p>
                <p>Lesson: {{$task->lesson->LessonName}}</p>
                <p>Task: {{$task->TaskName}}</p>
            </div>
            <div class="text-center text-base text-blue-800 my-4">
                <p><strong>Time Elapsed</strong><br><span id="timeTaken2"></span></p>
                <p><strong>Score</strong><br><span id="globalScore">%</span></p>
                <p><strong>Errors</strong><br><span id="globalUserError"></span></p>
            </div>
            <div class="flex justify-center gap-4 mt-4 px-5">
                <span id="playAgain" class="bg-blue-800 text-white py-2 px-4 rounded-lg text-sm hover:bg-blue-900">Please wait while we record your score!</span>
            </div>
        </div>
    </div>
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

    let counter = 0; // Initialize a counter for incrementing id
    let template = `{!!$template!!}`;

    var checkmarks = [
            @foreach($instructions as $instruction)
        {
            id: {{$loop->index}},
            instruction: "{{$instruction->instruction}}",
            answer: "{{$instruction->answer}}",
            points: {{$instruction->points}},
            done: false
        },
        @endforeach
    ];



    let maxMonsterHealth = (20 * checkmarks.length);
    let timerSeconds = {{$task->TaskMaxTime}};
</script>
<script src="{{ asset('js/intro.min.js') }}"></script>
<script src="/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="/FITBgame.js"></script>
<script src="/FITB.js"></script>
<script>
    const sectionId = "{{$user->section->id}}";
    const username = "{{Auth::user()->name}}";
</script>

</body>
</html>
