<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/tasks.css">
    <title>AGRA</title>
</head>
<body>
<header>
    <h2><img src="/ImgLogo.png" alt="logo"></h2>
    <nav>
        <ul class="nav_links">
            <li><a href="#">Home</a></li>
            <li><a href="#">Account</a></li>
            <li><a href="#">Courses</a></li>
            <li><a href="#">Exercises</a></li>
            <li><a href="#" class="notif">Tutorials</a></li>
        </ul>
    </nav>
</header>

<div class="container">


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
    </div>

    <div class="in-container2">

        <div class="instructions" id="instructions">
            <div class="instrucName">Instructions</div>
        </div>

        <div class="mini-game" id="minigame"></div>


    </div>

</div>


</div>

<div id="tutorial-container" class="tutorial-container">

</div>

<div class="startPanel" id="startPanel">
    <h2 id="startText">Press start when you are ready. (Press the tutorial in the top right corner for a walkthrough)</h2>
    <button id="startButton" onclick="startGame()">Start</button>
</div>

<div class="endPanel" id="endPanel">
    <h2 id="endText">Your score is: <span id="score2"></span></h2>
    <button id="resetButton" onclick="reset()">Reset</button>
</div>



<script src="https://cdn.jsdelivr.net/npm/phaser@3.80.0/dist/phaser.js"></script>
<script type="text/javascript">
    var checkmarks = [
            @foreach($instructions as $instruction)
        {
            id: {{$loop->index}},
            instruction: "{{$instruction->content}}",
            answer: "{{$instruction->answer}}",
            done: false
        },
        @endforeach
    ];
</script>
<script src="/game.js"></script>
<script src="/tutorial.js"></script>
<script src="/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="/index.js"></script>



</body>
</html>
