<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <script src="{{asset('js/app.js')}}"></script>
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
<div class="outerDiv flex flex-wrap flex-row bg-gradient-to-r from-blue-800 to-blue-600 min-h-auto pl-10 pr-10 pb-10">
    <!--Inner div-->
    <div class="innerDiv xl:flex bg-white h-full w-full rounded-xl overflow-hidden p-5 xl:p-20">

        <div class="left-panel flex flex-col bg-gray-100 h-full w-full p-5 xl:p-20 gap-y-10 rounded-xl shadow-xl">

            <div class="profile h-auto xl:flex flex-row items-center md:w-full bg-white rounded-xl shadwow-xl pl-10 pr-10 pt-10">

                <div class="title pb-9">
                    <h1 class="text-4xl font-bold text-blue-800">Analytics </h1>
                </div>
            </div>

            <div class="flex gap-5">
                <div class="profile h-auto xl:flex flex-row items-center md:w-2/4 bg-white rounded-xl shadwow-xl pl-10 pr-10 pt-10">

                    <div class="title pb-9">
                        <h1 class="text-3xl font-bold text-blue-800">Overall Accuracy: <span class="overallAccuracy"></span></h1>
                    </div>

                </div>

                <div class="profile h-auto xl:flex flex-row items-center md:w-2/4 bg-white rounded-xl shadwow-xl pl-10 pr-10 pt-10">

                    <div class="title pb-9">
                        <h1 class="text-3xl font-bold text-blue-800">Overall Speed: <span id="overallSpeed"></span></h1>
                    </div>

                </div>
            </div>

            <div class="Analytics h-auto flex flex-col xl:flex-row flex-wrap">


                <!-- Add the Coding Accuracy and Coding Speed sections for both Java and C# -->
                <div class="java-coding-accuracy w-full xl:w-2/4 p-10">
                    <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="flex justify-between mb-5">
                            <div>
                                <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">JAVA Coding Error Frequency</h5>
                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Accuracy this week</p>
                            </div>
                            <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                                95%
                                <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
                                </svg>
                            </div>
                        </div>
                        <div id="java-coding-accuracy-chart"></div>
                    </div>
                </div>

                <div class="csharp-coding-accuracy w-full xl:w-2/4 p-10">
                    <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="flex justify-between mb-5">
                            <div>
                                <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">C# Coding Error Frequency</h5>
                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Accuracy this week</p>
                            </div>
                            <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                                88%
                                <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
                                </svg>
                            </div>
                        </div>
                        <div id="csharp-coding-accuracy-chart"></div>
                    </div>
                </div>

                <div class="java-coding-speed w-full xl:w-2/4 p-10">
                    <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="flex justify-between mb-5">
                            <div>
                                <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">JAVA Coding Speed</h5>
                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Speed this week</p>
                            </div>
                            <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                                Time based

                            </div>
                        </div>
                        <div id="java-coding-speed-chart"></div>
                    </div>
                </div>

                <div class="csharp-coding-speed w-full xl:w-2/4 p-10">
                    <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="flex justify-between mb-5">
                            <div>
                                <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">C# Coding Speed</h5>
                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Speed this week</p>
                            </div>
                            <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                                Time based

                            </div>
                        </div>
                        <div id="csharp-coding-speed-chart"></div>
                    </div>
                </div>

                <div class="java-coding-speed w-full xl:w-4/4 p-10">
                    <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="flex justify-between mb-5">
                            <div>
                                <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">Lesson Analytics</h5>
                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Speed this week</p>
                            </div>
                            <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                                Time based
                            </div>
                        </div>
                        <div id="java-lesson-performances-container"></div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<!--=====================================End outerDiv/MainDiv=====================================-->


<script>
    var taskData = @json($taskData); //this is the data of all the tasks: errors, timeTaken, timeLeft, maxScore, score
    let lessonData = @json($lessonPerformance);
    let taskJavaAccuracy = [];
    let taskCsharpAccuracy = [];
    let taskJavaCodingSpeed = [];
    let taskCsharpCodingSpeed = [];

    let totalJavaTasks = taskData.Java.categories.length;
    let totalCSharpTasks = taskData['C#'].categories.length;
    let totalTasks = totalJavaTasks + totalCSharpTasks;
    let overallAccuracy = 0;
    let overallSpeed = 0;



    // // Function to calculate accuracy considering errors
    // function calculateAccuracy(score, maxScore, errors) {
    //     // Determine the penalty for errors (adjust as needed)
    //     let errorPenalty = 4; // For example, each error deducts 4 points from the accuracy
    //
    //     // Calculate adjusted correctness by deducting penalty for errors
    //     let correctedScore = score * 100;
    //     correctedScore -= (errors * errorPenalty);
    //
    //     // Ensure corrected score doesn't go below 0
    //     correctedScore = Math.max(correctedScore, 0);
    //
    //     // Calculate accuracy
    //     let accuracy = Math.round(correctedScore / maxScore);
    //     return accuracy;
    // }
    //
    //
    // function calculateCodingSpeed(timeLeft, timeTaken) {
    //     // Ensure timeLeft and timeTaken are non-negative
    //     timeLeft = Math.max(timeLeft, 0);
    //     timeTaken = Math.max(timeTaken, 0);
    //
    //     // Calculate total time spent coding
    //     let totalTime = timeTaken + timeLeft;
    //
    //     // Calculate coding speed as a percentage of remaining time relative to total time
    //     let codingSpeed = (timeLeft / totalTime) * 100;
    //
    //     return Math.round(codingSpeed);
    // }


    // Function to calculate accuracy considering errors
    function calculateAccuracy(score, maxScore, errors, errorPenaltyPercent = 1.5) {
        // Calculate the base accuracy as a percentage
        let baseAccuracy = (score / maxScore) * 100;

        // Calculate the penalty per error as a percentage
        let errorPenalty = errorPenaltyPercent * errors;

        // Calculate adjusted accuracy by deducting the penalty for errors
        let adjustedAccuracy = baseAccuracy - errorPenalty;

        // Ensure adjusted accuracy doesn't go below 0
        adjustedAccuracy = Math.max(adjustedAccuracy, 0);

        // Round the accuracy to two decimal places for precision
        adjustedAccuracy = Math.round(adjustedAccuracy * 100) / 100;

        return adjustedAccuracy;
    }

    function calculateCodingSpeed(timeLeft, timeTaken) {
        // Ensure timeLeft and timeTaken are non-negative
        timeLeft = Math.max(timeLeft, 0);
        timeTaken = Math.max(timeTaken, 0);

        // Calculate total time spent coding
        let totalTime = timeTaken + timeLeft;

        // Check if the user has more than 50% of time left
        if (timeLeft / totalTime > 0.5) {
            return 5; // Set coding speed to 5
        } else {
            // Calculate the percentage of time left
            let percentageTimeLeft = (timeLeft / totalTime) * 100;

            // Calculate rating based on percentage of time left
            let rating = Math.max(1, percentageTimeLeft / 10) * 20;

            return parseFloat(rating.toFixed(1));
        }
    }


    console.log(taskData['C#'])



    // Iterate through Java tasks
    taskData.Java.score.forEach((score, index) => {
        let accuracy = calculateAccuracy(score, taskData.Java.maxScore[index], taskData.Java.errors[index]);
        taskJavaAccuracy.push(accuracy);
        overallAccuracy += accuracy;
    });

    // Iterate through C# tasks
    taskData['C#'].score.forEach((score, index) => {
        let accuracy = calculateAccuracy(score, taskData['C#'].maxScore[index], taskData['C#'].errors[index]);
        taskCsharpAccuracy.push(accuracy);
        overallAccuracy += accuracy;
    });

    overallAccuracy = overallAccuracy / totalTasks;

    document.querySelector('.overallAccuracy').textContent = overallAccuracy.toFixed(2) + '%';


    taskData.Java.timeLeft.forEach((timeLeft, index) => {
        let speed = calculateCodingSpeed(timeLeft, taskData.Java.timeTaken[index]);
        taskJavaCodingSpeed.push(speed);
        overallSpeed += speed;
    });

    taskData['C#'].timeLeft.forEach((timeLeft, index) => {
        let speed = calculateCodingSpeed(timeLeft, taskData['C#'].timeTaken[index]);
        taskCsharpCodingSpeed.push(speed);
        overallSpeed += speed;
    });


    overallSpeed = overallSpeed / totalTasks;
    document.querySelector('#overallSpeed').textContent = overallSpeed.toFixed(2) + '*';


    document.addEventListener("DOMContentLoaded", function() {

        // Java Coding Accuracy Chart
        var optionsJavaErrors = {
            series: [{
                name: 'Java Accuracy',
                data: taskJavaAccuracy
            }],
            chart: {
                height: 350,
                type: 'line'
            },
            title: {
                text: 'Java Task Accuracy'
            },
            xaxis: {
                categories: taskData.Java.categories
            },
        };
        var chart3 = new ApexCharts(document.querySelector("#java-coding-accuracy-chart"), optionsJavaErrors);
        chart3.render();

        // C# Coding Accuracy Chart
        var optionsCsharpErrors = {
            series: [{
                name: 'C# Accuracy',
                data: taskCsharpAccuracy
            }],
            chart: {
                height: 350,
                type: 'line'
            },
            title: {
                text: 'C# Task Accuracy'
            },
            xaxis: {
                categories: taskData['C#'].categories
            },
        };
        var chart4 = new ApexCharts(document.querySelector("#csharp-coding-accuracy-chart"), optionsCsharpErrors);
        chart4.render();


        // Java Coding Speed Chart
        var options5 = {
            series: [{
                name: 'Java Coding Speed',
                data: taskJavaCodingSpeed
            }],
            chart: {
                height: 350,
                type: 'line'
            },
            title: {
                text: 'Java Coding Speed'
            },
            xaxis: {
                categories: taskData.Java.categories
            }
        };
        var chart5 = new ApexCharts(document.querySelector("#java-coding-speed-chart"), options5);
        chart5.render();

        // C# Coding Speed Chart
        var options6 = {
            series: [{
                name: 'C# Coding Speed',
                data: taskCsharpCodingSpeed
            }],
            chart: {
                height: 350,
                type: 'line'
            },
            title: {
                text: 'C# Coding Speed'
            },
            xaxis: {
                categories: taskData['C#'].categories
            }
        };
        var chart6 = new ApexCharts(document.querySelector("#csharp-coding-speed-chart"), options6);
        chart6.render();

        console.log(lessonData)



            const container = document.querySelector("#java-lesson-performances-container");

            let index = 0;

            for (const key in lessonData) {
                if (lessonData.hasOwnProperty(key)) {
                    console.log(`${key}: ${lessonData[key].overall_performance}`);

                    // Create a new div for each lesson
                    const lessonDiv = document.createElement('div');
                    lessonDiv.style.marginBottom = '20px'; // Add some spacing between lessons
                    container.appendChild(lessonDiv);

                    // Add the custom title div
                    const titleDiv = document.createElement('div');
                    titleDiv.innerHTML = `Course: ${lessonData[key].course_name} <br> Lesson: ${key} <br> ${lessonData[key].course_category_name}`;
                    titleDiv.style.fontSize = '24px';
                    titleDiv.style.fontWeight = 'bold';
                    titleDiv.style.color = '#263238';
                    lessonDiv.appendChild(titleDiv);

                    // Add overall performance
                    const performanceParagraph = document.createElement('p');
                    performanceParagraph.textContent = `Overall Performance: ${lessonData[key].overall_performance}`;
                    performanceParagraph.style.fontWeight = 'bold';
                    lessonDiv.appendChild(performanceParagraph);

                    // Create a new div for each chart
                    const chartDiv = document.createElement('div');
                    chartDiv.id = `java-lesson-performance-chart-${index}`;
                    lessonDiv.appendChild(chartDiv);

                    var options7 = {
                        series: [
                            {
                                name: 'Accuracy',
                                data: lessonData[key].accuracy
                            },
                            {
                                name: 'Speed',
                                data: lessonData[key].speed
                            }
                        ],
                        chart: {
                            height: 350,
                            type: 'line'
                        },
                        title: {
                            text: '', // Leave this empty since we're handling the title outside
                        },
                        xaxis: {
                            categories: lessonData[key].accuracy.map((_, i) => 'Attempt: ' + (i + 1)),
                        }
                    };

                    var chart7 = new ApexCharts(document.querySelector(`#java-lesson-performance-chart-${index}`), options7);
                    chart7.render();
                }

                index++;
            }
    });
</script>
</body>
</html>
