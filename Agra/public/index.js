var progressIncrement;
let totalScore = 0;
let maxScore = 0;
let userErrors = 0;
let globalUserError = 0;
let globalTimeTaken = 0;
let globalCorrectAnswers;
let maxTime = checkmarks.length * timerSeconds; // Total maximum time allowed
let startTime; // Time when the user starts the task
let endTime; // Time when the user completes the task
var isAttackInProgress = false;
var game = document.getElementById('minigame');
checkmarks.forEach(checkmark => {
    maxScore += checkmark.points;
});

var clickEvent = (function() {
    if ('ontouchstart' in document.documentElement === true)
        return 'touchstart';
    else
        return 'click';
})();


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
// Get the existing instruction container and elements by their IDs
const instructionDiv = document.getElementById("instructionDiv");
instructionDiv.style.position = "absolute";
instructionDiv.style.backgroundColor = "white";
instructionDiv.style.border = "1px solid #ddd";
instructionDiv.style.padding = "10px";
instructionDiv.style.borderRadius = "8px";
instructionDiv.style.boxShadow = "0px 4px 8px rgba(0,0,0,0.2)";
instructionDiv.style.display = "none"; // Initially hidden

const instructionText = document.getElementById("instructionText");
instructionText.style.margin = "0 0 10px 0";
instructionText.style.fontSize = "20px";
instructionText.style.color = "black";

// Style the check answer button
const checkButton = document.getElementById("checkButton");
checkButton.style.padding = "8px 16px";
checkButton.style.fontSize = "14px";
checkButton.style.backgroundColor = "#4CAF50";
checkButton.style.color = "white";
checkButton.style.border = "none";
checkButton.style.borderRadius = "4px";
checkButton.style.cursor = "pointer";

// Create the recalibration button
const recalibrateButton = document.createElement('button');
recalibrateButton.innerText = 'Click to recreate';
recalibrateButton.style.position = 'absolute';
recalibrateButton.style.bottom = '5px';
recalibrateButton.style.right = '5px';
recalibrateButton.style.fontSize = '12px';
recalibrateButton.style.padding = '4px 8px';
recalibrateButton.style.cursor = 'pointer';

// Append the button to the instructionDiv
instructionDiv.appendChild(recalibrateButton);

checkButton.addEventListener(clickEvent, () => {
    // Move cursor to the end of the current line
    // const currentLine = editor.getCursorPosition().row;
    // const lineLength = editor.session.getLine(currentLine).length;
    // editor.moveCursorTo(currentLine, lineLength);
    editor.navigateLineEnd();

    // Proceed with the rest of the check answer logic
    const currentAnswers = checkmarks[currentCheckmarkIndex].answers.map(answer => answer.trim());
    const userCode = editor.getValue().trim();
    var editorValue = editor.getValue();
    var editorLines = editorValue.split("\n");
    var initialErrors = userErrors;

    checkCodeByLine(editorLines);


});

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

        // Position the instruction div based on the captured line position
        const lineHeight = editor.renderer.lineHeight - 100;
        instructionDiv.style.top = `${lineScreenPosition.pageY - editorScrollTop + lineHeight}px`;
        instructionDiv.style.left = `60px`;
    } else {
        instructionDiv.style.display = "none"; // Hide when all instructions are complete
    }
}

function recalibrateInstructionDiv() {
    const cursorPosition = editor.getCursorPosition();
    const cursorScreenPosition = editor.renderer.textToScreenCoordinates(cursorPosition.row, cursorPosition.column);

    // Update `instructionDiv` to be slightly below the cursor
    instructionDiv.style.top = `${cursorScreenPosition.pageY + 20}px`;
    instructionDiv.style.left = `$60px`;
}

// Attach click event to the recalibrate button
recalibrateButton.addEventListener('click', recalibrateInstructionDiv);

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
    console.log(checkmarks[currentCheckmark].answers)

    var normalizedLine = normalizeLine(wholelinetxt); // Normalize the line

    // Check if the user's input matches any of the possible answers
    var isCorrect = checkmarks[currentCheckmark].answers.some(answer =>
        normalizedLine === answer.trim()
    );

    if (isCorrect) {
        console.log("Answer found in possible answers for current checkmark.");
        checkmarks[currentCheckmark].done = true;
        currentCheckmark++;
        currentCheckmarkIndex++;
        correctAnswers++;

        if (currentCheckmark <= checkmarks.length) {
            displayInstruction(currentCheckmarkIndex);
            whenPlayerAttack();
        } else {
            instructionText.textContent = "All Instructions Complete!";
            checkButton.disabled = true;
        }

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
        pulsateRed(instructionDiv);
        shake(instructionDiv);
        monsterMove(scene);
        temporarilyCenterGameDiv();
        sendPrompt(checkmarks[currentCheckmark].instruction, editor.getValue()).then(result => {
            delay(100).then(() => createAlertBox(result));
        });
    }

    console.log("User Error:" + userErrors);

    updateScore();

    globalCurrentCheckmark = currentCheckmark;
    globalCorrectAnswers = correctAnswers;
    globalUserError = userErrors;


}

function normalizeLine(line) {
    // Step 1: Convert all tabs into spaces (assuming 4 spaces per tab).
    line = line.replace(/\t/g, '    ');

    // Step 2: Trim leading and trailing spaces.
    line = line.trim();

    // Step 3: Normalize spaces around equality operator.
    // Ensure there's exactly one space on both sides of the '=' operator.
    line = line.replace(/\s*=\s*/g, ' = ');

    // Step 4: Normalize spaces around common operators (e.g., +, -, *, /).
    // Ensure there's exactly one space on both sides of the operator.
    line = line.replace(/\s*([\+\-\*\/\=\!\<\>\&\|])\s*/g, ' $1 ');

    // Step 5: Collapse multiple spaces into one.
    line = line.replace(/\s+/g, ' ');

    return line;
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

    // Normalize the code lines before checking them
    var normalizedCodeLines = codeLines.map(line => normalizeLine(line));

    checkmarks.forEach(checkmark => {
        if (checkmark.done && checkmark.answers) {
            // Iterate over all possible answers and find the first match in normalizedCodeLines
            for (let answer of checkmark.answers) {
                var normalizedAnswer = normalizeLine(answer.trim()); // Normalize the answer as well
                var lineNumber = findLineNumber(normalizedAnswer, normalizedCodeLines);
                if (lineNumber !== -1) {
                    correctLineNumbers.push(lineNumber + 1); // Adjust to 1-based index
                    break; // Stop after finding the first matching answer
                }
            }
        }
    });

    return correctLineNumbers;
}

// Example of a function that finds the line number based on normalized content
function findLineNumber(answer, lines) {
    for (let i = 0; i < lines.length; i++) {
        if (lines[i] === answer) {
            return i; // Return the index of the matching line
        }
    }
    return -1; // Return -1 if no match is found
}

var tempCtr = 0;
function whenPlayerAttack(){

    if(tempCtr < checkmarks.length){
        if(checkmarks[tempCtr].done){
            playerMove(scene);
            temporarilyCenterGameDiv();
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
        if (!isPaused) runTimerCycle();
    }, (timeSec * 1000) + 2000);

    function runTimerCycle() {
        time = timeSec;  // Reset the countdown time

        // Create the inner timer for countdown
        timer2 = setInterval(function () {
            if (isPaused) return;

            if (time <= 0) {
                clearInterval(timer2);
                document.getElementById("timer").innerHTML = "0";
                return;
            }

            document.getElementById("timer").innerHTML = time;
            time--;
            if (time === 0) {
                monsterMove(scene);
                temporarilyCenterGameDiv();
                rounds--;

                clearInterval(timer2);

                if (rounds > 0) {
                    sendPrompt(checkmarks[currentCheckmark].instruction, editor.getValue()).then(result => {
                        delay(1500).then(() => createAlertBox(result));
                    });
                }
            }

            if (globalScore === 100) stopTimer();
        }, 1000);

        if (rounds <= 0 || globalScore === 100) stopTimer();
    }

    function stopTimer() {
        endTime = Date.now();
        let timeTaken = Math.floor((endTime - startTime) / 1000);

        // Stop timers
        clearInterval(timer);
        clearInterval(timer2);

        console.log(startTime);
        console.log(endTime);

        // Determine game result and update result message with a placeholder image
        const resultMessage = document.getElementById("resultMessage");
        const isGameOver = (rounds <= 0);1

        hideLineNumber();

        // Set a placeholder image depending on win/lose status
        resultMessage.innerHTML = isGameOver
            ? '<img src="path/to/game-over-placeholder.png" alt="Game Over">'
            : '<img src="path/to/you-win-placeholder.png" alt="You Win">';

        // Update the score, time taken, and error elements
        document.getElementById("timeTaken").textContent = timeTaken;
        document.getElementById("globalScore").innerText = globalScore;
        document.getElementById("globalUserError").innerText = globalUserError;

        // Show the end panel
        document.getElementById("endPanel").style.display = "flex";
    }


    function pauseTimer() {
        isPaused = true;
        clearInterval(timer);
        clearInterval(timer2);
    }

    function resumeTimer() {
        if (!isPaused) return;

        isPaused = false;

        if (time <= 0) time = timeSec;  // Reset time if it had reached zero

        timer2 = setInterval(function () {
            if (isPaused) return;

            if (time <= 0) {
                clearInterval(timer2);
                document.getElementById("timer").innerHTML = "Time's up!";
                return;
            }

            document.getElementById("timer").innerHTML = time;
            time--;

            if (time === 0) {
                monsterMove(scene);
                temporarilyCenterGameDiv();
                rounds--;

                clearInterval(timer2);

                if (rounds > 0) {
                    sendPrompt(checkmarks[currentCheckmark].instruction, editor.getValue()).then(result => {
                        createAlertBox(result);
                    });
                }
            }

            if (globalScore === 100) stopTimer();
        }, 1000);

        timer = setInterval(async function () {
            if (!isPaused) runTimerCycle();
        }, (timeSec * 1000) + 2000);
    }

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
            button.addEventListener(clickEvent, () => {
                removeAlertBox();
            });
        }
    }, 1000);
    // setTimeout(() => pauseTimer(), 3000);
    pauseTimer();

    // Set a timeout to remove the alert box after 7 seconds

    function removeAlertBox(){
        alertBox.classList.add('fade-out');
        setTimeout(() => alertBox.remove(), 500); // Wait for fade-out transition
        setTimeout(() => enableCheckButton(), 500);
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
    startCountdown();
    //startIntervalTimer(timerSeconds);
}


function showResetPanel(){
    endTime = Date.now(); // Set the end time when the game ends
    let timeTaken = Math.floor((endTime - startTime) / 1000); // Calculate the time taken in seconds
    let timeLeft = Math.max(maxTime - timeTaken, 0); // Calculate the time left

    var endPanel = document.getElementById("endPanel");
    var score2 = document.getElementById("score2");
    endPanel.style.display = "block";
    score2.innerHTML = globalScore + "% </br> " + "Errors: " + globalUserError;

    globalTimeTaken = timeTaken;
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

function tryAgain() {
    location.reload(); // Refresh the page to try again
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
    disableCheckButton();

    // Create the vignette overlay and add it to the body
    const vignetteOverlay = document.createElement('div');
    vignetteOverlay.classList.add('vignette-overlay');
    document.body.appendChild(vignetteOverlay);

    // Center the game div
    var viewportWidth = window.innerWidth;
    var viewportHeight = window.innerHeight;
    var gameWidth = game.offsetWidth;
    var gameHeight = game.offsetHeight;

    if (viewportWidth < 1000) {
        var translateX = viewportWidth;
        var translateY = viewportHeight;
        game.style.transform = `translate(0px, -${translateY}px)`;
    } else {
        var translateX = (viewportWidth - gameWidth) / 2;
        game.style.transform = `translate(-${translateX}px, 0px)`;
    }

    // Remove the vignette effect after centering
    setTimeout(function() {
        game.style.transform = 'translate(0, 0)';
        vignetteOverlay.remove(); // Remove the vignette overlay
        enableCheckButton();
    }, 2000);
}
function disableCheckButton() {
    const checkButton = document.getElementById("checkButton");
    checkButton.disabled = true; // Disable the button
}

function enableCheckButton() {
    const checkButton = document.getElementById("checkButton");
    checkButton.disabled = false; // Re-enable after specified duration

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

// Function to add the pulsating red effect
function pulsateRed(element, duration = 500) {
    const interval = 50; // Set interval for the pulsate effect (in milliseconds)
    let isRed = false;
    const pulsateInterval = setInterval(() => {
        element.style.backgroundColor = isRed ? "white" : "red";
        isRed = !isRed;
    }, interval);

    // Stop the pulsate effect after the specified duration
    setTimeout(() => {
        clearInterval(pulsateInterval);
        element.style.backgroundColor = "white"; // Reset to original color
    }, duration);
}

// Function to add shake effect
function shake(element, duration = 500) {
    const interval = 10; // Interval for shake effect (in milliseconds)
    let position = 0;
    const shakeInterval = setInterval(() => {
        position = position === 0 ? -5 : 5;
        element.style.transform = `translateX(${position}px)`;
    }, interval);

    // Stop the shake effect after the specified duration
    setTimeout(() => {
        clearInterval(shakeInterval);
        element.style.transform = "translateX(0)"; // Reset to original position
    }, duration);
}


document.getElementById('startButton').addEventListener(clickEvent , () => {
    startGame();
});

function startCountdown() {
    let isGameOver;
    // Update the timer every second
    const timerInterval = setInterval(function() {
        // Calculate minutes and seconds
        let minutes = Math.floor(timerSeconds / 60);
        let seconds = timerSeconds % 60;

        // Format time display
        seconds = seconds < 10 ? "0" + seconds : seconds;
        minutes = minutes < 10 ? "0" + minutes : minutes;

        // Display the timer
        document.getElementById("timer").innerHTML = `${minutes}:${seconds}`;

        // Decrement the time
        timerSeconds--;
        if (globalScore === 100) {
             isGameOver = false;
            stopTimer();
        }


        function stopTimer(){
            clearInterval(timerInterval);
            document.getElementById("timer").innerHTML = "Time's up!";

            endTime = Date.now();
            let timeTaken = Math.floor((endTime - startTime) / 1000);


            console.log(startTime);
            console.log(endTime);

            // Determine game result and update result message with a placeholder image
            const resultMessage = document.getElementById("resultMessage");

            hideLineNumber();

            // Set a placeholder image depending on win/lose status
            resultMessage.innerHTML = isGameOver
                ? '<img src="path/to/game-over-placeholder.png" alt="Game Over">'
                : '<img src="path/to/you-win-placeholder.png" alt="You Win">';

            // Update the score, time taken, and error elements
            document.getElementById("timeTaken").textContent = timeTaken;
            document.getElementById("globalScore").innerText = globalScore;
            document.getElementById("globalUserError").innerText = globalUserError;

            // Show the end panel
            delay(3000).then(() => {
                document.getElementById("endPanel").style.display = "flex";
            })
        }
        // If time reaches zero, stop the countdown
        if (timerSeconds < 0) {
            isGameOver = true;
            stopTimer();
        }
    }, 1000);
}
