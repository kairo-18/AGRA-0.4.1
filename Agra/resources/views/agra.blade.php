<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AGRA</title>
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
    <div class="innerDiv 2xl:flex bg-transparent h-full w-full rounded-xl overflow-hidden">
        <div class="left-panel flex flex-col  bg-gray-300 h-5/6 3xl:w-2/5 p-10 gap-y-10 ">

            <section class="bg-transparent dark:bg-gray-900">
                <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
                    <h1 class="mb-4 text-5xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-8xl dark:text-white">Learn Programming where it meets Gaming</h1>
                    <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">Here at AGRA we focus on learning where programming can be fun.</p>
                    <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                        <a href="/courses" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                            Get started
                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                        <a href="about" class="py-3 px-5 sm:ms-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-70">
                            Learn more
                        </a>
                    </div>
                </div>
            </section>


        </div>
        <div class="right-panel flex flex-row bg-gray-300 h-auto 3xl:w-3/5 w-full p-5 gap-8 items-end max-xl:hidden">
            <figure class="relative max-w-sm transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0 focus:ring-4  focus:outline-none ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 ">
                <a href="/">
                    <img class="rounded-full" src="5.png" alt="image description">
                </a>
                <figcaption class="absolute px-4 text-lg text-white bottom-32">
                    <h1 class="font-extrabold tracking-tight leading-none text-blue-800 md:text-5xl lg:text-3xl dark:text-white bg-white rounded-xl">LEARNING</h1>
                </figcaption>
            </figure>

            <figure class="relative max-w-sm transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0 mb-20 focus:ring-4  focus:outline-none ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                <a href="/">
                    <img class="rounded-full" src="6.png" alt="image description">
                </a>
                <figcaption class="absolute px-4 text-lg text-white bottom-32">
                    <h1 class="font-extrabold tracking-tight leading-none text-blue-800 md:text-5xl lg:text-3xl dark:text-white bg-white rounded-xl">PROGRAMMING</h1>
                </figcaption>
            </figure>

            <figure class="relative max-w-sm transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0 mb-40 focus:ring-4  focus:outline-none ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                <a href="/">
                    <img class="rounded-full" src="7.png" alt="image description">
                </a>
                <figcaption class="absolute px-4 text-lg text-white bottom-32 ">
                    <h1 class="font-extrabold tracking-tight leading-none text-blue-800 md:text-5xl lg:text-3xl dark:text-white bg-white rounded-xl">GAMING</h1>
                </figcaption>
            </figure>
        </div>
    </div>



    <div class="innerDiv xl:flex bg-transparent h-full w-full overflow-auto shadow-lg dark:bg-gray-800 dark:border-gray-700 p-16">

        <!-------------------------Start leftPanel----------------------->



        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-[35rem]">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="1.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="2.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="3.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="6.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 5 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="7.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
            </div>
            <!-- Slider controls -->
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
            </button>
        </div>

    </div>


    <div class="innerDiv 2xl:flex bg-transparent h-full w-full rounded-t-xl overflow-hidden">

        <div class="right-panel flex flex-row bg-gray-300 h-auto 3xl:w-3/5 w-full p-5 gap-8 items-center">
            <p class="text-left rtl:text-right text-gray-500 dark:text-gray-400">AGRA is an innovative gamified scoring system designed to enhance learning in Java and C# programming. By integrating engaging game mechanics with advanced data analytics, AGRA offers a dynamic and interactive educational experience. It not only evaluates coding proficiency but also provides insightful feedback to help learners improve their skills. AGRA is ideal for aspiring developers seeking a fun and effective way to master programming concepts and stay motivated throughout their learning journey.</p>
        </div>

        <div class="left-panel flex flex-col  bg-gray-300 h-5/6 3xl:w-4/5 p-10 gap-y-10 pl-10">
            <p class="text-4xl font-medium leading-loose text-gray-900 dark:text-white">AGRA: Revolutionize Your Coding Skills with Gamified Learning and Smart Analytics</p>
        </div>

    </div>

    <div class="innerDiv xl:flex bg-gray-300 h-full w-full overflow-auto p-10 justify-center gap-x-10 rounded-b-xl">

        <figure class="relative max-w-lg transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
            <a href="/">
                <img class="rounded-lg" src="1.png" alt="image description">
            </a>
            <figcaption class="absolute px-4 text-4xl font-bold text-white bottom-96">
                <p>AGRA: Elevate Your Coding Skills with Gamified Learning and Data Analytics</p>
            </figcaption>
        </figure>

        <figure class="relative max-w-lg transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
            <a href="/">
                <img class="rounded-lg" src="2.png" alt="image description">
            </a>
            <figcaption class="absolute px-4 text-4xl font-bold text-blue-800 bottom-6">
                <p>Master Java and C# with AGRA – Where Gamification Meets Insightful Analytics</p>
            </figcaption>
        </figure>

        <figure class="relative max-w-lg transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
            <a href="/">
                <img class="rounded-lg" src="3.png" alt="image description">
            </a>
            <figcaption class="absolute px-4 text-4xl font-bold text-white bottom-96    ">
                <p>Transform Your Programming Journey: AGRA’s Gamified Scoring & Data Analytics</p>
            </figcaption>
        </figure>

        <figure class="relative max-w-lg transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
            <a href="/">
                <img class="rounded-lg" src="4.png" alt="image description">
            </a>
            <figcaption class="absolute px-4 text-4xl font-bold text-blue-800 bottom-6">
                <p>Unlock Your Potential in Java and C# with AGRA’s Interactive Learning System</p>
            </figcaption>
        </figure>



    </div>






</body>
</html>
