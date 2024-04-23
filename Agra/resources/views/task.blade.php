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
    <link rel="stylesheet" href="/tasks.css">
    <link rel="stylesheet" href="/tasks2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <title>AGRA</title>
</head>
<body>
<div class="wrapper">

    <!-- Sidebar -->
    <aside id="sidebar">
        <div class="space p-3"></div>

        <!-- Sidebar Header -->
        <div class="d-flex">

            <!-- Toggle Button -->
            <button class="toggle-btn mx-4" type="button">
                <img src="/image-removebg-preview (23) 1.png">
            </button>
            <!-- Sidebar Logo -->
            <div class="sidebar-logo">
                <a href="#">CodzSword</a>
            </div>
        </div>

        <!-- Sidebar Navigation -->
        <ul class="sidebar-nav">

            <!-- Profile -->
            <li class="sidebar-item">
                <a href="/" class="sidebar-link">
                    <i class="bi bi-house"> </i> Home
                    <span>Home</span>
                </a>
            </li>

            <!-- Task -->
            <li class="sidebar-item">
                <a href="/agra" class="sidebar-link">
                    <i class="bi bi-triangle"> </i>AGRA
                    <span>AGRA</span>
                </a>
            </li>

            <!-- Notification -->
            <li class="sidebar-item">
                <a href="/courses" class="sidebar-link">
                    <i class="bi bi-book">  </i> Course
                    <span>Course</span>
                </a>
            </li>

            <!-- Setting -->
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-question-circle"> </i> Help
                    <span>Setting</span>
                </a>
            </li>
        </ul>

        <div class="line"></div>

        <!-- Setting -->
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="lni lni-cog"> </i> Setting
                <span>Setting</span>
            </a>
        </li>
        </ul>

        <!-- Sidebar Footer -->
        <div class="sidebar-footer">
            <form method="POST" id="logout" action="{{ route('logout') }}">
                <a href="javascript:document.getElementById('logout').submit();" class="sidebar-link">
                    <i class="lni lni-exit"> </i> Logout
                    <span>Logout</span>
                </a>
                {{ csrf_field() }}
            </form>
        </div>

        <div class="space p-4"></div>
    </aside>


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

                    <div class="coding-area" id="coding-area">
                        <div class="code-editor" id="code-editor"></div>
                        <div class="code" id="code" style="display: none"></div>
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

    var checkmarks = [];
    let counter = 0; // Initialize a counter for incrementing id

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
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<script src="/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="/index.js"></script>
<script src="/game.js"></script>
<script src="/tutorial.js"></script>


</body>
</html>
