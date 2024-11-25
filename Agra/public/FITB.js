var progressIncrement;
let totalScore = 0;
let maxScore = 0;
let rounds = checkmarks.length;
let userErrors = 0;
let globalUserError = 0;
let globalCorrectAnswers;
let shaker = document.getElementById("coding-area");
let maxTime = checkmarks.length * timerSeconds; // Total maximum time allowed
let startTime; // Time when the user starts the task
let endTime; // Time when the user completes the task

checkmarks.forEach(checkmark => {
    maxScore += checkmark.points;
});

populateCheckmarks();
calculateMaxMonsterHealth(checkmarks.length);
progressIncrement = 9 / checkmarks.length;

var progressBar = document.querySelector(".progress-barc");
progressBar.style.opacity = "0";

var editor = ace.edit("code-editor");
editor.setTheme("ace/theme/one_dark");
editor.session.setMode("ace/mode/java");
editor.setShowPrintMargin(false);
editor.setAutoScrollEditorIntoView(true);
editor.resize();
editor.setOptions({
    fontSize: "20px",
});

editor.insert(template);

editor.getSession().selection.on('changeSelection', function (e)
{
    editor.getSession().selection.clearSelection();
});

editor.setReadOnly(true);

var content = document.getElementById("code");
content.innerHTML = editor.getValue();

hideLineNumber();

function populateCheckmarks() {
    checkmarks.forEach(checkmark => {
        var checkmarkDiv = document.createElement("div");
        var imgDiv = document.createElement("div");
        var checkmarkImg = document.createElement("img");

        imgDiv.style.height = "100px";
        imgDiv.style.width = "50px";
        imgDiv.style.marginLeft = "20px";
        imgDiv.style.marginRight = "30px";
        imgDiv.style.display = "flex";

        checkmarkImg.style.width = "50px";
        checkmarkImg.style.height = "50px";
        checkmarkImg.style.margin = "auto 0 ";
        checkmarkImg.style.margin = "auto 10px auto 0";
        checkmarkImg.id = "img" + checkmark.id;

        checkmarkDiv.classList.add("instruc-container");
        checkmarkImg.src = "/remove.png";
        checkmarkDiv.id = "instruction" + checkmark.id;
        checkmarkDiv.textContent = checkmark.instruction;
        checkmarkDiv.style.marginLeft = "10px";
        checkmarkDiv.style.backgroundColor = "#F3F8FF";
        checkmarkDiv.style.boxShadow = "0px 0px 10px 0px rgba(0,0,0,0.75)";
        checkmarkDiv.style.borderRadius = "10px";

        var parentDiv = document.getElementById("instructions");
        parentDiv.appendChild(checkmarkDiv);

        parentDiv.style.gridTemplateRows = "30px repeat(" + checkmarks.length + ", 1fr)";

        checkmarkDiv.style.display = "flex";
        checkmarkDiv.style.flexDirection = "row-reverse";
        checkmarkDiv.style.alignItems = "center";
        checkmarkDiv.style.justifyContent = "start";
        checkmarkDiv.appendChild(imgDiv);
        imgDiv.appendChild(checkmarkImg);

    });
}

function checkCheckmarks() {
    var index = 0;
    checkmarks.forEach(checkmark => {
        if (checkmark.done) {
            document.getElementById("img" + index).src = "/check-mark.png";
        } else {
            document.getElementById("img" + index).src = "/remove.png";
        }
        index++;
    });
}

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

function readonly_lines(id, content, line_numbers) {
    var readonly_ranges = [];
    for (var i = 0; i < line_numbers.length; i++) {
        readonly_ranges.push([line_numbers[i] - 1, 0, line_numbers[i], 0]);
    }
    console.log("ran")
    refresheditor(id, content, readonly_ranges);
}

function checkCodeByLine(editorLines) {
    var errorDetected = false; // Flag to track if an error is detected in the user's code
    var correctAnswers = 0;

    //this is to get the currentLine value the user is typing
    var currline = editor.getSelectionRange().start.row;
    var wholelinetxt = editor.session.getLine(currline);
    wholelinetxt = wholelinetxt.trim();

    var content = document.getElementById("code");
    content.innerHTML = editor.getValue();

    console.log("Line:" + wholelinetxt);

    if (wholelinetxt === checkmarks[currentCheckmark].answer.trim()) {

        //If answer is correct
        console.log("Answer:" + checkmarks[currentCheckmark].answer.trim())
        checkmarks[currentCheckmark].done = true;
        currentCheckmark++;
        checkCheckmarks();
        correctAnswers++;
        // Disable the lines marked as correct
        console.log(getCorrectLineNumbers())
        editor.insert("\n\n");
        readonly_lines("code-editor", content, getCorrectLineNumbers());

        delay(10).then(() => {
            editor.moveCursorTo(editor.getSelectionRange().start.row - 1, 0);
            editor.insert("        ");
        });



    } else {
        //If answer is wrong
        errorDetected = true; // Set the flag if an error is detected
        userErrors++;
        editor.find(wholelinetxt);
    }

    console.log("User Error:" + userErrors);




    // Update the checkmarks and score after each iteration
    checkCheckmarks();
    updateScore();

    globalCurrentCheckmark = currentCheckmark;
    globalCorrectAnswers = correctAnswers;
    globalUserError = userErrors;
}

function refresheditor(id, content, readonly) {
    set_readonly(editor, readonly);
}

function set_readonly(editor,readonly_ranges) {
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

    ranges.forEach(function(range){session.addMarker(range, "readonly-highlight");});
    session.setMode("ace/mode/java");
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

function answerEnable(){
    document.getElementById("userAnswer").disabled = false;
    document.getElementById("submit").disabled = false;
    document.getElementById("userAnswer").focus();
}

var tempCtr = 0;
function whenPlayerAttack(){
    if(tempCtr < checkmarks.length){
        if(checkmarks[tempCtr].done){ // Add condition to check if the monster is not attacking
            movePlayer(scene, answerEnable);
            tempCtr++;
            document.getElementById("userAnswer").disabled = true;
            document.getElementById("submit").disabled = true;
        }
    }
}

// editor.session.on('change', function (delta) {
//     //setEditorCode();
//     //checkCode();
//     var editorValue = editor.getValue();
//     var editorLines = editorValue.split("\n");
//
//     checkCodeByLine(editorLines);
//     whenPlayerAttack();
// });
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


function startIntervalTimer2(rounds, roundDuration, timerDuration) {
    let globalScore = 0;

    const timer = setInterval(() => {
        timerDuration--;
        document.getElementById("timer").innerHTML = timerDuration;
        if (timerDuration === 0) {
            clearInterval(timer);
            console.log("Time's up!");
        }
        if (globalScore === 100) {
            clearInterval(timer);
            clearInterval(roundTimer);
            document.getElementById("timer").innerHTML = "Done";
            showResetPanel();
        }
    }, 1000);

    const roundTimer = setInterval(() => {
        rounds--;
        console.log(rounds);
        //Monster Attack 2
        monsterTween.play();
        monster.play("punch", true);
        delay(400).then(() => player.play("dmg", true));
        if (rounds === 0) {
            clearInterval(timer);
            clearInterval(roundTimer);
            console.log("Done!");
            document.getElementById("timer").innerHTML = "Done";
            showResetPanel();
        }
        if (globalScore === 100) {
            clearInterval(timer);
            clearInterval(roundTimer);
            document.getElementById("timer").innerHTML = "Done";
            showResetPanel();
        }
    }, (roundDuration + 1) * 1000);
}

function startIntervalTimer(timeSec) {

    let time1 = timeSec;
    const timer1 = setInterval(function () {
        time1--;
        document.getElementById("timer").innerHTML = time1;
        if (time1 === 0) {
            clearInterval(timer1);
            console.log("Time's up!");
        }
        if(globalScore === 100){
            clearInterval(timer);
            clearInterval(timer1);
            document.getElementById("timer").innerHTML = "Done";
            showResetPanel();
        }
    }, 1000);

    const timer = setInterval(function () {

        let time = timeSec;
        const timer2 = setInterval(function () {
            document.getElementById("timer").innerHTML = time;
            time--;
            if (time === 0) {
                clearInterval(timer2);
            }
            if(globalScore === 100){
                clearInterval(timer);
                clearInterval(timer1);
                clearInterval(timer2);
                document.getElementById("timer").innerHTML = "Done";
                showResetPanel();
            }
        }, 1000);

        rounds--;
        console.log(rounds);
        //Monster Attack Animation Play
        monsterAttack(scene);
        if (rounds === 0) {
            clearInterval(timer);
            clearInterval(timer1);
            clearInterval(timer2);
            console.log("Done!");
            document.getElementById("timer").innerHTML = "Done";
            showResetPanel();
        }

        if(globalScore === 100){
            clearInterval(timer);
            clearInterval(timer1);
            clearInterval(timer2);
            document.getElementById("timer").innerHTML = "Done";
            showResetPanel();
        }
    }, (timeSec * 1000) + 1000);


}

function displayOutput(output) {
    //replace \n with <br>
    output = output.replace(/\n/g, "<br>");
    document.getElementById("output").innerHTML = output;
}


var startButton = document.getElementById("startButton");
startButton.style.zIndex = 100;

var clickEvent = (function() {
    if ('ontouchstart' in document.documentElement === true)
        return 'touchstart';
    else
        return 'click';
})();
startButton.addEventListener(clickEvent, () => {
    startGame();
});

function startGame(){
    showLineNumber();
    startButton.style.display = "none";
    document.getElementById("startPanel").style.display = "none";
    document.getElementById("overallObjective").style.display = "none";
    const intro = introJs();
    intro.start();
    intro.oncomplete(function() {
        startTime = Date.now();
        startIntervalTimer(timerSeconds);
    });

    intro.onexit(function() {
        startTime = Date.now();
        startIntervalTimer(timerSeconds);
    });
}

function showResetPanel() {
    console.log("Panel Displayed");

    endTime = Date.now();
    let timeTaken = Math.floor((endTime - startTime) / 1000);
    let timeLeft = Math.max(maxTime - timeTaken, 0); // Calculate the time left

    const endPanel = document.getElementById('endPanel');
    const endMessage = document.getElementById('endMessage');

    // Determine game result and update result message with a placeholder image
    const resultMessage = document.getElementById("resultMessage");
    const isGameOver = (rounds <= 0);1

    hideLineNumber();

    // Set a placeholder image depending on win/lose status
    resultMessage.innerHTML = isGameOver
        ? '<img src="/FITBAssets/FITBLose.png" alt="Game Over">'
        : '<img src="/FITBAssets/FITBWin.png" alt="You Win">';

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



    setTimeout(function() {
        submitScore(timeTaken, timeLeft);
    }, 1000);


    // Populate the objectives list dynamically
    const objectivesList = document.getElementById("objectivesList");
    objectivesList.innerHTML = '';  // Clear previous objectives

    checkmarks.forEach(checkmark => {
        const listItem = document.createElement("li");

        // Create checkmark or "X" based on 'done' status
        const icon = checkmark.done
            ? '<span class="text-green-500">✔</span>'
            : '<span class="text-red-500">✘</span>';

        listItem.innerHTML = `${icon} ${checkmark.objective}`;
        objectivesList.appendChild(listItem);
    });

    delay(3000).then( () => {
        document.getElementById("endPanel").style.display = "flex";
    });
}

function displayObjectiveWithAnimation(objective) {
    // Create a container for the notification if it doesn't exist
    let notificationContainer = document.getElementById("notification-container");
    if (!notificationContainer) {
        notificationContainer = document.createElement("div");
        notificationContainer.id = "notification-container";
        notificationContainer.style.position = "fixed";
        notificationContainer.style.top = "100px";
        notificationContainer.style.right = "45%";
        notificationContainer.style.zIndex = "9999";
        notificationContainer.style.pointerEvents = "none";
        document.body.appendChild(notificationContainer);
    }

    // Create the notification element
    const notification = document.createElement("div");
    notification.classList.add("notification");

    // Add content to the notification
    notification.innerHTML = `
        <div style="display: flex; align-items: center;">
            <div class="checkmark-animation" style="margin-right: 10px;">✔️</div>
            <div>${objective}</div>
        </div>
    `;

    // Apply styles for the notification
    notification.style.backgroundColor = "#E8F5E9"; // Light green background
    notification.style.color = "#2E7D32"; // Dark green text
    notification.style.padding = "10px 20px";
    notification.style.marginBottom = "10px";
    notification.style.border = "2px solid #4CAF50"; // Green border
    notification.style.borderRadius = "8px";
    notification.style.boxShadow = "0 4px 6px rgba(0, 0, 0, 0.1)";
    notification.style.fontFamily = "Arial, sans-serif";
    notification.style.fontSize = "14px";
    notification.style.animation = "fade-in-out 3s ease forwards";

    // Append to the container
    notificationContainer.appendChild(notification);

    // Remove notification after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

const styleSheet = document.createElement("style");
styleSheet.type = "text/css";
styleSheet.innerText = `
    @keyframes fade-in-out {
        0% {
            opacity: 0;
            transform: translateX(50px);
        }
        10% {
            opacity: 1;
            transform: translateX(0);
        }
        90% {
            opacity: 1;
            transform: translateX(0);
        }
        100% {
            opacity: 0;
            transform: translateX(50px);
        }
    }

    .checkmark-animation {
        font-size: 20px;
        color: #4CAF50; /* Green color for the checkmark */
        animation: scale-checkmark 0.5s ease;
    }

    @keyframes scale-checkmark {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1.5);
        }
        100% {
            transform: scale(1);
        }
    }
`;
document.head.appendChild(styleSheet);

function submitScore(timeTaken, timeLeft) {
    // Prepare the query parameters to send via axios
    const scoreData = {
        userid: document.getElementById('userid').value,
        taskid: document.getElementById('taskid').value,
        sectionid: document.getElementById('sectionid').value,
        score: totalScore, // Assuming 'totalScore' is the calculated score
        MaxScore: maxScore, // Assuming 'maxScore' is the maximum score
        Percentage: globalScore, // Assuming 'globalScore' is the percentage
        TaskStatus: 'Done', // Task status, adjust if needed
        errors: userErrors, // Assuming 'userErrors' is the number of errors
        timeTaken: timeTaken, // Time taken for the task
        timeLeft: timeLeft, // Time remaining for the task
    };

    // Construct the query string
    const queryString = new URLSearchParams(scoreData).toString();

    // Send data using axios GET request with query string
    axios.get("/score?" + queryString)
        .then(response => {
            // Handle success (you can display a success message or redirect)
            console.log("Score submitted successfully:", response.data);
        })
        .catch(error => {
            // Handle error (you can display an error message)
            console.error("Error submitting score:", error);
        });
}



function doneTaskStatus() {
    document.getElementById('TaskStatus').value = 'Done';
    //document.getElementById('taskStatusForm').submit();
}

function blankCalc(word){
    let blank = "";
    for(let i = 0; i< word.length; i++){
        blank += "_";
    }

    return blank;
}

function shakeTextBox(shaker) {
    let start = Date.now();
    let amplitude = 10;
    let duration = 250; // in milliseconds

    function shake() {
        let timePassed = Date.now() - start;

        let progress = timePassed / duration;
        let delta = amplitude * Math.sin(progress * Math.PI * 12);

        shaker.style.marginLeft = delta + 'px';

        if (timePassed < duration) {
            requestAnimationFrame(shake);
        } else {
            shaker.style.marginLeft = '0';
        }
    }

    shake();
}

function submitAnswer(){
    let userAnswer = document.getElementById('userAnswer').value;

    if(!monsterIsAttacking){ // Check if the monster is not attacking
        if(userAnswer === checkmarks[currentCheckmark].answer){
            editor.setReadOnly(false);
            editor.find(blankCalc(checkmarks[currentCheckmark].answer));
            editor.replace(checkmarks[currentCheckmark].answer);
            editor.setReadOnly(true);
            checkmarks[currentCheckmark].done = true;
            displayObjectiveWithAnimation(checkmarks[currentCheckmark].objective);
            currentCheckmark++;
            checkCheckmarks();
            document.getElementById('userAnswer').value = "";
            document.getElementById('userAnswer').focus();
            updateScore();
            whenPlayerAttack();
            // Scroll to the next checkmark div
            if (currentCheckmark < checkmarks.length) {
                var nextCheckmarkDiv = document.getElementById("instruction" + checkmarks[currentCheckmark].id);
                if (nextCheckmarkDiv) {
                    nextCheckmarkDiv.scrollIntoView({ behavior: "smooth", block: "center" });
                }
            }
        } else {
            userErrors++;
            document.getElementById('userAnswer').value = "";
            document.getElementById('userAnswer').focus();
            shakeTextBox(shaker);
        }
    } else {
        userErrors++;
        document.getElementById('userAnswer').value = "";
        document.getElementById('userAnswer').focus();
        shakeTextBox(shaker);
    }

    globalUserError = userErrors;
}

document.addEventListener('keydown', function(event) {
    if (event.key === "Enter") {
        submitAnswer();
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

function tryAgain() {
    submitScore(timeTaken, timeLeft);
    location.reload(); // Refresh the page to try again
}

function reset(){
    submitScore(timeTaken, timeLeft);
    window.location.href = '/';
}


