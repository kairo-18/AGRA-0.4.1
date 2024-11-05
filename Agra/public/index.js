var progressIncrement;
let totalScore = 0;
let maxScore = 0;
let userErrors = 0;
let globalUserError = 0;
let globalCorrectAnswers;
let maxTime = checkmarks.length * timerSeconds; // Total maximum time allowed
let startTime; // Time when the user starts the task
let endTime; // Time when the user completes the task
var isAttackInProgress = false;
var game = document.getElementById('minigame');
checkmarks.forEach(checkmark => {
    maxScore += checkmark.points;
});

// populateCheckmarks();
progressIncrement = 9 / checkmarks.length;
calculateMaxMonsterHealth(checkmarks.length);

var progressBar = document.querySelector(".progress-barc");
progressBar.style.opacity = "0";

var langTools = ace.require("/ace-builds/src-noconflict/ext-language_tools.js");
var editor = ace.edit("code-editor");
editor.setTheme("ace/theme/one_dark");

//Test 2
// Create instruction container for dynamically displaying instructions
const instructionDiv = document.createElement("div");
instructionDiv.style.position = "absolute";
instructionDiv.style.backgroundColor = "white";
instructionDiv.style.border = "1px solid #ddd";
instructionDiv.style.padding = "10px";
instructionDiv.style.borderRadius = "8px";
instructionDiv.style.boxShadow = "0px 4px 8px rgba(0,0,0,0.2)";
instructionDiv.style.display = "none"; // Initially hidden

const instructionText = document.createElement("p");
instructionText.style.margin = "0 0 10px 0";
instructionText.style.fontSize = "20px";
instructionText.style.color = "black";
instructionDiv.appendChild(instructionText);

// Create button for checking answer
const checkButton = document.createElement("button");
checkButton.textContent = "Check Answer";
checkButton.style.padding = "8px 16px";
checkButton.style.fontSize = "14px";
checkButton.style.backgroundColor = "#4CAF50";
checkButton.style.color = "white";
checkButton.style.border = "none";
checkButton.style.borderRadius = "4px";
checkButton.style.cursor = "pointer";
instructionDiv.appendChild(checkButton);

// Append the instruction div to the editor's container
document.getElementById("code-editor").appendChild(instructionDiv);

let currentCheckmarkIndex = 0;
let lastTypedLine = 0; // Track the last line the user typed on

// Capture the last line when the user stops typing
editor.selection.on('changeCursor', () => {
    const cursorPosition = editor.getCursorPosition();
    lastTypedLine = cursorPosition.row;
    displayInstruction(currentCheckmarkIndex);  // Reposition instruction div
});

// Function to display the instruction div below the captured last typed line
function displayInstruction(index) {
    if (index < checkmarks.length) {
        const instruction = checkmarks[index].instruction;
        instructionText.innerHTML = instruction;
        instructionDiv.style.display = "block"; // Show the instruction div
        instructionDiv.style.minWidth = "500px";

        // Get screen position for the next line after the last typed line
        const lineScreenPosition = editor.renderer.textToScreenCoordinates(lastTypedLine + 1, 0);
        const editorScrollTop = editor.session.getScrollTop();

        console.log(lineScreenPosition);

        // Position the instruction div based on the captured line position
        const lineHeight = editor.renderer.lineHeight - 200;
        instructionDiv.style.top = `${lineScreenPosition.pageY - editorScrollTop + lineHeight}px`;
        instructionDiv.style.left = `60px`;
    } else {
        instructionDiv.style.display = "none"; // Hide when all instructions are complete
    }
}

// Event listener for the check button
checkButton.addEventListener("click", () => {
    // Move cursor to the end of the current line
    // const currentLine = editor.getCursorPosition().row;
    // const lineLength = editor.session.getLine(currentLine).length;
    // editor.moveCursorTo(currentLine, lineLength);
    editor.navigateLineEnd();

    // Proceed with the rest of the check answer logic
    const currentAnswer = checkmarks[currentCheckmarkIndex].answer.trim();
    const userCode = editor.getValue().trim();
    var editorValue = editor.getValue();
    var editorLines = editorValue.split("\n");
    var initialErrors = userErrors;

    checkCodeByLine(editorLines);

    // Check if the user's code contains the correct answer
    if (userCode.includes(currentAnswer)) {
        checkmarks[currentCheckmarkIndex].done = true;
        currentCheckmarkIndex++;

        if (currentCheckmarkIndex < checkmarks.length) {
            displayInstruction(currentCheckmarkIndex);
            whenPlayerAttack();
        } else {
            instructionText.textContent = "All Instructions Complete!";
            checkButton.disabled = true;
        }
    } else {
        alert("Incorrect answer. Please try again.");
    }
});

// Show the first instruction but offset it down
const initialInstructionIndex = currentCheckmarkIndex; // Keep it for the first instruction
lastTypedLine = 100; // Adjust this value to move the initial instruction further down
displayInstruction(initialInstructionIndex); // This call displays the instruction based on the offset

//Test 2 end

if(language === "C#"){
    editor.session.setMode("ace/mode/csharp");
}else{
    editor.session.setMode("ace/mode/java");
}
editor.setShowPrintMargin(false);
editor.setAutoScrollEditorIntoView(true);
editor.resize();
editor.setOptions({
    fontSize: "20px",
    enableBasicAutocompletion: true,
    enableSnippets: true,
    enableLiveAutocompletion: true,
});

editor.insert(template);

var content = document.getElementById("code");
content.innerHTML = editor.getValue();

readonly_lines("code-editor", content, [1,2,3], true);

var code = `public class Main {

  public static void main(String[] args) {

    int first = 10;
    int second = 20;

    int sum = first + second;
    System.out.println(first + " + " + second + " = "  + sum);

  }
}`;

let keywords = uniq(extractKeywords(code));

//create a function that will extract keywords from the given code
function extractKeywords(code) {
    //split the code into words
    let words = code.split(/\s+|(?<=[^\w\s])|(?=[^\w\s])/g).filter(Boolean);

    return removeNonWords(words);
}

function delay(time) {
    return new Promise(resolve => setTimeout(resolve, time));
}

function removeNonWords(arr) {
    const wordPattern = /[\w']+(!)?/g;

    const wordsOnly = arr.join(' ').match(wordPattern) || [];

    return wordsOnly;
}

function uniq(a) {
    var seen = {};
    return a.filter(function (item) {
        return seen.hasOwnProperty(item) ? false : (seen[item] = true);
    });
}
hideLineNumber()
function checkCodeByWord() {
    var input = editor.getValue();
    var inputWords = input.split(/[.\s(){}'""\[\]`]+/).filter((word) => word.trim() !== "");


    inputWords.forEach(word => {
        if (keywords.includes(word)) {
            score++;
            updateScore();

            let wordIndex = keywords.indexOf(word);
            keywords.splice(wordIndex, 1); // Delete the matched keyword
        }
    });
}

let globalScore = 0;


// Define a map to keep track of whether each checkmark has already been processed

function updateScore() {
    var score = 0;
    var scorePercentage = 0;
    maxScore = 0;

    checkmarks.forEach(checkmark => {
        if(checkmark.done){
            score += checkmark.points;
        }

    });

    checkmarks.forEach(checkmark => {
        maxScore += checkmark.points;
    });

    scorePercentage = Math.floor((score / maxScore) * 100);

    globalScore = scorePercentage;
    totalScore = score;
    document.getElementById("score").innerHTML = score;

    // Calculate the width of the progress bar based on the score percentage
    var progressBarWidth = scorePercentage + "%";
    progressBar.style.width = progressBarWidth;

    if (score > 0) {
        progressBar.style.opacity = "1";  // Make the progress bar visible
    } else {
        progressBar.style.opacity = "0";  // Hide the progress bar when score is 0
    }
}

let globalCurrentCheckmark;
var currentCheckmark = 0;

function readonly_lines(id, content, line_numbers, fromAdminFlag) {
    var readonly_ranges = [];
    for (var i = 0; i < line_numbers.length; i++) {
        readonly_ranges.push([line_numbers[i] - 1, 0, line_numbers[i], 0]);
    }
    console.log("ran")
    refresheditor(id, content, readonly_ranges, fromAdminFlag);
}

function checkCodeByLine(editorLines) {
    if (isAttackInProgress) {
        console.log("Checking is disabled during an attack.");
        return;
    }

    var errorDetected = false;
    var correctAnswers = 0;

    var currline = editor.getSelectionRange().start.row;
    var wholelinetxt = editor.session.getLine(currline).trim();

    var content = document.getElementById("code");
    content.innerHTML = editor.getValue();

    console.log("Line:" + wholelinetxt);

    if (wholelinetxt === checkmarks[currentCheckmark].answer.trim()) {
        console.log("Answer:" + checkmarks[currentCheckmark].answer.trim());
        checkmarks[currentCheckmark].done = true;
        currentCheckmark++;
        // checkCheckmarks();
        correctAnswers++;
        editor.insert("\n");
        readonly_lines("code-editor", content, getCorrectLineNumbers(), false);

        delay(10).then(() => {
            lastTypedLine = editor.getCursorPosition().row;
            displayInstruction(currentCheckmarkIndex);
            editor.insert("");
        });

    } else {
        errorDetected = true;
        userErrors++;
        editor.find(wholelinetxt);
    }

    console.log("User Error:" + userErrors);

    updateScore();

    globalCurrentCheckmark = currentCheckmark;
    globalCorrectAnswers = correctAnswers;
    globalUserError = userErrors;
}



function refresheditor(id, content, readonly, fromAdminFlag) {
    set_readonly(editor, readonly, fromAdminFlag);
}

function set_readonly(editor,readonly_ranges, fromAdminFlag) {
    var session = editor.getSession();
    var Range = ace.require('ace/range').Range;

    ranges = [];

    function before(obj, method, wrapper) {
        var orig = obj[method];
        obj[method] = function() {
            var args = Array.prototype.slice.call(arguments);
            return wrapper.call(this, function(){
                return orig.apply(obj, args);
            }, args);
        }
        return obj[method];
    }
    function intersects(range) {
        return editor.getSelectionRange().intersects(range);
    }
    function intersectsRange(newRange) {
        for (i=0;i<ranges.length;i++)
            if(newRange.intersects(ranges[i]))
                return true;
        return false;
    }
    function preventReadonly(next, args) {
        for(i=0;i<ranges.length;i++){if (intersects(ranges[i])) return;}
        next();
    }
    function onEnd(position){
        var row = position["row"],column=position["column"];
        for (i=0;i<ranges.length;i++)
            if(ranges[i].end["row"] == row && ranges[i].end["column"]==column)
                return true;
        return false;
    }
    function outSideRange(position){
        var row = position["row"],column=position["column"];
        for (i=0;i<ranges.length;i++){
            if(ranges[i].start["row"]< row && ranges[i].end["row"]>row)
                return false;
            if(ranges[i].start["row"]==row && ranges[i].start["column"]<column){
                if(ranges[i].end["row"] != row || ranges[i].end["column"]>column)
                    return false;
            }
            else if(ranges[i].end["row"] == row&&ranges[i].end["column"]>column){
                return false;
            }
        }
        return true;
    }
    for(i=0;i<readonly_ranges.length;i++){
        ranges.push(new Range(...readonly_ranges[i]));
    }

    if(fromAdminFlag){//means the request to readline is from admin
        ranges.forEach(function(range){session.addMarker(range, "readonly-highlight1");});
    }else{//means from user
        ranges.forEach(function(range){session.addMarker(range, "readonly-highlight");});
    }
    editor.keyBinding.addKeyboardHandler({
        handleKeyboard : function(data, hash, keyString, keyCode, event) {
            if (Math.abs(keyCode) == 13 && onEnd(editor.getCursorPosition())){
                return false;
            }
            if (hash === -1 || (keyCode <= 40 && keyCode >= 37)) return false;
            for(i=0;i<ranges.length;i++){
                if (intersects(ranges[i])) {
                    return {command:"null", passEvent:false};
                }
            }
        }
    });
    before(editor, 'onPaste', preventReadonly);
    before(editor, 'onCut',   preventReadonly);
    for(i=0;i<ranges.length;i++){
        ranges[i].start  = session.doc.createAnchor(ranges[i].start);
        ranges[i].end    = session.doc.createAnchor(ranges[i].end);
        ranges[i].end.$insertRight = true;
    }

    var old$tryReplace = editor.$tryReplace;
    editor.$tryReplace = function(range, replacement) {
        return intersectsRange(range)?null:old$tryReplace.apply(this, arguments);
    }
    var session = editor.getSession();
    var oldInsert = session.insert;
    session.insert = function(position, text) {
        return oldInsert.apply(this, [position, outSideRange(position)?text:""]);
    }
    var oldRemove = session.remove;
    session.remove = function(range) {
        return intersectsRange(range)?false:oldRemove.apply(this, arguments);
    }
    var oldMoveText = session.moveText;
    session.moveText = function(fromRange, toPosition, copy) {
        if (intersectsRange(fromRange) || !outSideRange(toPosition)) return fromRange;
        return oldMoveText.apply(this, arguments);
    }

}

function getCorrectLineNumbers() {
    var correctLineNumbers = [];
    var codeLines = editor.getValue().split('\n');
    checkmarks.forEach(checkmark => {
        if (checkmark.done && checkmark.answer) {
            var lineNumber = findLineNumber(checkmark.answer, codeLines);
            if (lineNumber !== -1) {
                correctLineNumbers.push(lineNumber + 1); // Adjusting line number to start from 1-based index
            }
        }
    });
    return correctLineNumbers;
}

// Function to find the line number of a given text in an array of lines
function findLineNumber(text, lines) {
    for (var i = 0; i < lines.length; i++) {
        if (lines[i].includes(text)) {
            return i;
        }
    }
    return -1;
}

var tempCtr = 0;
function whenPlayerAttack(){

    if(tempCtr < checkmarks.length){
        if(checkmarks[tempCtr].done){
            playerMove(scene);
            delay(400).then(() => monster.play(`${monsterKey}Attack`, true));
            tempCtr++;
        }
    }
}

function runClick() {

    const req1 = new window.XMLHttpRequest();

    var input = {
        code: editor.getValue()
    }

    req1.open("POST", "/getinput", true);
    req1.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

    req1.send(JSON.stringify(input));



    const req = new XMLHttpRequest();

    req.open('GET', '/output', true);
    req.addEventListener('load', function () {
        var output = req.responseText;
        displayOutput(output);
    });
    req.send();
}

async function sendPrompt(instruction, userCode) {
    try {
        const response = await axios.post('/prompt', {
            instruction: instruction,
            userCode: userCode,
            progLanguage: language,
        });
        return response.data.result;
    } catch (error) {
        console.error(error);
        return null; // or handle the error as needed
    }
}


function startIntervalTimer(timeSec) {
    let rounds = checkmarks.length;
    let time = timeSec;
    let isPaused = false;  // Flag to track if the timer is paused
    let timer, timer2;  // Declare timers to allow access in pause/resume

    // Start the timer cycle immediately
    runTimerCycle();

    // Set the interval to run after the initial execution
    timer = setInterval(async function () {
        if (!isPaused) runTimerCycle();  // Only run if not paused
    }, (timeSec * 1000) + 2000);

    function runTimerCycle() {
        time = timeSec;  // Reset the countdown time

        // Create the inner timer for countdown
        timer2 = setInterval(function () {
            if (isPaused) return;  // If paused, skip the rest

            // Prevent the timer from going negative
            if (time <= 0) {
                time = 0; // Ensure it doesn't go below zero
                clearInterval(timer2); // Stop the countdown timer
                document.getElementById("timer").innerHTML = "0";
                return; // Exit the function to prevent further execution
            }

            document.getElementById("timer").innerHTML = time;
            time--;
            if (time === 0) {
                // Trigger monster move and damage after countdown
                monsterMove(scene);



                // Call the function to center the div
                temporarilyCenterGameDiv();


                delay(1300).then( () => {showHitOverlay();})
                rounds--;
                console.log(rounds);
                console.log(currentPlayerHealth);


                clearInterval(timer2);  // Stop the inner timer when the round ends

                // Check if AlertBox should be displayed based on the rounds value
                if (rounds > 0) {
                    sendPrompt(checkmarks[currentCheckmark].instruction, editor.getValue()).then(result => {
                        delay(1500).then( () => {createAlertBox(result)}); // Show alert box only if rounds > 1
                    });
                }
            }

            // Check for global score to finish
            if (globalScore === 100) {
                stopTimer();  // Call stopTimer to clear intervals
            }
        }, 1000);

        if (rounds <= 0) {
            stopTimer();  // Stop the timer when rounds reach zero
        }

        if (globalScore === 100) {
            stopTimer();
        }
    }

    // Function to stop both timers
    function stopTimer() {
        clearInterval(timer);
        clearInterval(timer2);
        console.log("Done!");
        document.getElementById("timer").innerHTML = "Done";
        showResetPanel();
    }

    // Function to pause the timer
    function pauseTimer() {
        isPaused = true;
        clearInterval(timer);
        clearInterval(timer2);
        console.log("Timer paused.");
    }

    // Function to resume the timer
    function resumeTimer() {
        if (!isPaused) return;  // Only resume if it was paused

        isPaused = false;
        console.log("Timer resumed.");

        // Resume the timer with remaining time
        timer2 = setInterval(function () {
            if (isPaused) return;  // If paused, skip the rest

            // Prevent the timer from going negative
            if (time <= 0) {
                time = 0; // Ensure it doesn't go below zero
                clearInterval(timer2); // Stop the countdown timer
                document.getElementById("timer").innerHTML = "Time's up!";
                return; // Exit the function to prevent further execution
            }

            document.getElementById("timer").innerHTML = time;
            time--;
            if (time === 0) {
                // Trigger monster move and damage after countdown
                monsterMove(scene);
                temporarilyCenterGameDiv()
                rounds--;
                console.log(rounds);
                console.log(currentPlayerHealth);

                clearInterval(timer2);  // Stop the inner timer when the round ends

                // Check if AlertBox should be displayed based on the rounds value
                if (rounds > 0) {
                    sendPrompt(checkmarks[currentCheckmark].instruction, editor.getValue()).then(result => {
                        createAlertBox(result); // Show alert box only if rounds > 1
                    });
                }
            }

            // Check for global score to finish
            if (globalScore === 100) {
                stopTimer();  // Call stopTimer to clear intervals
            }
        }, 1000);

        timer = setInterval(async function () {
            if (!isPaused) runTimerCycle();
        }, (timeSec * 1000) + 2000);
    }

    // Expose the pause and resume functions globally
    window.pauseTimer = pauseTimer;
    window.resumeTimer = resumeTimer;
}

function createAlertBox(message) {
    // Add custom styles to the head if they don't exist
    if (!document.getElementById('customAlertStyles')) {
        const style = document.createElement('style');
        style.id = 'customAlertStyles';
        style.innerHTML = `
            * {
                margin: 0;
                padding: 0;
            }
            html {
                font-family: Poppins, sans-serif;
                color: #f0f0f0;
            }
            body {
                min-height: 100vh;
                background: #0b0d15;
                color: #a2a5b3;
                align-content: center;
            }
            h1 {
                color: white;
            }
            .card {
                margin: 0;
                padding: 10px;
                width: 90%;
                background: #1c1f2b;
                text-align: center;
                border-radius: 10px;
                position: relative;
            }
            @property --angle {
                syntax: "<angle>";
                initial-value: 0deg;
                inherits: false;
            }
            .card::after, .card::before {
                content: '';
                position: absolute;
                height: 100%;
                width: 100%;
                background-image: conic-gradient(from var(--angle), transparent 10%, blue );
                top: 50%;
                left: 50%;
                translate: -50% -50%;
                z-index: -1;
                border: 10px;
                padding: 15px;
                border-radius: 10px;
                animation: 3s spin linear infinite;
            }
            .card::before {
                filter: blur(1.5rem);
                opacity: 100;
            }
            @keyframes spin {
                from {
                    --angle: 0deg;
                }
                to {
                    --angle: 360deg;
                }
            }
            .fade-out {
                opacity: 0 !important;
                transition: opacity 0.5s ease-in-out;
            }
        `;
        document.head.appendChild(style);
    }

    // Create a new alert box element
    const alertBox = document.createElement('div');
    alertBox.classList.add('card'); // Apply the card class for the animated border
    alertBox.innerHTML = `
        <div class="flex flex-col gap-2.5">
        <div class="flex bg-blue-800 rounded-b text-white px-4 py-3 alert-box m-10 pb-10">
            <div class="py-1">
                <svg class="fill-current h-10 w-10 text-white mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold">Tips to help</p>
                <p class="text-xl">${message}</p>
            </div>


        </div>

            <button type="button" onclick="removeAlertBox()" disabled class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-lg px-5 py-2.5 me-2 mb-2 mt-3 z-50">3</button>
        </div>
    `;

    // Append the alert box to the container
    document.getElementById('alertContainer').appendChild(alertBox);

    const button = alertBox.querySelector("button");
    let countdown = 3;

    // Start the countdown interval
    const countdownInterval = setInterval(() => {
        countdown--;
        if (countdown > 0) {
            button.textContent = countdown; // Update button text with countdown
        } else {
            clearInterval(countdownInterval); // Stop countdown
            button.textContent = "Understood"; // Set final text
            button.disabled = false; // Enable the button
        }
    }, 1000);
    // setTimeout(() => pauseTimer(), 3000);
    pauseTimer();

    // Set a timeout to remove the alert box after 7 seconds

    function removeAlertBox(){
        alertBox.classList.add('fade-out');
        setTimeout(() => alertBox.remove(), 500); // Wait for fade-out transition
        setTimeout(() => resumeTimer(), 2000);
        document.getElementById("startPanel").style.display = "none";
    }

    window.removeAlertBox = removeAlertBox;

}


function displayOutput(output) {
    //replace \n with <br>
    output = output.replace(/\n/g, "<br>");
    document.getElementById("output").innerHTML = output;
}

var startButton = document.getElementById("startButton");

function startGame(){
    startTime = Date.now();
    startButton.style.display = "none";
    document.getElementById("startPanel").style.display = "none";
    document.getElementById("startPanel").style.zIndex = 10;

    showLineNumber();
    startIntervalTimer(timerSeconds);
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
    }, 5000);
}


function submitScore(timeTaken, timeLeft){
    document.getElementById('TotalScore').value = totalScore;
    document.getElementById('MaxScore').value = maxScore;
    document.getElementById('Percentage').value = globalScore;
    document.getElementById('TaskStatus').value = 'Done';
    document.getElementById('errors').value = userErrors;
    document.getElementById('timeTaken').value = timeTaken;
    document.getElementById('timeLeft').value = timeLeft;
    document.getElementById("scoreForm").submit();
}

function doneTaskStatus() {
    document.getElementById('TaskStatus').value = 'Done';
    //document.getElementById('taskStatusForm').submit();
}


function reset(){
    window.location.href = '/';
}


function showHitOverlay() {
    const overlay = document.getElementById('hit-overlay');
    overlay.style.opacity = '1'; // Show overlay

    // Hide overlay after a brief duration
    setTimeout(() => {
        overlay.style.opacity = '0'; // Fade out
    }, 300); // Adjust time to how long you want the effect to last
}

function temporarilyCenterGameDiv() {
    // Get the dimensions of the viewport and the div
    var viewportWidth = window.innerWidth;
    var viewportHeight = window.innerHeight;
    var gameWidth = game.offsetWidth;
    var gameHeight = game.offsetHeight;

    // Check if the screen width is below a certain threshold (e.g., 600px)
    if (viewportWidth < 1000) {
        // For smaller screens, center horizontally and move to the top
        var translateX = (viewportWidth); // Center horizontally
        var translateY = (viewportHeight); // Move down slightly from the top

        // Apply transform to center horizontally and position near the top
        game.style.transform = `translate(0px, -${translateY}px)`;
    } else {
        // For larger screens, center vertically and horizontally
        var translateX = (viewportWidth - gameWidth) / 2;

        // Apply transform to center in the viewport
        game.style.transform = `translate(-${translateX}px, 0px)`;
    }



    // After 2 seconds, reset the transform and animation
    setTimeout(function() {
        game.style.transform = 'translate(0, 0)'; // Reset to original position
    }, 2000); // Change this duration as needed
}

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

document.getElementById('startButton').addEventListener('click', () => {
    startGame()
});
