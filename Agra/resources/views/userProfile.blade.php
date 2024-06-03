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
<div class="outerDiv flex flex-wrap flex-row bg-gradient-to-r from-blue-800 to-blue-600 min-h-auto pl-10 pr-10 pb-10">
    <!--Inner div-->
    <div class="innerDiv xl:flex bg-white h-full w-full rounded-xl overflow-hidden p-0 xl:p-5">

        <div class="left-panel flex flex-col bg-gray-200 h-full w-full p-5 xl:p-10 gap-y-10 rounded-xl shadow-xl">

            <div class="profile h-auto xl:flex flex-row items-start md:w-full bg-white rounded-xl shadwow-xl pl-10 pr-10 pt-10">
                <div class="image flex justify-center md:justify-start ml-10 mb-10">
                    <img class="rounded-full h-40 w-40 shadow-xl md:h-40 md:w-80" src="1.png" alt="image description">
                </div>

                <div class="details-container flex flex-col">

                    <div class="name-details ml-10 gap-x-10 xl:flex justify-between">
                        <div class="stuname-badge xl:flex xl:gap-10">
                          <div class="sec-username">
                            <div class="stuname flex justify-center md:justify-start">
                                <h1 class="text-4xl font-bold text-blue-800">{{$user->name}}</h1>
                                <span class="inline-flex items-center ml-5 justify-center w-9 h-9 me-2 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full dark:bg-gray-700 dark:text-blue-400">
                                  <svg class="w-10 h-10" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill="currentColor" d="m18.774 8.245-.892-.893a1.5 1.5 0 0 1-.437-1.052V5.036a2.484 2.484 0 0 0-2.48-2.48H13.7a1.5 1.5 0 0 1-1.052-.438l-.893-.892a2.484 2.484 0 0 0-3.51 0l-.893.892a1.5 1.5 0 0 1-1.052.437H5.036a2.484 2.484 0 0 0-2.48 2.481V6.3a1.5 1.5 0 0 1-.438 1.052l-.892.893a2.484 2.484 0 0 0 0 3.51l.892.893a1.5 1.5 0 0 1 .437 1.052v1.264a2.484 2.484 0 0 0 2.481 2.481H6.3a1.5 1.5 0 0 1 1.052.437l.893.892a2.484 2.484 0 0 0 3.51 0l.893-.892a1.5 1.5 0 0 1 1.052-.437h1.264a2.484 2.484 0 0 0 2.481-2.48V13.7a1.5 1.5 0 0 1 .437-1.052l.892-.893a2.484 2.484 0 0 0 0-3.51Z"/>
                                    <path fill="#fff" d="M8 13a1 1 0 0 1-.707-.293l-2-2a1 1 0 1 1 1.414-1.414l1.42 1.42 5.318-3.545a1 1 0 0 1 1.11 1.664l-6 4A1 1 0 0 1 8 13Z"/>
                                  </svg>
                                </span>
                            </div>

                            <div class="flex flex-col">
                              <div class="section flex justify-center md:justify-start">
                                <h2 class ="text-xl font-light text-blue-800">{{$user->name}}@example.com</h2>
                              </div>
                              <div class="section flex justify-center md:justify-start">
                                <h2 class ="text-2xl font-normal text-blue-800">{{$user->section->SectionCode}}</h2>
                              </div>
                            </div>
                          </div>

                            <div class="badge flex justify-center md:justify-start">
                                <span class="bg-blue-200 text-blue-800 text-xl font-medium me-2 px-2.5 py-0.5 rounded h-9">JAVA</span>
                                <span class="bg-blue-200 text-blue-800 text-xl font-medium me-2 px-2.5 py-0.5 rounded h-9">C#</span>
                            </div>
                        </div>

                        <div class="button mt-10 flex justify-center md:justify-start">
                            <a href="/profile" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xl px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Edit Profile</a>
                        </div>
                    </div>

                    <div class="bio ml-10 mt-10 mb-10 ">
                    <h1 class="text-2xl font-normal text-blue-800">Lorem ipsum dolor sit amet consectetur adipisicing elit. At praesentium doloribus earum suscipit inventore obcaecati itaque voluptate consectetur excepturi totam atque cumque blanditiis veritatis, corrupti repellendus. Tempora ex quae placeat?</h1>
                    </div>
                </div>

            </div>

            <div class="profile h-auto xl:flex flex-col md:w-full bg-white rounded-xl shadwow-xl p-10">

                <div class="title pb-9">
                    <h1 class="text-2xl font-bold text-blue-800">Enrolled Courses:</h1>
                </div>
                <div class="flex justify-end gap-5 bg-gray-200 shadow-inner rounded-xl p-10 flex-row-reverse flex-wrap">
                @foreach($courses as $course)
                  <a href="#" class="yt-vid w-96 h-80 focus:outline-none transition ease-in-out delay-150 hover:bg-blue-800 text-blue-800 hover:text-white  hover:-translate-y-1 hover:scale-110 duration-300 rounded-xl bg-white p-5">
                        <div class="h-4/5">
                            <img src="image-course.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                        </div>
                        <div class="h-1/5 flex">
                            <div class ="w-3/5">
                                <h1 class="font-bold text-2xl">{{$course->CourseName}}</h1>
                                <h3 class="font-normal text-base">{{$course->CourseDescription}}</h3>
                            </div>
                            <div class ="w-2/5 p-3 flex flex-row-reverse flex-wrap">
                                <div class="badge mb-2 ml-2">
                                    <span class="hover:bg-blue-800 hover:text-white bg-blue-200 text-blue-800 text-base font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 mb-3">{{$course->category->name}}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            <div class="flex gap-5">
                @foreach($courses as $course)
                <div class="profile h-auto xl:flex flex-row items-center md:w-1/4 bg-white rounded-xl shadwow-xl pl-10 pr-10 pt-10">

                    <div class="title pb-9">
                        <h1 class="text-xl font-bold text-blue-800">{{$course->CourseName}}</span></h1>
                    </div>

                </div>

                <div class="profile h-auto xl:flex flex-row items-center md:w-2/4 bg-white rounded-xl shadwow-xl pl-10 pr-10 pt-10">

                    <div class="title pb-9">
                        <h1 class="text-2xl font-bold text-blue-800">Description: <span class="font-light"> {{$course->CourseDescription}}</span></h1>
                    </div>

                </div>
                @endforeach
            </div>


            </div>
        </div>

    </div>

</div>


<script src = "{{asset('tailwindcharts/js/apexcharts.js')}}"></script>
<script src = "{{asset('tailwindcharts/js/flowbite.min.js')}}"></script>

</body>
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
</html>
