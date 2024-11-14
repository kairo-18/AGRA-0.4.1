<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="{{asset('tailwindcharts/css/flowbite.min.css')}}"/>
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
<div class="outerDiv flex flex-wrap flex-row bg-gradient-to-r from-blue-800 to-blue-600 min-h-auto">
    <!-- Inner div -->
    <div class="innerDiv flex xl:flex bg-white h-full w-full rounded-xl overflow-hidden p-0 xl:p-5">

        <!-- Left Panel -->
        <div class="left-panel flex flex-col bg-gray-200 h-full w-full p-5 xl:p-10 gap-y-10 rounded-xl shadow-xl">
            <!-- Profile Section -->
          <div class="profile h-auto xl:flex flex-col md:w-full bg-white rounded-xl shadow-xl p-10">
            <div class="relative w-full h-full">
                    <!-- Gradient Background Layer -->
                    <div class="absolute -top-10 md:-top-10 w-full h-full bg-gradient-to-r from-blue-400 to-blue-600 rounded-xl"></div>
                    <!-- Profile Image with Border -->
                    <img class="relative -right-40 md:-right-10 w-48 h-48 p-1 mb-4 rounded-full ring-2 ring-gray-300 dark:ring-gray-500" src="1.png" alt="Bordered avatar">
            </div>

                <div class="details-container flex flex-col">
                    <!-- Name and Badge Details -->
                    <div class="name-details ml-10 gap-x-10 xl:flex justify-between">
                        <div class="stuname-badge xl:flex xl:gap-10">
                            <div class="sec-username">
                                <div class="stuname flex justify-center md:justify-start">
                                    <h1 class="text-4xl font-bold text-blue-800">{{$user->name}}</h1>
                                    <span class="inline-flex items-center ml-5 justify-center w-9 h-9 me-2 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full dark:bg-gray-700 dark:text-blue-400">
                                        <svg class="w-10 h-10" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill="currentColor" d="M18.774 8.245l-.892-.893a1.5 1.5 0 0 1-.437-1.052V5.036a2.484 2.484 0 0 0-2.48-2.48H13.7a1.5 1.5 0 0 1-1.052-.438l-.893-.892a2.484 2.484 0 0 0-3.51 0l-.893.892a1.5 1.5 0 0 1-1.052.437H5.036a2.484 2.484 0 0 0-2.48 2.481V6.3a1.5 1.5 0 0 1-.438 1.052l-.892.893a2.484 2.484 0 0 0 0 3.51l.892.893a1.5 1.5 0 0 1 .437 1.052v1.264a2.484 2.484 0 0 0 2.481 2.481H6.3a1.5 1.5 0 0 1 1.052.437l.893.892a2.484 2.484 0 0 0 3.51 0l.893-.892a1.5 1.5 0 0 1 1.052-.437h1.264a2.484 2.484 0 0 0 2.481-2.48V13.7a1.5 1.5 0 0 1 .437-1.052l.892-.893a2.484 2.484 0 0 0 0-3.51Z"/>
                                            <path fill="#fff" d="M8 13a1 1 0 0 1-.707-.293l-2-2a1 1 0 1 1 1.414-1.414l1.42 1.42 5.318-3.545a1 1 0 0 1 1.11 1.664l-6 4A1 1 0 0 1 8 13Z"/>
                                        </svg>
                                    </span>
                                </div>

                                <div class="flex flex-col">
                                    <div class="section flex justify-center md:justify-start">
                                        <h2 class="text-xl font-light text-blue-800">{{$user->name}}@example.com</h2>
                                    </div>
                                    <div class="section flex justify-center md:justify-start">
                                        <h2 class="text-2xl font-normal text-blue-800">{{$user->section->SectionCode}}</h2>
                                    </div>
                                </div>
                            </div>

                            <!-- Badge Section -->
                            <div class="badge flex justify-center md:justify-start">
                                <span class="bg-blue-200 text-blue-800 text-xl font-medium me-2 px-2.5 py-0.5 rounded h-9">JAVA</span>
                                <span class="bg-blue-200 text-blue-800 text-xl font-medium me-2 px-2.5 py-0.5 rounded h-9">C#</span>
                            </div>
                        </div>

                        <!-- Edit Profile Button -->
                        <div class="button mt-10 flex justify-center md:justify-start">
                            <a href="/profile" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 text-center me-2 mb-5 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800 mr-5">Edit Profile</a>
                        </div>
                    </div>

                    
                </div>
          </div>
            <!-- Enrolled Courses Section -->
            <div class="profile h-auto xl:flex flex-col md:w-full bg-white rounded-xl shadow-xl p-10">
                <div class="title pb-9">
                    <h1 class="text-2xl font-bold text-blue-800">Enrolled Courses:</h1>
                </div>
                
                <div class="flex flex-wrap justify-end gap-5 bg-gray-200 shadow-inner rounded-xl p-10 flex-row-reverse flex-wrap">
                @foreach($courses as $course)
                    <a href="/courses/{{$course->id}}" class="yt-vid w-[18rem] h-[13rem] focus:outline-none transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bg-white shadow-md rounded-xl lesson-card">
                        <div class="h-full">
                            <div class="w-full h-full p-3 rounded-xl bg-cover bg-center bg-image shadow-md">
                                <h2 class="font-bold text-xs text-white mb-10">Courses</h2>
                                <h1 class="font-bold text-lg text-white">{{$course->CourseName}}</h1>
                                <h3 class="font-medium text-xs text-gray-200 line-clamp">{{$course->CourseDescription}}</h3>
                            </div>
                        </div>
                    </a>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


    </div>

</div>


<script src = "{{asset('tailwindcharts/js/apexcharts.js')}}"></script>
<script src = "{{asset('tailwindcharts/js/flowbite.min.js')}}"></script>

</body>

<script>
    // Array of background images
    const backgroundImages = [
        'bg-course1.png', 'bg-course2.png', 'bg-course3.png', 
        'bg-course4.png', 'bg-course5.png', 'bg-course6.png', 'bg-course7.png'
    ];

    // Shuffle the array to randomize the images
    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    // Shuffle images
    shuffleArray(backgroundImages);

    // Get all lesson cards
    const lessonCards = document.querySelectorAll('.lesson-card .bg-image');

    // Keep track of the last used image
    let lastUsedImage = null;

    lessonCards.forEach((card, index) => {
        // Ensure no two consecutive lessons get the same image
        let currentImage = backgroundImages[index % backgroundImages.length];
        if (currentImage === lastUsedImage) {
            currentImage = backgroundImages[(index + 1) % backgroundImages.length];
        }

        // Set the background image
        card.style.backgroundImage = `url(${currentImage})`;

        // Update the last used image
        lastUsedImage = currentImage;
    });
</script>
<script>

const options = {
// add data series via arrays, learn more here: https://apexcharts.com/docs/series/
    series: [
    {
        name: "Weekly Task",
        data: [70, 0, 70, 0, 70, 0],
        color: "#1A56DB",
    },
    {
        name: "Student Weekly Task",
        data: [0, 70, 0, 70, 0, 70],
        color: "#7E3BF2",
    },
    ],
    chart: {
    height: "100%",
    maxWidth: "100%",
    type: "area",
    fontFamily: "Inter, sans-serif",
    dropShadow: {
        enabled: false,
    },
    toolbar: {
        show: false,
    },
    },
    tooltip: {
    enabled: true,
    x: {
        show: false,
    },
    },
    legend: {
    show: true
    },
    fill: {
    type: "gradient",
    gradient: {
        opacityFrom: 0.55,
        opacityTo: 0,
        shade: "#1C64F2",
        gradientToColors: ["#1C64F2"],
    },
    },
    dataLabels: {
    enabled: false,
    },
    stroke: {
    width: 6,
    },
    grid: {
    show: false,
    strokeDashArray: 4,
    padding: {
        left: 2,
        right: 2,
        top: -26
    },
    },
    xaxis: {
    categories: ['01 February', '02 February', '03 February', '04 February', '05 February', '06 February', '07 February'],
    labels: {
        show: false,
    },
    axisBorder: {
        show: false,
    },
    axisTicks: {
        show: false,
    },
    },
    yaxis: {
    show: false,
    labels: {
        formatter: function (value) {
        return value + '%';
        }
    }
    },
}

if (document.getElementById("legend-chart") && typeof ApexCharts !== 'undefined') {
const chart = new ApexCharts(document.getElementById("legend-chart"), options);
chart.render();
}


const options2 = {
// set this option to enable the tooltip for the chart, learn more here: https://apexcharts.com/docs/tooltip/
tooltip: {
  enabled: true,
  x: {
    show: true,
  },
  y: {
    show: true,
  },
},
grid: {
  show: false,
  strokeDashArray: 4,
  padding: {
    left: 2,
    right: 2,
    top: -26
  },
},
series: [
  {
    name: "Weekly Task",
    data: [1500, 1418, 1456, 1526, 1356, 1256],
    color: "#1A56DB",
  },
  {
    name: "Student Weekly Task",
    data: [643, 413, 765, 412, 1423, 1731],
    color: "#7E3BF2",
  },
],
chart: {
  height: "100%",
  maxWidth: "100%",
  type: "area",
  fontFamily: "Inter, sans-serif",
  dropShadow: {
    enabled: false,
  },
  toolbar: {
    show: false,
  },
},
legend: {
  show: true
},
fill: {
  type: "gradient",
  gradient: {
    opacityFrom: 0.55,
    opacityTo: 0,
    shade: "#1C64F2",
    gradientToColors: ["#1C64F2"],
  },
},
dataLabels: {
  enabled: false,
},
stroke: {
  width: 6,
},
xaxis: {
  categories: ['01 February', '02 February', '03 February', '04 February', '05 February', '06 February', '07 February'],
  labels: {
    show: false,
  },
  axisBorder: {
    show: false,
  },
  axisTicks: {
    show: false,
  },
},
yaxis: {
  show: false,
  labels: {
    formatter: function (value) {
      return value + '%';
    }
  }
},
}

if (document.getElementById("tooltip-chart") && typeof ApexCharts !== 'undefined') {
const chart = new ApexCharts(document.getElementById("tooltip-chart"), options2);
chart.render();
}

</script>
<script>
    const sectionId = "{{$user->section->id}}";
    const username = "{{Auth::user()->name}}";
</script>
<script src="agraNotification.js"></script>
</html>
