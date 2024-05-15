<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agra Courses</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <script src="{{asset('js/app.js')}}"></script>

</head>
<body>
<!--=====================================Start Navbar=====================================-->
<nav class="bg-gradient-to-r from-blue-700 to-blue-500 border-gray-200 dark:bg-gray-900">
    <div class="w-full flex flex-wrap items-center justify-between  p-5">

        <!---------Start Menu btn-------------->
        <div class ="btn-menu flex flex-row justify-start w-1/3">
            <button class="text-black bg-blue-200 hover:bg-blue-200 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation">
                =
            </button>
        </div>

        <!---------End Menu btn-------------->

        <!-- ---------Start Drawer Menu----------------->
        <div id="drawer-navigation" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-64 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-navigation-label">
            <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">Menu</h5>
            <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close menu</span>
            </button>

            <div class="py-4 overflow-y-auto">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                            </svg>
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                                <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
                            </svg>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">E-commerce</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>

                        <ul id="dropdown-example" class="hidden py-2 space-y-2">
                            <li>
                                <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Products</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Billing</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Invoice</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Kanban</span>
                            <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                            <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"/>
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Sign In</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z"/>
                                <path d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z"/>
                                <path d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z"/>
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Sign Up</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-------------End Drawer menu--------------------->

        <!-----------------Start Logo--------------------->
        <div class ="btn-logo flex flex-row justify-center w-1/3">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">AGRA</span>
            </a>
        </div>
        <!-----------------End Logo--------------------->


        <!---------------Start User Profile btn img---------------->
        <div class ="btn-profile flex flex-row justify-end w-1/3">
            <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="user photo">
            </button>
        </div>
        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">

            <!---------------End User Profile btn img---------------->


            <!--------------------------Start Dropdown btn User profile  -------------------->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                <div class="px-4 py-3">
                    <span class="block text-sm text-gray-900 dark:text-white">Lance Rizzel Cortsheesh</span>
                    <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">iloveubaby@gmail.com</span>
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

            <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
            <!--------------------------End Dropdown btn User profile  -------------------->

        </div>
    </div>
</nav>
<!--=====================================End Navbar=====================================-->


<!--=====================================Start outerDiv/MainDiv-=====================================-->
<div class="outerDiv flex flex-wrap flex-row pb-5 pl-5 pr-5 bg-gradient-to-r from-blue-700 to-blue-500 min-h-auto ">
    <!--Inner div-->
    <div class="innerDiv xl:flex bg-gray-50 max-h-[91vh] w-full rounded-lg xl overflow-auto">
        <!-------------------------Start leftPanel----------------------->
        <div class="left-panel flex flex-col  bg-trnsparent h-auto w-full p-10">

            <!--1 div-->
            <div class ="lbl-course p-5 bg-transparent rounded-md">
                <h1 class="text-5xl font-bold text-blue-600">Hi Lance</h1>
                <h3 class="text-2xl text-blue-400">Time to learn back to square one but with fun.</h1>
            </div>

            <!--2 div Page Tabs -->
            <div class="nav-section flex content-center bg-transparent h-16 w-full pl-2">
                <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 w-full">
                    <ul class="flex flex-wrap -mb-px">
                        <li class="me-2">
                            <a href="#" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 text-lg font-semibold" aria-current="page">Courses</a>
                        </li>
                        <li class="me-2">
                            <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-blue-500 dark:hover:text-gray-300 text-lg font-semibold">Lessons</a>
                        </li>
                        <li class="me-2">
                            <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-blue-500 dark:hover:text-gray-300 text-lg font-semibold">Modules</a>
                        </li>
                        <li>
                            <a class="inline-block p-4 text-gray-400 rounded-t-lg cursor-not-allowed dark:text-gray-500 text-lg font-semibold">Game</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--3 div Courses Content-->
            <div class = "learM-section flex flex-col bg-gray-200 h-[42rem] w-full rounded-lg overflow-auto items-center p-10 shadow-inner gap-y-4">
                @foreach($courses as $course)

                    <a href="/courses/{{$course->id}}" class="flex flex-col items-center bg-white rounded-lg shadow h-xl md:flex-row md:w-[900px] hover:bg-blue-200 p-10">
                        <img class="object-cover w-full rounded-t-lg h-full md:h-auto md:w-72 md:rounded-none md:rounded-s-lg" src="image-course.png" alt="">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-blue-600 dark:text-white">{{$course->CourseName}}</h5>
                            <p class="mb-3 font-normal text-gray-400 dark:text-gray-400">{{$course->CourseDescription}}</p>
                        </div>
                    </a>

                @endforeach
            </div>
        </div>
        <!-------------------------End leftPanel----------------------->

        <!-------------------------Start RightPanel----------------------->
        <div class="right-panel flex flex-col bg-transparent rounded-r-lg h-auto xl:w-2/5 w-full p-5 gap-8">

            <div></div>
            <div></div>
            <!--------------Start Agenda-------------->
            <div class="agenda flex flex-col pl-7 pr-7 pb-7 pt-2 bg-white h-1/3 w-full rounded-lg overflow-auto shadow">
                <!----Start lbl and border line---->
                <h1 class="flex  mb-3 text-2xl font-semibold text-gray-900 dark:text-white border-b-2 border-gray-300 pb-2">Agenda </h1>
                <ol class="relative border-s border-gray-200 dark:border-gray-700">

                    <!----Agenda deadline 1---->
                    @foreach($tasks as $task)
                    <li class="mb-10 ms-6">
                            <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">{{$task->TaskName}}</h3>
                        <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Deadline: {{$task->Deadline}}</time>
                        <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700 gap-5">
                            Start
                            <svg class="w-5 h-3.5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" >
                                <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>
                            </svg>
                        </a>
                    </li>
                    @endforeach

                    <!----End Agenda deadline---->
                </ol>
                <!----End lbl and border line---->
            </div>
            <!--------------End Agenda-------------->


            <!--------------Start Calendar-------------->
            <div class="calendar flex flex-col pl-7 pr-7 pb-7 pt-2 bg-white h-auto w-full rounded-lg overflow-auto shadow">
                <!----Start btn L&R lbl month ---->
                <div class="flex justify-around items-center mb-4">
                    <div class="left flex flex-row justify-start w-2/4">
                        <h2 id="currentMonthYear" class="text-lg font-bold"></h2>
                    </div>
                    <div class="right flex flex-row justify-end w-2/4 ">
                        <div id="prevMonth" class="cursor-pointer">&lt;</div>
                        <div class="w-10"></div>
                        <div id="nextMonth" class="cursor-pointer">&gt;</div>
                    </div>
                </div>
                <!----End btn L&R lbl month ---->


                <!----Start Weeks and dates grid ---->
                <div class="grid grid-cols-7">
                    <div class="text-center font-bold">Sun</div>
                    <div class="text-center font-bold">Mon</div>
                    <div class="text-center font-bold">Tue</div>
                    <div class="text-center font-bold">Wed</div>
                    <div class="text-center font-bold">Thu</div>
                    <div class="text-center font-bold">Fri</div>
                    <div class="text-center font-bold">Sat</div>
                </div>
                <div id="calendar" class="grid grid-cols-7 gap-4">
                    <!-- Week numbers and days is on script -->
                </div>
                <!----End Weeks and dates grid ---->
            </div>
            <!--------------End Calendar-------------->

        </div>
    </div>
    <!--=====================================End outerDiv/MainDiv-=====================================-->


    <!--------Calendar Script--------->
    <!--------NOTE: Make a seperate script file, just import--------->
    <script>
        const calendar = document.getElementById('calendar');
        const currentMonthYear = document.getElementById('currentMonthYear');
        const prevMonth = document.getElementById('prevMonth');
        const nextMonth = document.getElementById('nextMonth');

        let currentDate = new Date();

        function generateCalendar(date) {
            calendar.innerHTML = '';

            const today = new Date(); // Get today's date

            const firstDayOfMonth = new Date(date.getFullYear(), date.getMonth(), 1);
            const lastDayOfMonth = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            // Display month and year
            currentMonthYear.textContent = `${date.toLocaleString('default', { month: 'long' })} ${date.getFullYear()}`;

            // Generate days
            let dayOfWeek = firstDayOfMonth.getDay(); // Sunday: 0, Monday: 1, ...
            for (let i = 0; i < dayOfWeek; i++) {
                const emptyDayElement = document.createElement('div');
                emptyDayElement.classList.add('p-3', 'border', 'border-gray-200', 'rounded', 'w-10', 'h-10', 'hover:text-blue-700', 'hover:border-blue-500');
                calendar.appendChild(emptyDayElement);
            }

            for (let i = 1; i <= lastDayOfMonth.getDate(); i++) {
                const dayElement = document.createElement('div');
                dayElement.textContent = i;
                dayElement.classList.add('p-3', 'border', 'border-gray-200', 'rounded', 'cursor-pointer', 'w-10', 'h-10', 'hover:text-blue-700', 'hover:border-blue-500');
                dayElement.setAttribute('data-date', `${date.getFullYear()}-${date.getMonth() + 1}-${i}`);

                if (date.getFullYear() === today.getFullYear() && date.getMonth() === today.getMonth() && i === today.getDate()) {
                    // Highlight today's date
                    dayElement.classList.add('bg-blue-700', 'text-white');
                }

                dayElement.addEventListener('click', () => {
                    alert(`Clicked on ${date.getFullYear()}-${date.getMonth() + 1}-${i}`);
                    // You can replace the alert with any functionality you want
                });
                calendar.appendChild(dayElement);
            }
        }

        generateCalendar(currentDate);

        // Event listeners for previous and next buttons
        prevMonth.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            generateCalendar(currentDate);
        });

        nextMonth.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            generateCalendar(currentDate);
        });
    </script>

</body>
</html>
