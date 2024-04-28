var progressIncrement;
let totalScore;
let maxScore = 0;


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



function checkCodeByLine(editorLines) {
    var currentCheckmark = 0;

    if (!(currentCheckmark === checkmarks.length)) {

        editorLines.forEach(line => {
            if (currentCheckmark < checkmarks.length) {
                if (line.includes(checkmarks[currentCheckmark].answer)) {
                    checkmarks[currentCheckmark].done = true;
                    checkCheckmarks();
                    console.log(checkmarks);
                    console.log(currentCheckmark);
                    currentCheckmark++;
                }
            }
        });

    }

    editorLines.forEach(line => {
        if (currentCheckmark < checkmarks.length) {
            if (!(line.includes(checkmarks[currentCheckmark].answer))) {
                checkmarks[currentCheckmark].done = false;
                checkCheckmarks();
            }

        }

    });

    updateScore();
}

var tempCtr = 0;
function whenPlayerAttack(people) {
    if (tempCtr < checkmarks.length) {
        if (checkmarks[tempCtr].done) {
            fireBullet(scene);
            tempCtr++;
        }
    }
}


editor.session.on('change', function (delta) {
    //setEditorCode();
    //checkCode();
    var editorValue = editor.getValue();
    var editorLines = editorValue.split("\n");

    checkCodeByLine(editorLines);
    whenPlayerAttack();
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
        //monster attack
        triggerRandomAttack();
        delay(600).then( () => shakeCamera(scene));

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
    score2.textContent = globalScore + "%";
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
