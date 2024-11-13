var progressIncrement;
let totalScore = 0;
let maxScore = 0;
let globalScore = 0;

populateCheckmarks();
progressIncrement = 9 / checkmarks.length;
calculateMaxMonsterHealth(checkmarks.length);

var progressBar = document.querySelector(".progress-barc");
progressBar.style.opacity = "0";  // Start with opacity 0 (invisible)

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
let lastScrolledCheckmark = -1;
editor.moveCursorTo(2, 8);
scrollToCheckmark(0);

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

// Function to extract keywords from code
function extractKeywords(code) {
    let words = code.split(/\s+|(?<=[^\w\s])|(?=[^\w\s])/g).filter(Boolean);
    return removeNonWords(words);
}

function delay(time) {
    return new Promise(resolve => setTimeout(resolve, time));
}

// Filter only words, removing non-words
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

// Define a map to keep track of whether each checkmark has already been processed
var checkmarkProcessed = {};

function updateScore() {
    let score = 0;
    let scorePercentage = 0;
    maxScore = 0;

    checkmarks.forEach(checkmark => {
        if (checkmark.done) {
            score += checkmark.points;
        }

        if (checkmark.done && !checkmarkProcessed[checkmark.answer]) {
            axios.post('/checkmarkComplete', {
                user: document.getElementById('username').value,
                code: checkmark.answer,
                points: '10'
            })
            .then(function(response) {
                console.log(response);
            })
            .catch(function(error) {
                console.log(error);
            });

            editor.setReadOnly(true);
            delay(1000).then( () => {editor.setReadOnly(false)});
            // Mark the checkmark as processed
            checkmarkProcessed[checkmark.answer] = true;
        }
    });

    // Calculate max score
    checkmarks.forEach(checkmark => {
        maxScore += checkmark.points;
    });

    // Calculate score percentage
    if (maxScore > 0) {
        scorePercentage = Math.floor((score / maxScore) * 100);
    }

    // Update global score and total score
    globalScore = scorePercentage;
    totalScore = score;

    // Update score display in HTML
    document.getElementById("score").innerHTML = score;

    // Update the progress bar width based on score percentage
    var progressBarWidth = scorePercentage + "%";
    progressBar.style.width = progressBarWidth;

    // Show progress bar if the score is more than 0
    if (score > 0) {
        progressBar.style.opacity = "1";  // Make the progress bar visible
    } else {
        progressBar.style.opacity = "0";  // Hide the progress bar when score is 0
    }
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
                    scrollToCheckmark(currentCheckmark);
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

    if(globalScore === 100){
        delay(1500).then(() => {
            document.getElementById("winModal").classList.remove("hidden");
            document.getElementById("finalScore").textContent = globalScore;
        });
    }
}

var tempCtr = 0;
function whenPlayerAttack(){

    if(tempCtr < checkmarks.length){
        if(checkmarks[tempCtr].done){
            playerMove(scene);
            delay(400).then(() => monster.play("dmg", true));
            tempCtr++;
        }
    }
}
function scrollToCheckmark(index) {
    // Only scroll if the current checkmark index has changed
    if (index !== lastScrolledCheckmark) {
        // Get the checkmark element by ID
        var checkmarkElement = document.getElementById("instruction" + index);

        // If the element exists, scroll it into view
        if (checkmarkElement) {
            checkmarkElement.scrollIntoView({
                behavior: "smooth", // Smooth scroll
                block: "center"     // Center the element in the viewport
            });
            // Update the last scrolled checkmark
            lastScrolledCheckmark = index;
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
        }

        if(globalScore === 100){
            clearInterval(timer);
            clearInterval(timer1);
            clearInterval(timer2);
            document.getElementById("timer").innerHTML = "Done";
        }
    }, 11000);


}

function displayOutput(output) {
    //replace \n with <br>
    output = output.replace(/\n/g, "<br>");
    document.getElementById("output").innerHTML = output;
}


var startButton = document.getElementById("startButton");


function startGame(){
    document.getElementById("blurPanel").style.display = "none";
    startButton.style.display = "none";
    document.getElementById("startPanel").style.display = "none";

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


function reset(){
    window.location.href = '/';
}
