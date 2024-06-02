<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
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


        <div class="Recommed-panel flex flex-col flex-wrap justify-start bg-white h-[30rem] xl:w-full w-full p-5 gap-5 overflow-x-auto overflow-y-hidden scrollbar-thin">
            <h1 class="font-bold text-3xl text-blue-800">Recommeded </h1>


            <div class="flex flex-row justify-start gap-5">

                <div class="yt-vid w-96 h-72 bg-white">
                    <div class="h-4/5">
                        <img src="1.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                    </div>
                    <div class="h-1/5 flex">
                        <div class ="w-4/5">
                            <h1 class="font-bold text-xl text-blue-800">LESSON NAME</h1>
                            <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                        </div>
                        <div class ="w-1/5 p-3">
                            <span class="bg-blue-200 text-blue-800 text-base font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">JAVA</span>
                        </div>
                    </div>
                </div>


                <div class="yt-vid w-96 h-72 bg-white">
                    <div class="h-4/5">
                        <img src="1.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                    </div>
                    <div class="h-1/5 flex">
                        <div class ="w-4/5">
                            <h1 class="font-bold text-xl text-blue-800">LESSON NAME</h1>
                            <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                        </div>
                        <div class ="w-1/5 p-3">
                            <span class="bg-blue-200 text-blue-800 text-base font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">JAVA</span>
                        </div>
                    </div>
                </div>


                <div class="yt-vid w-96 h-72 bg-white">
                    <div class="h-4/5">
                        <img src="1.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                    </div>
                    <div class="h-1/5 flex">
                        <div class ="w-4/5">
                            <h1 class="font-bold text-xl text-blue-800">LESSON NAME</h1>
                            <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                        </div>
                        <div class ="w-1/5 p-3">
                            <span class="bg-blue-200 text-blue-800 text-base font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">JAVA</span>
                        </div>
                    </div>
                </div>


                <div class="yt-vid w-96 h-72 bg-white">
                    <div class="h-4/5">
                        <img src="1.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                    </div>
                    <div class="h-1/5 flex">
                        <div class ="w-4/5">
                            <h1 class="font-bold text-xl text-blue-800">LESSON NAME</h1>
                            <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                        </div>
                        <div class ="w-1/5 p-3">
                            <span class="bg-blue-200 text-blue-800 text-base font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">JAVA</span>
                        </div>
                    </div>
                </div>


                <div class="yt-vid w-96 h-72 bg-white">
                    <div class="h-4/5">
                        <img src="1.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                    </div>
                    <div class="h-1/5 flex">
                        <div class ="w-4/5">
                            <h1 class="font-bold text-xl text-blue-800">LESSON NAME</h1>
                            <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                        </div>
                        <div class ="w-1/5 p-3">
                            <span class="bg-blue-200 text-blue-800 text-base font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">JAVA</span>
                        </div>
                    </div>
                </div>


                <div class="yt-vid w-96 h-72 bg-white">
                    <div class="h-4/5">
                        <img src="1.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                    </div>
                    <div class="h-1/5 flex">
                        <div class ="w-4/5">
                            <h1 class="font-bold text-xl text-blue-800">LESSON NAME</h1>
                            <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                        </div>
                        <div class ="w-1/5 p-3">
                            <span class="bg-blue-200 text-blue-800 text-base font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">JAVA</span>
                        </div>
                    </div>
                </div>


                <div class="yt-vid w-96 h-72 bg-white">
                    <div class="h-4/5">
                        <img src="1.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                    </div>
                    <div class="h-1/5 flex">
                        <div class ="w-4/5">
                            <h1 class="font-bold text-xl text-blue-800">LESSON NAME</h1>
                            <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                        </div>
                        <div class ="w-1/5 p-3">
                            <span class="bg-blue-200 text-blue-800 text-base font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">JAVA</span>
                        </div>
                    </div>
                </div>


                <div class="yt-vid w-96 h-72 bg-white">
                    <div class="h-4/5">
                        <img src="1.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                    </div>
                    <div class="h-1/5 flex">
                        <div class ="w-4/5">
                            <h1 class="font-bold text-xl text-blue-800">LESSON NAME</h1>
                            <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                        </div>
                        <div class ="w-1/5 p-3">
                            <span class="bg-blue-200 text-blue-800 text-base font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">JAVA</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>









        <div class="Recommed-panel flex flex-col justify-start bg-white h-full xl:w-full w-full p-10 gap-5">
            <h1 class="font-bold text-3xl text-blue-800">More </h1>


            <div class="flex flex-row flex-wrap justify-center gap-5 bg-gray-300 rounded-xl p-10">

                <div class="yt-vid w-96 h-72">
                    <div class="h-4/5">
                        <img src="image-course.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                    </div>
                    <div class="h-1/5 flex">
                        <div class ="w-4/5">
                            <h1 class="font-bold text-xl text-blue-800">LESSON NAME</h1>
                            <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                        </div>
                        <div class ="w-1/5 p-3">
                            <span class="bg-blue-200 text-blue-800 text-base font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">JAVA</span>
                        </div>
                    </div>
                </div>


                <div class="yt-vid w-96 h-72">
                    <div class="h-4/5">
                        <img src="1.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                    </div>
                    <div class="h-1/5 flex">
                        <div class ="w-4/5">
                            <h1 class="font-bold text-xl text-blue-800">LESSON NAME</h1>
                            <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                        </div>
                        <div class ="w-1/5 p-3">
                            <span class="bg-blue-200 text-blue-800 text-base font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">JAVA</span>
                        </div>
                    </div>
                </div>


                <div class="yt-vid w-96 h-72">
                    <div class="h-4/5">
                        <img src="1.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                    </div>
                    <div class="h-1/5 flex">
                        <div class ="w-4/5">
                            <h1 class="font-bold text-xl text-blue-800">LESSON NAME</h1>
                            <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                        </div>
                        <div class ="w-1/5 p-3">
                            <span class="bg-blue-200 text-blue-800 text-base font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">JAVA</span>
                        </div>
                    </div>
                </div>


                <div class="yt-vid w-96 h-72">
                    <div class="h-4/5">
                        <img src="1.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                    </div>
                    <div class="h-1/5 flex">
                        <div class ="w-4/5">
                            <h1 class="font-bold text-xl text-blue-800">LESSON NAME</h1>
                            <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                        </div>
                        <div class ="w-1/5 p-3">
                            <span class="bg-blue-200 text-blue-800 text-base font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">JAVA</span>
                        </div>
                    </div>
                </div>


                <div class="yt-vid w-96 h-72">
                    <div class="h-4/5">
                        <img src="1.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                    </div>
                    <div class="h-1/5 flex">
                        <div class ="w-4/5">
                            <h1 class="font-bold text-xl text-blue-800">LESSON NAME</h1>
                            <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                        </div>
                        <div class ="w-1/5 p-3">
                            <span class="bg-blue-200 text-blue-800 text-base font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">JAVA</span>
                        </div>
                    </div>
                </div>


                <div class="yt-vid w-96 h-72">
                    <div class="h-4/5">
                        <img src="1.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                    </div>
                    <div class="h-1/5 flex">
                        <div class ="w-4/5">
                            <h1 class="font-bold text-xl text-blue-800">LESSON NAME</h1>
                            <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                        </div>
                        <div class ="w-1/5 p-3">
                            <span class="bg-blue-200 text-blue-800 text-base font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">JAVA</span>
                        </div>
                    </div>
                </div>


                <div class="yt-vid w-96 h-72">
                    <div class="h-4/5">
                        <img src="1.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                    </div>
                    <div class="h-1/5 flex">
                        <div class ="w-4/5">
                            <h1 class="font-bold text-xl text-blue-800">LESSON NAME</h1>
                            <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                        </div>
                        <div class ="w-1/5 p-3">
                            <span class="bg-blue-200 text-blue-800 text-base font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">JAVA</span>
                        </div>
                    </div>
                </div>


                <div class="yt-vid w-96 h-72">
                    <div class="h-4/5">
                        <img src="1.png" class="w-full lg:max-w-xl rounded-lg h-full shadow-xl" alt="...">
                    </div>
                    <div class="h-1/5 flex">
                        <div class ="w-4/5">
                            <h1 class="font-bold text-xl text-blue-800">LESSON NAME</h1>
                            <h3 class="font-normal text-base text-blue-800">AGRA LESSON</h3>
                        </div>
                        <div class ="w-1/5 p-3">
                            <span class="bg-blue-200 text-blue-800 text-base font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">JAVA</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</div>






</body>
</html>
