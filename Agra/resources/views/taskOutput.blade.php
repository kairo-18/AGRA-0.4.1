<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <script src="{{asset('js/app.js')}}"></script>
    <link rel="stylesheet" href="/tasks.css">
    <link rel="stylesheet" href="/tasks2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/introjs.min.css') }}">
<style>
    .timer-border{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 5px solid red; /* Timer border */
        box-sizing: border-box; /* Ensure padding is included in width/height */
        clip-path: inset(0 100% 0 0); /* Start with the border clipped to the left */
        box-shadow: 0 0 10px red, 0 0 20px red, 0 0 30px red; /* Glowing effect */
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
            animation: slide 15s infinite; /* Slower animation speed */
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
    <title>AGRA</title>
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

<!--=====================================Start outerDiv/MainDiv-=====================================-->
<div class="outerDiv flex flex-wrap flex-col pb-5 pl-5 pr-5 bg-gradient-to-r from-blue-800 to-blue-600 min-h-auto ">
    <!--Inner div-->


    <div class="innerDiv xl:flex bg-gray-50 h-full w-full rounded-t-lg overflow-auto">
        <div class="top-panel flex flex-col  bg-white h-5/6 w-full p-3">
            <div class="stu-progress">
                <div class="info-bar">
                    <div class="score" data-title="Score" data-intro="This is your score for this task."> Score<span id="score">0</span> </div>
                    <div class="timer" data-title="Timer" data-intro="Track the time! You can check the allotted time for the task here."> Timer<span id="timer">10</span> </div>

                    <div class="pb" data-title="Progress Bar" data-intro="You can track your progress here. Every correct answer will make the progress bar advance.">
                        Progress
                        <div class="progress-bar">
                            <div class="progress-barc"></div>
                        </div>
                    </div>
                    <button type="button" class="p-5 bg-green-500 rounded" id="runButton" data-title="Run Button" data-intro="Click this to execute the code.">Run</button>


                    <!-- Modal toggle -->
                    <button id="instructionsButton" data-modal-target="default-modal1" data-modal-toggle="default-modal1" class="p-5 bg-green-500 rounded mr-5" type="button" data-title="Instructions" data-intro="Click this to show instructions.">
                        Instructions
                    </button>

                    <!-- Main modal -->
                    <div id="default-modal1" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Instructions
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal1">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 md:p-5 space-y-4">
                                    <div class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                        {!! $task->TaskInstruction!!}
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button data-modal-hide="default-modal1" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Go back</button>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>
    <div class="innerDiv xl:flex bg-gray-50 h-full w-full rounded-lg overflow-auto">


        <div class="left-panel flex flex-col  bg-white h-3/6 xl:w-3/5 p-5">
            <div class="coding-area h-96 mb-4" id="coding-area" data-title="Agra Code Editor" data-intro="This is the platform where you will execute your coding skills. Practice clean coding, observe putting proper spaces, capitalization, and punctuations.">
                <div class="code-editor" id="code-editor"></div>
                <div class="code" id="code" style="display: none"></div>
            </div>

            <div class="instrucContainer overflow-scroll max-h-72">
                    <div class="output h-[270px] " id="output" data-title="Output Panel" data-intro="You can see your code's output here, plus test case verifications!">

                    </div>
            </div>

        </div>

        <div class="right-panel flex flex-col  bg-white h-5/6 xl:w-2/5 p-5" data-title="Advanced Game Panel" data-intro="Getting all the test cases right will cause the dark mage to vanish right away! Amazing, right? However, everytime you run out of time, the mage will attack one civilian and you will lose health points, losing all civilians and running out of health points will cause the game to end. But, we are here to help and we know that it is not that easy! Every time the clock runs out, you will be given an option to get a hint, if you need help, click yes and a mini game will be initialized, in the minigame, a moving crosshair will spawn, click the red button in the middle to fire, hit the mage and a hint will pop up! Otherwise, if you feel confident enough, simply decline the offer.">
            <div class="mini-game" id="minigame">
            </div>

        </div>


    </div>


    <div id="tutorial-container" class="tutorial-container">

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


<div id="endPanel" class="hidden fixed inset-0 bg-gray-900 bg-opacity-90 text-white rounded-lg flex justify-between items-center transform">
    <div class="background-wrapper">
        <div class="h-full flex justify-center items-center text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-700 rounded-l-lg shadow-md">
                <span id="resultMessage" class="bg-cover bg-center" ></span>
        </div>
    </div>
    <div class ="pr-8">
        <div class="flex flex-col bg-white h-1/2 w-[40rem] justify-center absolute right-0 inset-y-0 my-auto mr-8 rounded-lg shadow-lg">
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
            <div class="flex gap-4 mt-4 px-5">
                <button onclick="tryAgain()" id="playAgain" class="bg-blue-800 text-white py-2 px-4 rounded-lg text-sm hover:bg-blue-900">Play Again</button>
                <button onclick="reset()" id="backToTasks" class="bg-blue-800 text-white py-2 px-4 rounded-lg text-sm hover:bg-blue-900">Back to tasks</button>
            </div>
        </div>
    </div>
</div>


<!-- Main modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full md:inset-0 h-[calc(100%-1rem)] max-h-full inset-0 backdrop-blur-md">
    <div class="background-wrapper">
        <div class="bg-slide">
            <img src="/bg-output7.png" alt="Background 1">
            <img src="/bg-output8.png" alt="Background 2">
        </div>
    </div>


    <div class="startPaneldiv2 absolute bottom-0 right-0 transform -translate-x-0 -translate-y-0 flex flex-col items-center justify-center p-4 w-3/4 max-w-md h-max m-5">
        <div class="flex flex-col justify-center items-center bg-gray-300 h-full w-full rounded-lg border shadow p-5">
            <h1 id="startText" class="text-start text-xl text-blue-600 mb-2"><strong> Press start when you are ready.</strong></h1>
            <h2 id="startText" class="text-center mb-2 text-blue-900">After getting out of the dungeon and successfully defeating enemies. Marga encountered a dark mage which seems to be the origin of the dark energy all along. Subsequently, she saw an abandoned battle ship and maneuvered it. Use this ship to defeat the mage. For glory.</h2>
        </div>
        <!-- Modal footer -->
        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
            <button id="startButton" data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Start</button>
            </div>
        </div>
    </div>
</div>

<div id="alertContainer" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-1/4 space-y-2">

</div>


<div id="resetPanel" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Initial Instructions
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="resetPanel">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    {{$task->Description}}
                </p>
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    Score: <span id="score2"></span>
                </p>
            </div>
            <!-- Modal footer -->
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/phaser@3.80.0/dist/phaser.js"></script>

<script src="{{ asset('js/intro.min.js') }}"></script>
<script type="text/javascript">
    let testcasesTemp = @json($testcases);
    let maxMonsterHealth = 20 * testcasesTemp.length;
    window.timerSeconds = {{$task->TaskMaxTime}};
</script>

<script src="/shipGame.js"></script>

<script src="/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
    let globalScore = 0;
    let totalScore = 0;
    let maxScore = testcasesTemp.length;
    let globalUserError = 0;
    let maxTime = testcasesTemp.length * timerSeconds; // Total maximum time allowed
    let startTime; // Time when the user starts the task
    let endTime; // Time when the user completes the task
    let instruction = `{!!  $task->TaskInstruction!!}`;
    let language = '{{$task->lesson->course->category}}';
    let timer1, timer2, timer, isPaused = false, remainingTime, roundRemainingTime;
    let timeRemaining = 7;
    var clickEvent = (function() {
        if ('ontouchstart' in document.documentElement === true)
            return 'touchstart';
        else
            return 'click';
    })();


    function hideModal(){
        document.getElementById('default-modal').style = 'display:none;';
        let isComplete = false;

        const intro = introJs();
        intro.start();
        intro.oncomplete(function() {
            startTime = Date.now();
            isComplete = true;
            startIntervalTimer(timerSeconds);
        });
        intro.onexit(function() {
            if(!isComplete){
                startTime = Date.now();
                startIntervalTimer(timerSeconds);
            }
        });
    }

    function showModal(){
        document.getElementById('default-modal').style = 'display:flex;';
    }



    function createBorderTimer(){
        const borderDiv = document.createElement('div');
        borderDiv.className = 'timer-border';
        document.querySelector('.mini-game').appendChild(borderDiv);
        const timerBorder = document.querySelector('.timer-border');

        setTimeout(() => {
            timerBorder.style.clipPath = 'inset(0 0 0 0)'; // Fill the border
            timerBorder.style.transition = 'clip-path ' + timeRemaining +'s linear';
        }, 500);

        setTimeout(() => {
            borderDiv.remove();
            failedAtAiming();
            hideAimingMechanic();
        }, (timeRemaining  * 1000) + 500);
    }



    // Get elements
    const instructionsButton = document.getElementById('instructionsButton');
    const modal = document.getElementById('default-modal1');
    const closeModalButtons = modal.querySelectorAll('[data-modal-hide]');

    // Function to show the modal
    function showModal1() {
        modal.classList.remove('hidden');
        modal.classList.add('flex'); // Add 'flex' to use flexbox for centering
    }

    // Function to hide the modal
    function hideModal1() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Event listener to show the modal when the button is clicked
    instructionsButton.addEventListener(clickEvent, showModal1);

    // Event listeners to hide the modal when any close button is clicked
    closeModalButtons.forEach(button => {
        button.addEventListener(clickEvent, hideModal1);
    });

    // Optionally, close the modal if clicking outside of the modal content
    modal.addEventListener(clickEvent, (event) => {
        if (event.target === modal) {
            hideModal1();
        }
    });

    function hideLineNumber(){
        document.querySelector(".ace_gutter-cell").style.visibility = "hidden";
        document.querySelector(".ace_gutter").style.visibility = "hidden";
        document.querySelector(".ace_gutter-layer").style.visibility = "hidden";
    }

    function showLineNumber(){
        document.querySelector(".ace_gutter-cell").style.visibility = "visible";
        document.querySelector(".ace_gutter").style.visibility = "visible";
        document.querySelector(".ace_gutter-layer").style.visibility = "visible";
    }


    function showResetPanel(remainingTime) {
        console.log("Panel Displayed");

        endTime = Date.now();
        let timeTaken = Math.floor((endTime - startTime) / 1000);
        let timeLeft = Math.max(maxTime - timeTaken, 0); // Calculate the time left

        const endPanel = document.getElementById('endPanel');
        const endMessage = document.getElementById('endMessage');

        // Determine game result and update result message with a placeholder image
        const resultMessage = document.getElementById("resultMessage");
        const isGameOver = (remainingTime <= 0);1

        hideLineNumber();

        // Set a placeholder image depending on win/lose status
        resultMessage.innerHTML = isGameOver
            ? '<img src="/shipGameAssets/SHIPLose.png" alt="Game Over">'
            : '<img src="/shipGameAssets/SHIPWin.png" alt="You Win">';

        if (isGameOver) {
            endMessage.textContent = "YOU LOSE!";
        } else {
            endMessage.textContent = "YOU WIN!";
        }

        endPanel.style.backgroundSize = 'cover';
        endPanel.style.backgroundPosition = 'center';
        endPanel.style.color = 'white'; // For contrast against the image

        // Update the score, time taken, and error elements
        document.getElementById("timeTaken2").innerText = timeTaken;
        document.getElementById("globalScore").innerText = globalScore;
        document.getElementById("globalUserError").innerText = globalUserError;

        // Show the end panel
        document.getElementById("endPanel").style.display = "flex";

        setTimeout(function() {
            submitScore(timeTaken, timeLeft);
        }, 1000);

    }

    function submitScore(timeTaken, timeLeft){
        document.getElementById('TotalScore').value = totalScore;
        document.getElementById('MaxScore').value = maxScore;
        document.getElementById('Percentage').value = globalScore;
        document.getElementById('TaskStatus').value = 'Done';
        document.getElementById('errors').value = globalUserError;
        document.getElementById('timeTaken').value = timeTaken;
        document.getElementById('timeLeft').value = timeLeft;
        document.getElementById("scoreForm").submit();
    }

    function tryAgain() {
        submitScore(timeTaken, timeLeft);
        location.reload(); // Refresh the page to try again
    }

    function reset(){
        submitScore(timeTaken, timeLeft);
        window.location.href = '/';
    }


    showModal();

    var testcases = @json($testcases);
    console.log(testcases);
    let output = ``;
    for (let i = 0; i < testcases.length; i++) {
        output += `\n` + `System.out.println(` + `{{$methodName}}`+`(`;
        for (let x = 0; x < testcases[i].length - 1; x++) {
            output += testcases[i][x];
            if (x !== testcases[i].length - 2) {
                output += `, `;
            }
        }
        output += `));`;
    }
    console.log(output);



    var progressBar = document.querySelector(".progress-barc");
    var editor = ace.edit("code-editor");
    editor.setTheme("ace/theme/one_dark");
    editor.session.setMode("ace/mode/java");
    editor.setShowPrintMargin(false);
    editor.setAutoScrollEditorIntoView(true);
    editor.resize();
    editor.setOptions({
        fontSize: "20px"
    });

    editor.insert(`{{$template}}`);

    editor.moveCursorTo(2, 8);

    function runCode() {
        let userCode = editor.getValue();
        let code = `import java.util.*;
        public class myClass
{
    public static void main(String[] args)
    {
        ${output}
    }
    ${userCode}
}
`;
        axios.post('/execute-code', { script: code })
            .then(function(response) {
                console.log(response);
                let codeOutput = response.data;
                let testCasesResult = checkTestCases(codeOutput);
                updateScore(testCasesResult);
                document.getElementById('output').innerHTML = formatTestCasesResult(testCasesResult);
            })
            .catch(function(error) {
                console.log(error);
            });
    }

    function formatTestCasesResult(testCasesResult) {
        let formattedResult = '<ul>';
        for (let result of testCasesResult) {
            formattedResult += `<li>${result.resultText}</li>`;
        }
        formattedResult += '</ul>';
        return formattedResult;
    }

    function checkTestCases(output) {
        let testCasesAnswer = output.split('\n');
        let testCasesResult = [];

        for (let i = 0; i < testCasesAnswer.length; i++) {
            let answer = testCasesAnswer[i].trim();
            let expected = testcases[i][testcases[i].length - 1];
            let testCase = testcases[i].slice(0, -1).join(', ');

            let resultText = `Test Case ${i + 1}: ${testCase} = ${expected}`;
            let correct = answer === expected.toString();

            if (correct) {
                resultText += ' (Correct)';
            } else {
                resultText += ` (Incorrect, User Output: ${answer}, Expected: ${expected})`;
                globalUserError++;
                resumeTimer();
            }

            testCasesResult.push({ resultText, correct });
        }

        return testCasesResult;
    }

    function delay(time) {
        return new Promise(resolve => setTimeout(resolve, time));
    }

    async function updateScore(testCasesResult) {
        let score = 0;
        maxScore = testCasesResult.length;

        // Function to delay execution
        function delay(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        for (let result of testCasesResult) {
            await delay(600); // Wait 600ms before processing the next result
            if (result.correct) {
                score++;
                fireBullet(scene);
            }
        }

        let scorePercentage = Math.floor((score / maxScore) * 100);

        document.getElementById("score").innerHTML = score;
        var progressBarWidth = scorePercentage + "%";
        progressBar.style.width = progressBarWidth;

        scorePercentage = Math.floor((score / maxScore) * 100);
        totalScore = score;


        globalScore = scorePercentage;

        document.getElementById("TotalScore").value = score;
        document.getElementById("MaxScore").value = maxScore;
        document.getElementById("Percentage").value = scorePercentage;

        if(globalScore === 100){
            showResetPanel(remainingTime);
        }
    }

    function startIntervalTimer(timeSec) {
        remainingTime = timeSec;
        roundRemainingTime = 5;  // Total rounds to start with

        function mainTimer() {
            timer1 = setInterval(function () {
                if (!isPaused) {
                    remainingTime--;
                    document.getElementById("timer").innerHTML = remainingTime;

                    if (remainingTime === 0) {
                        clearInterval(timer1);
                        console.log("Time's up!");
                    }

                    if (globalScore === 100) {
                        stopAllTimers();
                        document.getElementById("timer").innerHTML = "Done";
                        showResetPanel(remainingTime);
                    }
                }
            }, 1000);
        }

        function roundTimer() {
            timer = setInterval(function () {
                roundRemainingTime--;
                console.log(roundRemainingTime);
                triggerRandomAttack();
                createHelpPrompt();

                delay(600).then(() => shakeCamera(scene));

                if (currentPlayerHealth === 0) {
                    stopAllTimers();
                    console.log("Done!");
                    document.getElementById("timer").innerHTML = "Done";
                    showResetPanel(remainingTime);
                }

                if (globalScore === 100) {
                    stopAllTimers();
                    document.getElementById("timer").innerHTML = "Done";
                    showResetPanel(remainingTime);
                }
            }, (timeSec * 1000) + 1000);
        }

        mainTimer();
        roundTimer();
    }

    // Pause function
    function pauseTimer() {
        isPaused = true;
        clearInterval(timer1);
        clearInterval(timer2);
        clearInterval(timer);
    }

    // Resume function
    function resumeTimer() {
        if (isPaused) {
            isPaused = false;

            console.log(currentPlayerHealth);
            if (currentPlayerHealth === 0) {
                stopAllTimers();
                console.log("Done!");
                document.getElementById("timer").innerHTML = "Done";
                showResetPanel(remainingTime);
            }

            // If paused at 0, reset to original interval time
            if (remainingTime === 0) {
                remainingTime = timerSeconds;
            }

            startIntervalTimer(remainingTime);  // Restart with updated remaining time
        }
    }

    // Stop all timers
    function stopAllTimers() {
        clearInterval(timer);
        clearInterval(timer1);
        clearInterval(timer2);
        document.getElementById("timer").innerHTML = "Done";
    }

    window.resumeTimer = resumeTimer;
    window.pauseTimer = pauseTimer;

    function createHelpPrompt() {
        pauseTimer();
        editor.setReadOnly(true);

        // Create the help prompt div
        const helpPrompt = document.createElement('div');
        helpPrompt.className = 'help-prompt fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50';

        // Create the inner container for the prompt
        const promptContainer = document.createElement('div');
        promptContainer.className = 'bg-white rounded-lg shadow-lg p-6 space-y-4 max-w-md w-full';

        // Create the message
        const message = document.createElement('p');
        message.textContent = 'Do you need help?';
        message.className = 'text-lg font-semibold';
        promptContainer.appendChild(message);

        // Create a container for the buttons
        const buttonContainer = document.createElement('div');
        buttonContainer.className = 'flex justify-end space-x-4';

        // Create the Yes button
        const yesButton = document.createElement('button');
        yesButton.textContent = 'Yes';
        yesButton.className = 'px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition';
        yesButton.addEventListener(clickEvent ,() => {
            showAimingMechanic();
            createBorderTimer();
            document.body.removeChild(helpPrompt); // Remove the prompt
            const intro2 = introJs();
            intro2.setOptions({
                tooltipPosition : 'top',
                steps: [
                    {
                        element: '#minigame',
                        intro: "Press the red button in the ship to shoot! You only have 5 bullets each round. Use them wisely! Draining the enemy's HP will provide you a tip after the minigame.",
                        position: 'top'
                    }
                ]
            });
            intro2.start();
        });
        buttonContainer.appendChild(yesButton);

        // Create the No button
        const noButton = document.createElement('button');
        noButton.textContent = 'No';
        noButton.className = 'px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition';
        noButton.addEventListener(clickEvent , () => {
            document.body.removeChild(helpPrompt); // Remove the prompt
            resumeTimer();
            editor.setReadOnly(false);
        });
        buttonContainer.appendChild(noButton);

        // Append the button container to the prompt container
        promptContainer.appendChild(buttonContainer);

        // Append the prompt container to the help prompt div
        helpPrompt.appendChild(promptContainer);

        // Append the help prompt to the body or a specific container
        document.body.appendChild(helpPrompt); // Append the prompt to the body
    }


    // Function to disable typing for half of timerSeconds
    function disableTyping(editor, timerSeconds) {
        const halfTime = (timerSeconds / 2) * 1000; // Convert to milliseconds
        alert(`You Failed. Typing will be disabled for ${halfTime/1000} seconds`);
        resumeTimer();

        // Step 2: Disable typing immediately
        editor.setReadOnly(true);
        console.log("Typing disabled in Ace Editor");

        // Step 3: Set a timeout to re-enable typing after halfTime
        setTimeout(() => {
            pauseTimer();
            resumeTimer();
            editor.setReadOnly(false);  // Enable typing
        }, halfTime);
    }

    // Make it global by attaching it to the window object
    window.disableTyping = disableTyping;




    document.getElementById('startButton').addEventListener(clickEvent , () => {
        hideModal();
    });

    document.getElementById('runButton').addEventListener(clickEvent , () => {
        runCode();
        pauseTimer();
    });




</script>
<script>
    const sectionId = "{{$user->section->id}}";
    const username = "{{Auth::user()->name}}";
</script>

</body>
</html>
