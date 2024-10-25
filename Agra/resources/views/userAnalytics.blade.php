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
                        <h1 class="text-3xl font-bold text-blue-800">Overall Accuracy: <br>{{ number_format($overallAccuracy, 2) }} %</h1>
                    </div>
                </div>

                <div class="profile h-auto xl:flex flex-row items-center md:w-2/4 bg-white rounded-xl shadwow-xl pl-10 pr-10 pt-10">
                    <div class="title pb-9">
                        <h1 class="text-3xl font-bold text-blue-800">Overall Speed: <br>{{ number_format($overallSpeed, 2) }} %</h1>
                    </div>
                </div>

                <div class="profile h-auto xl:flex flex-row items-center md:w-2/4 bg-white rounded-xl shadwow-xl pl-10 pr-10 pt-10">
                    <div class="title pb-9">
                        <h1 class="text-3xl font-bold text-blue-800">Overall Performance: <br>{{ number_format($overallPerformance, 2) }} %</h1>
                    </div>
                </div>

            </div>

            <div class="Analytics h-auto flex flex-col xl:flex-row flex-wrap">


                <!-- Add the Coding Accuracy and Coding Speed sections for both Java and C# -->
                <div class="java-coding-accuracy w-full xl:w-2/4 p-10">
                    <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="flex justify-between mb-5">
                            <div>
                                <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">JAVA Coding Accuracy</h5>
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
                                <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">C# Coding Accuracy</h5>
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

                <div class="java-score w-full xl:w-2/4 p-10">
                    <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="flex justify-between mb-5">
                            <div>
                                <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">JAVA Scores</h5>
                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Speed this week</p>
                            </div>
                            <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                                Time based

                            </div>
                        </div>
                        <div id="java-score-chart"></div>
                    </div>
                </div>

                <div class="csharp-score w-full xl:w-2/4 p-10">
                    <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="flex justify-between mb-5">
                            <div>
                                <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">C# Scores</h5>
                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Speed this week</p>
                            </div>
                            <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                                Time based

                            </div>
                        </div>
                        <div id="csharp-score-chart"></div>
                    </div>
                </div>

                <div class="java-coding-speed w-full xl:w-4/4 p-10">
                    <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="flex justify-between mb-5">
                            <div>
                                <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">Lesson Analytics</h5>
                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Advanced stats</p>
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





    document.addEventListener("DOMContentLoaded", function() {

        function formatDataToInteger(data) {
            return data.map(value => Math.round(value));
        }

        // Java Coding Accuracy Chart
        var optionsJavaErrors = {
            series: [{
                name: 'Java Accuracy',
                data: formatDataToInteger(@json($taskJavaAccuracy))
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
                data: formatDataToInteger(@json($taskCsharpAccuracy))
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
                data: formatDataToInteger(@json($taskJavaSpeed))
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
                data: formatDataToInteger(@json($taskCsharpSpeed))
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

        // Java Scores Chart
        var options7 = {
            series: [{
                name: 'Java Scores',
                data: formatDataToInteger(@json($taskJavaScore))
            }],
            chart: {
                height: 350,
                type: 'line'
            },
            title: {
                text: 'Java Scores'
            },
            xaxis: {
                categories: taskData.Java.categories
            }
        };
        var chart7 = new ApexCharts(document.querySelector("#java-score-chart"), options7);
        chart7.render();

        // C# Scores Chart
        var options8 = {
            series: [{
                name: 'C# Scores',
                data: formatDataToInteger(@json($taskCsharpScore))
            }],
            chart: {
                height: 350,
                type: 'line'
            },
            title: {
                text: 'C# Scores'
            },
            xaxis: {
                categories: taskData['C#'].categories
            }
        };
        var chart8 = new ApexCharts(document.querySelector("#csharp-score-chart"), options8);
        chart8.render();

        console.log(lessonData);

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
                performanceParagraph.textContent = `Overall Performance: ${lessonData[key].overall_performance.toFixed(2)}`;
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
                            data: formatDataToInteger(lessonData[key].accuracy)
                        },
                        {
                            name: 'Speed',
                            data: formatDataToInteger(lessonData[key].speed)
                        },
                        {
                            name: 'Score',
                            data: formatDataToInteger(lessonData[key].score)
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
<script>
    const sectionId = "{{$user->section->id}}";
    const username = "{{Auth::user()->name}}";
</script>
<script src="agraNotification.js"></script>
</body>
</html>
