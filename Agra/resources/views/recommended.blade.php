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
    <div class="innerDiv xl:flex flex-col bg-transparent h-full w-full rounded-xl overflow-hidden">

        <div class="Recommed-panel flex flex-col justify-start bg-white h-full xl:w-full w-full p-10 gap-5">
            <h1 class="font-bold text-4xl text-blue-800">Recommended </h1>
            <div class="Recommed-panel flex flex-col flex-wrap justify-start bg-gray-100 h-full pt-10 pl-10 pr-10 pb-14 gap-5 overflow-x-auto overflow-y-hidden scrollbar-thin rounded-xl shadow-inner">
                <div class="flex flex-row justify-start gap-5 p-3">
                    @foreach($lessons as $lesson)
                    <a href="/agraLessons/{{$lesson->course->id}}/{{$lesson->id}}" class="yt-vid w-[27rem] h-72 focus:outline-none transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 rounded-xl">
                        <div class="h-4/5">
                            <img src="image-course.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                        </div>
                        <div class="h-1/5 flex">
                            <div class ="w-3/5">
                                <h1 class="font-bold text-2xl text-blue-800">{{$lesson->LessonName}}</h1>
                                <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                            </div>
                            <div class ="w-2/5 p-3 flex flex-row-reverse flex-wrap">
                                @foreach($lesson->categories as $category)
                                <div class="badge mb-2 ml-2">
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



        <div class="Recommed-panel flex flex-col justify-start bg-white h-full xl:w-full w-full p-10 gap-5">
            <h1 class="font-bold text-4xl text-blue-800">You might like </h1>
            <div class="Recommed-panel flex flex-col justify-start bg-gray-200 h-full xl:w-full w-full pt-5 pl-5 pr-5 pb-8 gap-5 rounded-xl">

            <div class="flex justify-end gap-5 rounded-xl p-10 flex-row-reverse flex-wrap ">
                @foreach($relatedLessons as $lesson)
                <a href="/agraLessons/{{$lesson->course->id}}/{{$lesson->id}}" class="yt-vid w-[27rem] h-72 focus:outline-none transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 rounded-xl mb-[5rem]">
                    <div class="h-4/5">
                        <img src="image-course.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                    </div>
                    <div class="h-1/5 flex">
                        <div class ="w-3/5">
                            <h1 class="font-bold text-2xl text-blue-800">{{$lesson->LessonName}}</h1>
                            <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                        </div>
                        <div class ="w-2/5 p-3 flex flex-row-reverse flex-wrap">
                            @foreach($lesson->categories as $category)
                                <div class="badge mb-2 ml-2">
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






</body>
</html>
