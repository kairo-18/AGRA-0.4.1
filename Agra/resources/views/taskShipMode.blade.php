<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- External CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <script src="{{asset('js/app.js')}}"></script>
    <link rel="stylesheet" href="/tasks.css">
    <title>AGRA</title>

    <style>
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
</x-navbar>
<!--=====================================End Navbar=====================================-->

<!--=====================================Start outerDiv/MainDiv-=====================================-->
<div id="mainContent" class="outerDiv flex flex-wrap flex-col pb-5 pl-5 pr-5 bg-gradient-to-r from-blue-800 to-blue-600 min-h-auto ">
    <!--Inner div-->
    <div class="innerDiv xl:flex bg-gray-50 h-full w-full rounded-t-lg overflow-auto">
        <div class="top-panel flex flex-col  bg-white h-5/6 w-full p-3">
            <div class="stu-progress">
                <div class="info-bar">
                    <div class="score"> Score<span id="score">0</span> </div>
                    <div class="timer"> Timer<span id="timer">{{$task->TaskMaxTime}}</span> </div>

                    <div class="pb">
                        Progress
                        <div class="progress-bar">
                            <div class="progress-barc"></div>
                        </div>
                    </div>
                    <button type="button" class="btn" onclick="runClick();">RUN</button>
                </div>
            </div>

        </div>
    </div>
    <div class="innerDiv xl:flex bg-gray-50 h-full w-full rounded-lg overflow-auto">


        <div class="left-panel flex flex-col  bg-white h-3/6 xl:w-3/5 p-5">
            <div class="coding-area h-96 mb-4" id="coding-area">
                <div class="code-editor" id="code-editor"></div>
                <div class="code" id="code" style="display: none"></div>
            </div>

            <div class="instrucContainer overflow-scroll max-h-72">
                <div class="instructions" id="instructions">
                    <div class="instrucName">Instructions</div>
                </div>
            </div>

        </div>
        <div class="right-panel flex flex-col  bg-white h-full xl:w-2/5 p-5">
            <div class="mini-game" id="minigame"></div>
        </div>
    </div>


    <div id="tutorial-container" class="tutorial-container">

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
            <h1 id="startText" class="text-start text-xl text-blue-600 mb-2">Press start when you are ready.</h1>
            <h2 id="startText" class="text-center mb-2 text-blue-900">Little glad is lost around the forest and needs to escape, hoever, he is not safe as a ghostly monster roams around. Help little glad to get out of the forest by completing this activity. Keep in mind that you have to be quick, else, the monster might attack.</h2>
        </div>
        <div class="flex justify-end items-end h-full w-full">
            <button id="startButton" class="mt-4 mb-4 rounded-md border shadow-xl bg-green-500 text-white text-lg px-4 py-2">Start</button>
        </div>
    </div>
</div>

<div class="endPanel" id="endPanel">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-blue-600 rounded-lg border shadow dark:bg-blue-700 text-white flex flex-col items-center justify-center p-4 w-3/4 max-w-md h-32">
        <h2 id="endText">Your score is: <span id="score2"></span></h2>
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
        {{csrf_field()}}
    </form>




<script src="https://cdn.jsdelivr.net/npm/phaser@3.80.0/dist/phaser.js"></script>
<script type="text/javascript">

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<script src="/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="/index3.js"></script>
<script src="/shipGame.js"></script>
<script>
    const sectionId = "{{$user->section->id}}";
    const username = "{{Auth::user()->name}}";
</script>
<script src="agraNotification.js"></script>
</body>
</html>
