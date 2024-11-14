<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recommed</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <script src="{{asset('js/app.js')}}"></script>

</head>
<style>
    .line-clamp {
        display: -webkit-box;            /* Enables Flexbox layout */
        -webkit-box-orient: horizontal;   /* Sets orientation to vertical */
        overflow: hidden;                /* Hides overflow content */
        -webkit-line-clamp: 2;          /* Limits to 2 lines */
        max-height: calc(1.5em * 2);    /* Sets max height based on line count */
        transition: max-height 0.3s ease, transform 0.3s ease; /* Smooth transition for max-height and transform */
        position: relative;              /* For positioning ellipsis */
    }

    .line-clamp:hover {
        -webkit-line-clamp: unset;      /* Removes line clamp on hover */
        max-height: none;                /* Allows full height on hover */
        transform: scale(1.05);          /* Slight scale up on hover */
        z-index: 10;                     /* Bring to front on hover */
    }

    .line-clamp::after {
        content: '...';                  /* Displays ellipsis */
        position: absolute;              /* For positioning ellipsis */
        bottom: 0;                       /* Aligns at bottom */
        right: 0;                        /* Aligns at right */
        background-color: white;         /* Matches background color */
        padding-left: 0.2em;             /* Adds space before ellipsis */
        transition: opacity 0.3s ease;   /* Smooth transition for ellipsis */
    }

    .line-clamp:hover::after {
        opacity: 0;                     /* Hides ellipsis on hover */
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
<div class="outerDiv flex flex-wrap flex-row bg-gradient-to-r from-blue-800 to-blue-600 min-h-screen pl-10 pr-10 pb-10">
    <!--Inner div-->
    <div class="innerDiv xl:flex flex-col bg-transparent min-h-screen w-full rounded-xl overflow-hidden">

        <div class="Recommed-panel flex flex-col justify-start bg-white h-full xl:w-full w-full p-10 gap-5 recommended-panel">
    <h1 class="font-bold text-xl text-blue-800">Recommended</h1>
    <div class="flex flex-col flex-wrap justify-start bg-gray-100 h-full pt-10 pl-10 pr-10 pb-14 gap-5 overflow-x-auto overflow-y-hidden scrollbar-thin rounded-xl shadow-inner">
        <div class="flex flex-row justify-start gap-5 p-5 bg-gray-100 rounded-xl" id="lessonsContainer">
            @foreach($lessons as $lesson)
            <a href="/agraLessons/{{$lesson->course->id}}/{{$lesson->id}}" class="yt-vid w-[18rem] h-[13rem] focus:outline-none transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bg-white shadow-md rounded-xl lesson-card">
                <div class="h-1/5">
                    <div class="w-full h-32 p-3 rounded-xl bg-cover bg-center bg-image shadow-md">
                        <h1 class="font-bold text-xs text-white">{{$lesson->LessonName}}</h1>
                    </div>
                    <div class="w-full p-3 bg-white rounded-xl">
                        <h1 class="font-bold text-xs text-blue-800">{{$lesson->LessonName}}</h1>
                        <h3 class="font-normal text-xs text-blue-800">AGRA LESSON</h3>
                    </div>
                    <div class="w-full p-2 flex flex-wrap bg-white line-clamp rounded-xl">
                        @foreach($lesson->categories as $category)
                        <div class="badge mb-1 ml-1">
                            <span class="hover:bg-blue-800 hover:text-white bg-blue-200 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 mb-3">{{$category->name}}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>



        <div class="Recommed-panel flex flex-col justify-start bg-white h-full xl:w-full w-full p-10 gap-5 recommended-panel">
            <h1 class="font-bold text-xl text-blue-800">You might like</h1>
            <div class="flex flex-col flex-wrap justify-start bg-gray-100 h-full pt-10 pl-10 pr-10 pb-14 gap-5 overflow-x-auto overflow-y-hidden scrollbar-thin rounded-xl shadow-inner">
                <div class="flex flex-row justify-start gap-5 p-5 bg-gray-100 rounded-xl" id="lessonsContainer">
                    @foreach($relatedLessons as $lesson)
                        <a href="/agraLessons/{{$lesson->course->id}}/{{$lesson->id}}" class="yt-vid w-[18rem] h-[13rem] focus:outline-none transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bg-white shadow-md rounded-xl lesson-card">
                            <div class="h-1/5">
                                <div class="w-full h-48 p-3 rounded-xl bg-cover bg-center bg-image shadow-md" style="background-image: url('/image-course.png');">
                                    <h1 class="font-bold text-xs text-white">{{$lesson->LessonName}}</h1>
                                </div>
                                <div class="w-full p-3 bg-white rounded-xl">
                                    <h1 class="font-bold text-xs text-blue-800">{{$lesson->LessonName}}</h1>
                                    <h3 class="font-normal text-xs text-blue-800">AGRA LESSON</h3>
                                </div>
                                <div class="w-full p-2 flex flex-wrap bg-white line-clamp rounded-xl">
                                    @foreach($lesson->categories as $category)
                                        <div class="badge mb-1 ml-1">
                                            <span class="hover:bg-blue-800 hover:text-white bg-blue-200 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 mb-3">{{$category->name}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>



<script>
    const sectionId = "{{$user->section->id}}";
    const username = "{{Auth::user()->name}}";
</script>
<script src="/agraNotification.js"></script>
<script>
    // Array of background images
    const backgroundImages = [
        'Bg-Reco1.png', 'Bg-Reco2.png', 'Bg-Reco3.png',
        'Bg-Reco4.png', 'Bg-Reco5.png', 'Bg-Reco6.png', 'Bg-Reco7.png'
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


</body>
</html>
