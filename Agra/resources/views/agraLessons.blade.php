<!-- Lesson Tab -->

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lessons</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <script src="{{asset('js/app.js')}}"></script>

</head>
<style>
    .line-clamp {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
        -webkit-line-clamp: 4; /* Adjust this number for the line count */
        max-height: calc(2em * 3); /* Adjust based on font size and line count */
        white-space: normal;
        position: relative;
    }

    .line-clamp::after {
        content: '...';
        position: absolute;
        bottom: 0;
        right: 0;
        background-color: white; /* Match this to the background color to make the dots blend in */
        padding-left: 0.2em;
    }
</style>
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
<div class="outerDiv flex flex-wrap flex-row pb-5 pl-5 pr-5 bg-gradient-to-r from-blue-800 to-blue-600 min-h-auto ">
    <!--Inner div-->
    <div class="innerDiv xl:flex bg-gray-50 h-full w-full rounded-lg xl overflow-auto">
        <!-------------------------Start leftPanel----------------------->
        <div class="left-panel flex flex-col  bg-trnsparent h-screen w-full p-10">

            <!--1 div-->
            <div class ="lbl-course p-5 bg-transparent rounded-md">
                <h1 class="text-3xl font-bold text-blue-800">Welcome to {{$course->CourseName}} {{$course->id}}</h1>
                <h3 class="text-xl text-blue-600">Time to learn back to square one but with fun.</h1>
            </div>

            <!--2 div Page Tabs -->
            <div class="nav-section flex content-center bg-transparent h-16 w-full pl-2">
                <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 w-full">
                    <ul class="flex flex-wrap -mb-px">
                        <li class="me-2">
                            <a href="/agraCourses" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-blue-500 dark:hover:text-gray-300 text-xs font-semibold">Courses</a>
                        </li>
                        <li class="me-2">
                            <a href="/agraCourses/{{$course->id}}" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 text-xs font-semibold" aria-current="page">Lessons</a>
                        </li>
                        <li class="me-2">
                            <a href="/agraCourses/References" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-blue-500 dark:hover:text-gray-300 text-xs font-semibold">References</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--3 div Courses Content-->
            <div class = "learM-section flex flex-wrap bg-gray-200 h-full w-full rounded-lg overflow-auto items-start p-10 shadow-inner gap-y-20 gap-x-5">
                @foreach($lessons as $lesson)
                    <a href="/agraLessons/{{$course->id}}/{{$lesson->id}}" class="yt-vid w-[18rem] h-[13rem] focus:outline-none transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bg-white shadow-md rounded-xl lesson-card">
                        <div class="h-1/5">
                            <div class="w-full h-32 p-3 rounded-xl bg-cover bg-center bg-image shadow-md">
                                <!-- Set the background image dynamically if necessary -->
                            </div>
                            <div class="w-full p-3 bg-white rounded-xl">
                                <h2 class="bg-blue-600 rounded-xl font-bold text-xs text-white p-1 w-fit mb-2">Lessons ⦿</h2>
                                <h1 class="font-bold text-xs text-blue-800">{{$lesson->LessonName}}</h1>
                                <p class="font-normal text-xs text-blue-800 line-clamp">{{$lesson->LessonDescription}}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <!-------------------------End leftPanel----------------------->

        <!-------------------------Start RightPanel----------------------->
        <div class="right-panel flex flex-col bg-transparent rounded-r-lg h-screen xl:w-2/5 w-full p-5 gap-8">


            <!--------------Start Agenda-------------->
            <div class="agenda flex flex-col pl-7 pr-7 pb-7 pt-2 bg-white h-[30rem] w-full rounded-lg overflow-auto shadow">
                <!----Start lbl and border line---->
                <h1 class="flex mb-3 text-xl font-semibold text-blue-900 dark:text-white border-b-2 border-gray-300 pb-2">
                    Agenda
                    <a href="{{ url(request()->path() . '/grades') }}" class="ml-auto text-xs text-blue-600 mt-1">View grades</a>
                </h1>

                <ol class="relative border-s border-gray-200 dark:border-gray-700">

                    <!----Agenda deadline 1---->
                    @foreach($tasks as $task)
                        <li class="mb-10 ms-6">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 text-xs rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </span>Type

                            <h3 class="flex items-center mb-1 text-xs font-semibold text-gray-900 dark:text-white">{{$task->TaskName}}</h3>
                            <time class="block mb-2 text-xs font-normal leading-none text-gray-400 dark:text-gray-500">{{ $task->DateGiven->format('m-d-Y') }} - {{ $task->Deadline->format('m-d-Y') }}</time>
                            <a href="/agraTasks/{{$task->id}}" class="inline-flex items-center px-4 py-2 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700 gap-5">
                                Go
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

            @if ($allTasks->count() > 0)
                <x-calendar :tasks="$allTasks" />
            @endif
        </div>
        <!--------------End Calendar-------------->

    </div>
</div>
<!--=====================================End outerDiv/MainDiv-=====================================-->
<script>
    // Array of background images
    const backgroundImages = [
        '/bg-agraL1.png', '/bg-agraL2.png', '/bg-agraL3.png',
        '/bg-agraL4.png', '/bg-agraL5.png', '/bg-agraL6.png', '/bg-agraL7.png'
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
    const sectionId = "{{$user->section->id}}";
    const username = "{{Auth::user()->name}}";
</script>
<script src="/agraNotification.js"></script>

</body>
</html>
