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

    <script src="{{asset('js/app.js')}}"></script>



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
    <h2 id="endText">You win: Your score is: <span id="score2"></span></h2>
</div>


<form method="GET" id="scoreForm" action="">
    <input type="hidden" id="username" value="{{$user->name}}" name="username">
</form>





<script src="https://cdn.jsdelivr.net/npm/phaser@3.80.0/dist/phaser.js"></script>
<script type="text/javascript">

    var checkmarks = [
        {
            id: 0,
            instruction: "Create an integer variable called num1 with the value of 10",
            answer: "int num1 = 10;",
            points: 10,
            done: false
        },
        {
            id: 1,
            instruction: "Create an integer variable called num2 with the value of 10",
            answer: "int num2 = 10;",
            points: 10,
            done: false
        },
        {
            id: 2,
            instruction: "Create a double variable called sum with the value of num1 added by num2",
            answer: "double sum = num1 + num2;",
            points: 10,
            done: false
        },
        {
            id: 3,
            instruction: "Compute the average and put it into a variable called average ( sum / 2 )",
            answer: "double average = sum / 2;",
            points: 10,
            done: false
        },
        {
            id: 4,
            instruction: "Display the average using system print line",
            answer: "System.out.println(average);",
            points: 10,
            done: false
        }
    ];

    let maxMonsterHealth = (20 * checkmarks.length);

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<script src="/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="/index1.js"></script>
<script src="/game.js"></script>
<script src="/tutorial.js"></script>
<script>
    var channel = Echo.channel('public');

    var enemy = prompt("Enter the username of your enemy");

    channel.listen('.chat', function(data) {
        if(data.username !== "{{$user->name}}"){
            if(data.username.toLowerCase() === enemy.toLowerCase()) {
                monsterTween.play();
                monster.play("punch", true);
                delay(400).then(() => player.play("dmg", true));
                if(data.message === "int grade = 90;"){
                    alert("You Lose");
                }
            }
        }
    });

</script>


</body>
</html>
