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
                    <div class="score"> Score<span id="score">0</span> </div>
                    <div class="timer"> Timer<span id="timer">10</span> </div>

                    <div class="pb">
                        Progress
                        <div class="progress-bar">
                            <div class="progress-barc"></div>
                        </div>
                    </div>
                    <button type="button" class="p-5 bg-green-500 rounded" onclick="runCode();">RUN</button>


                    <!-- Modal toggle -->
                    <button data-modal-target="default-modal1" data-modal-toggle="default-modal1" class="p-5 bg-green-500 rounded mr-5" type="button">
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
            <div class="coding-area h-96 mb-4" id="coding-area">
                <div class="code-editor" id="code-editor"></div>
                <div class="code" id="code" style="display: none"></div>
            </div>

            <div class="instrucContainer overflow-scroll max-h-72">
                    <div class="output h-[270px] " id="output">

                    </div>
            </div>

        </div>

        <div class="right-panel flex flex-col  bg-white h-5/6 xl:w-2/5 p-5">
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


<div class="endPanel" id="endPanel">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-blue-600 rounded-lg border shadow dark:bg-blue-700 text-white flex flex-col items-center justify-center p-4 w-3/4 max-w-md h-32">
        <h2 id="endText">Your score is: <span id="score2"></span></h2>
    </div>
</div>


<!-- Main modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-gray-200 rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Initial Instructions
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <div class="text-xl leading-relaxed text-black dark:text-gray-400">
                    {!! $task->TaskInstruction!!}
                </div>
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



    function hideModal(){
        document.getElementById('default-modal').style = 'display:none;';
        startIntervalTimer(timerSeconds);
        startTime = Date.now();
    }

    function showModal(){
        document.getElementById('default-modal').style = 'display:flex;';
    }

    function showResetPanel(){
        endTime = Date.now(); // Set the end time when the game ends
        let timeTaken = Math.floor((endTime - startTime) / 1000); // Calculate the time taken in seconds
        let timeLeft = Math.max(maxTime - timeTaken, 0); // Calculate the time left

        var endPanel = document.getElementById("endPanel");
        var score2 = document.getElementById("score2");
        endPanel.style.display = "block";
        score2.innerHTML = globalScore + "% </br> " + "Errors: " + globalUserError;

        setTimeout(function(){
            submitScore(timeTaken, timeLeft);
        }, 2000);
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
                        showResetPanel();
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
                    showResetPanel();
                }

                if (globalScore === 100) {
                    stopAllTimers();
                    document.getElementById("timer").innerHTML = "Done";
                    showResetPanel();
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
                showResetPanel();
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
        yesButton.onclick = () => {
            showAimingMechanic();
            createBorderTimer();
            document.body.removeChild(helpPrompt); // Remove the prompt
        };
        buttonContainer.appendChild(yesButton);

        // Create the No button
        const noButton = document.createElement('button');
        noButton.textContent = 'No';
        noButton.className = 'px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition';
        noButton.onclick = () => {
            alert('You clicked No.'); // Alert for No
            document.body.removeChild(helpPrompt); // Remove the prompt
            resumeTimer();
            editor.setReadOnly(false);
        };
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
            alert('Typing Enabled!');
            resumeTimer();
            editor.setReadOnly(false);  // Enable typing
        }, halfTime);
    }

    // Make it global by attaching it to the window object
    window.disableTyping = disableTyping;

    document.getElementById('startButton').addEventListener('click' , () => {
        hideModal();
    });


</script>
<script>
    const sectionId = "{{$user->section->id}}";
    const username = "{{Auth::user()->name}}";
</script>
<script src="agraNotification.js"></script>

</body>
</html>
