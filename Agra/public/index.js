var progressIncrement;
let totalScore;
let maxScore = 0;
let userErrors = 0;
let globalUserError = 0;
let globalCorrectAnswers;


populateCheckmarks();
progressIncrement = 9 / checkmarks.length;

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

editor.insert(`public class myClass{
    public static void main(String[] args){


    }
}`);

editor.moveCursorTo(2, 8)


function populateCheckmarks() {
    checkmarks.forEach(checkmark => {
        var checkmarkDiv = document.createElement("div");
        var imgDiv = document.createElement("div");
        var checkmarkImg = document.createElement("img");


        imgDiv.style.height = "100px";
        imgDiv.style.width = "50px";
        imgDiv.style.marginLeft = "10px";
        imgDiv.style.borderLeft = "1px solid black";
        imgDiv.style.display = "flex";

        checkmarkImg.src = "/remove.png";
        checkmarkImg.style.width = "50px";
        checkmarkImg.style.height = "50px";
        checkmarkImg.style.margin = "auto 0 ";
        checkmarkImg.id = "img" + checkmark.id;


        checkmarkDiv.classList.add("instruc-container");
        checkmarkDiv.id = "instruction" + checkmark.id;
        checkmarkDiv.textContent = checkmark.instruction;
        checkmarkDiv.style.backgroundColor = "#F3F8FF";
        checkmarkDiv.style.boxShadow = "0px 0px 10px 0px rgba(0,0,0,0.75)";
        checkmarkDiv.style.borderRadius = "10px";

        var parentDiv = document.getElementById("instructions");
        parentDiv.appendChild(checkmarkDiv);

        parentDiv.style.gridTemplateRows = "30px repeat(" + checkmarks.length + ", 1fr)";

        checkmarkDiv.style.display = "flex";
        checkmarkDiv.style.alignItems = "center";
        checkmarkDiv.style.justifyContent = "end";
        imgDiv.appendChild(checkmarkImg);
        checkmarkDiv.appendChild(imgDiv);
    });
}

function checkCheckmarks() {
    var index = 0;
    checkmarks.forEach(checkmark => {
        if (checkmark.done) {
            document.getElementById("img" + index).src = "/check-mark.png";
        } else {
            document.getElementById("img" + index).src = "/remove.png"
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

var tempCtr = 0;
function whenPlayerAttack(){

    if(tempCtr < checkmarks.length){
        if(checkmarks[tempCtr].done){
            playerTween.play();
            player.play("punch", true);
            delay(400).then(() => monster.play("dmg", true));
            tempCtr++;
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

document.addEventListener('keydown', function(event) {
    if (event.ctrlKey) {
        var editorValue = editor.getValue();
        var editorLines = editorValue.split("\n");
        var initialErrors = userErrors;

        checkCodeByLine(editorLines);
        whenPlayerAttack();


    }
});

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

function startIntervalTimer() {

    let time1 = 10;
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

    let rounds = 5;
    const timer = setInterval(function () {

        let time = 10;
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
        monsterTween.play();
        monster.play("punch", true);
        delay(400).then(() => player.play("dmg", true));

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
    }, 11000);


}





function displayOutput(output) {
    //replace \n with <br>
    output = output.replace(/\n/g, "<br>");
    document.getElementById("output").innerHTML = output;
}


var startButton = document.getElementById("startButton");

document.querySelector(".container1").style.pointerEvents = "none";
document.querySelector(".container1").style.filter = "blur(3px)";

function startGame(){
    startButton.style.display = "none";
    document.getElementById("startPanel").style.display = "none";
    document.querySelector(".container1").style.pointerEvents = "auto";
    document.querySelector(".container1").style.filter = "blur(0px)";
    startIntervalTimer();
}




function showResetPanel(){
    var endPanel = document.getElementById("endPanel");
    var score2 = document.getElementById("score2");
    endPanel.style.display = "block";
    score2.innerHTML = globalScore + "% </br> " + "Errors: " + globalUserError;
    setTimeout(function(){
        submitScore();
    }, 2000);

}


function submitScore(){
    document.getElementById('TotalScore').value = totalScore;
    document.getElementById('MaxScore').value = maxScore;
    document.getElementById('Percentage').value = globalScore;
    document.getElementById('TaskStatus').value = 'Done';
    document.getElementById("scoreForm").submit();
}

function doneTaskStatus() {
    document.getElementById('TaskStatus').value = 'Done';
    //document.getElementById('taskStatusForm').submit();
}


function reset(){
    window.location.href = '/';
}


