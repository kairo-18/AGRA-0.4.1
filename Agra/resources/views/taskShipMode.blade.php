<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- External CSS -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <script src="{{asset('js/app.js')}}"></script>
    <link rel="stylesheet" href="/tasks.css">
    <link rel="stylesheet" href="/tasks2.css">
    <style>
        .coding-area{
            height: 60%;
        }
    </style>

    <title>AGRA</title>
</head>
<body>
<x-navbar></x-navbar>
<div class="wrapper">


    <div class="main">
        <div class="second-main">

            <div class="container1">


                <div class="in-container1">
                    <div class="stu-progress">
                        <div class="info-bar">
                            <div class="score"> Score<span id="score">0</span> </div>
                            <div class="timer"> Timer<span id="timer">10</span> </div>

                            <div class="pb">
                                Progress
                                <div class="progress-bar">
                                    <div class="progress-barc"></div>
                                </div>
                            </div>
                            <button type="button" class="btn" onclick="runClick();">RUN</button>
                        </div>
                    </div>

                    <div class="coding-area" >
                        <div class="code-editor" id="code-editor"></div>
                    </div>

                    <div class="instrucContainer">
                        <div class="instructions" id="instructions">
                            <div class="instrucName">Instructions</div>
                        </div>
                    </div>
                </div>

                <div class="in-container2">



                    <div class="mini-game" id="minigame"></div>


                </div>

            </div>


        </div>

        <div id="tutorial-container" class="tutorial-container">

        </div>



    </div>
    </div>


</div>

<div class="startPanel" id="startPanel">
    <h2 id="startText">Press start when you are ready. (Press the tutorial in the top right corner for a walkthrough)</h2>
    <button id="startButton" onclick="startGame()">Start</button>
</div>

<div class="endPanel" id="endPanel">
    <h2 id="endText">Your score is: <span id="score2"></span></h2>
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
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<script src="/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="/index3.js"></script>
<script src="/shipGame.js"></script>


</body>
</html>
