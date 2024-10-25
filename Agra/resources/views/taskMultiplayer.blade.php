<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGRA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('tasks.css') }}">
    <link rel="stylesheet" href="{{ asset('tasks2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{asset('js/app.js')}}"></script>

    <!-- Inline CSS -->
    <style>
        .coding-area {
            height: 60%;
        }
        .main-container.blurred {
            filter: blur(5px);
        }
    </style>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/phaser@3.80.0/dist/phaser.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous" defer></script>
    <script src="{{ asset('ace-builds/src-noconflict/ace.js') }}" charset="utf-8" defer></script>
    <script src="{{ asset('game1.js') }}" defer></script>
    <script src="{{ asset('index1.js') }}" defer></script>
</head>
<body>
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

<div class="outerDiv flex flex-wrap flex-col pb-5 pl-5 pr-5 bg-gradient-to-r from-blue-800 to-blue-600 min-h-auto ">
    <div class="innerDiv lg:flex bg-gray-50 h-full w-full rounded-t-lg overflow-auto">

        <div class = "leftDiv flex flex-col  bg-gray-400 h-screen w-full p-5 gap-10">

                        <!--Information: Score, time, prog-bar-->
                        <div class="stu-progress">
                            <div class="w-full h-[75px] bg-blue-600 text-white rounded-[20px] flex justify-between pt-[6px]">
                                <div class="score">Score <span id="score">0</span></div>
                                <div class="timer">Timer <span id="timer">10</span></div>
                                <div class="pb">
                                    <div class="progress-bar bg-gray-200 rounded-full dark:bg-gray-700 h-10 w-40 md:w-40 xl:w-80">
                                        <div class="progress-barc bg-blue-900 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full h-10 w-0"></div>
                                    </div>
                                </div>
                                <div class="butan p-3">
                                    <button type="button" onclick="runClick();" class="text-white hover:text-white border border-white hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm pt-2 pl-5 pr-5 pb-2 text-center dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">RUN</button>
                                </div>
                            </div>
                        </div>
                        <!--Instruction-->
                        <div class="instrucContainer">
                            <div class="instrucName text-2xl"></div>
                            <div class="instructions bg-blue-800" id="instructions"></div>
                        </div>

                         <!--Compiler-->
                         <div class="coding-area">
                            <div class="code-editor" id="code-editor"></div>
                        </div>
                    </div>
                    <div class = "RightDiv flex flex-col bg-gray-400 rounded-r-lg h-screen xl:w-3/5 w-full p-5 gap-8">
                        <div class="mini-game" id="minigame"></div>
                    </div>

        </div>
    </div>

    <div id="startPanel" class="w-full h-full fixed inset-0 backdrop-blur-md">
        <div class="startPaneldiv2 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-blue-800 rounded-lg border shadow dark:bg-blue-700 text-white flex flex-col items-center justify-center p-4 w-3/4 max-w-md h-32">
            <h2 id="startText" class="text-center mb-2">Press start when you are ready.</h2>
            <button id="startButton" class="mt-4 mb-4 rounded-md border border-white bg-green-500 text-white text-lg px-4 py-2" onclick="startGame()">Start</button>
        </div>
    </div>

    <div class = "endPanel w-full h-full fixed inset-0 backdrop-blur-md" id="endPanel">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-blue-600 rounded-lg border shadow dark:bg-blue-700 text-white flex flex-col items-center justify-center p-4 w-3/4 max-w-md h-32 hidden">
            <h2 id="endText">Your score is: <span id="score2"></span></h2>
        </div>
    </div>

    <form method="GET" id="scoreForm" action="">
        <input type="hidden" id="username" value="{{ $user->name }}" name="username">
    </form>

    <script>

        var checkmarks = [
            { id: 0, instruction: "Create an integer variable called num1 with the value of 10", answer: "int num1 = 10;", points: 10, done: false },
            { id: 1, instruction: "Create an integer variable called num2 with the value of 10", answer: "int num2 = 10;", points: 10, done: false },
            { id: 2, instruction: "Create a double variable called sum with the value of num1 added by num2", answer: "double sum = num1 + num2;", points: 10, done: false },
            { id: 3, instruction: "Compute the average and put it into a variable called average ( sum / 2 )", answer: "double average = sum / 2;", points: 10, done: false },
            { id: 4, instruction: "Display the average using system print line", answer: "System.out.println(average);", points: 10, done: false }
        ];

        let maxMonsterHealth = (20 * checkmarks.length);

        var channel = Echo.channel('public');

        var enemy = prompt("Enter the username of your enemy");

        channel.listen('.chat', function(data) {
            if(data.username !== "{{$user->name}}"){
                if(data.username.toLowerCase() === enemy.toLowerCase()) {
                    monsterMove(scene);
                    delay(400).then(() => player.play("dmg", true));
                    if(data.message === "int grade = 90;"){
                        alert("You Lose");
                    }
                }
            }
        });


        function startGame() {
            $("#startPanel").hide();
            $(".main-container").removeClass("blurred");
        }

        function showResetPanel() {
            $("#endPanel").show();
            $("#score2").text(globalScore + "%");
            $(".main-container").addClass("blurred");
            setTimeout(submitScore, 2000);
        }
    </script>
<script>
    const sectionId = "{{$user->section->id}}";
    const username = "{{Auth::user()->name}}";
</script>
<script src="agraNotification.js"></script>
</body>
</html>
