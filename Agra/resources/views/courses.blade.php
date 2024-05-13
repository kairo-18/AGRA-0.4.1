<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agra Courses</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <script src="{{asset('js/app.js')}}"></script>
    <style>
        .navflex{
            height: 89px;
        }

    </style>
</head>
<body>

<div class="navflex bg-white h-60 w-full rounded-lg">
    <!----------------------------start navbar--------------------------------------->
    <div class="navbar bg-blue-950 text-white absolute p-5">

        <div class="drawer flex justify-between">
            <!--start drawer-->
            <input id="my-drawer" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">
                <label for="my-drawer" class="btn btn-primary drawer-button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </label>
            </div>
            <!--end drawer-->

            <!--start Logo/Brand-->
            <div class="flex">
                <a class="btn btn-ghost text-xl">AGRA</a>
            </div>
            <!--end Logo/Brand-->

            <!--start Logo/Brand-->
            <div class="flex">
                <a class="btn btn-primary text-xl">Account</a>
            </div>
            <!--end Logo/Brand-->

            <!--start toggled drawer-->
            <div class="drawer-side">
                <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
                <ul class="menu p-4 w-80 min-h-full bg-base-200 text-base-content">

                    <li><a>Sidebar Item 1</a></li>
                    <li><a>Sidebar Item 2</a></li>

                </ul>
            </div>
            <!--end toggled drawer-->
        </div>
    </div>
</div>
<!----------------------------End Navbar--------------------------------------->


<!----------------------------start outerDiv/MainDiv--------------------------------------->
<div class="outerDiv flex flex-wrap flex-row pb-5 pl-5 pr-5 bg-blue-950 min-h-full ">
    <!--start innerDiv-->
    <div class="innerDiv flex bg-white h-screen w-full rounded-lg">
        <!--start leftPanel-->
        <div class="left-panel flex flex-col  bg-slate-800 rounded-l-lg h-auto w-4/5 p-10">

            <!--1 div-->
            <div class="title-section flex p-3 bg-white h-16 w-full rounded-lg">
                <h1>Courses</h1>
            </div>

            <!--2 div-->
            <div class="nav-section flex content-center bg-white h-16 w-full rounded-lg">
                <div class="dropdown dropdown-bottom">
                    <div tabindex="0" role="button" class="btn w-68">Drop Down > </div>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a>Item 1</a></li>
                        <li><a>Item 2</a></li>
                    </ul>
                </div>

                <div class="dropdown dropdown-bottom">
                    <div tabindex="0" role="button" class="btn w-68">Drop Down > </div>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a>Item 1</a></li>
                        <li><a>Item 2</a></li>
                    </ul>
                </div>
            </div>
            <!--3 div-->
            <div class = "learM-section flex flex-col bg-white h-dvh w-full rounded-lg overflow-auto">
                <div class="flex flex-wrap justify-around p-5 gap-y-10">



                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="rounded-t-lg" src="/sampleImg.png" alt="" />
                        </a>
                        <div class="p-5">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Read more
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="rounded-t-lg" src="/sampleImg.png" alt="" />
                        </a>
                        <div class="p-5">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Read more
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="rounded-t-lg" src="/sampleImg.png" alt="" />
                        </a>
                        <div class="p-5">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Read more
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>



                </div>
            </div>

        </div>
        <!--End leftPanel-->

        <!--start rightPanel-->
        <div class="right-panel flex flex-col bg-neutral-700 rounded-r-lg h-auto w-1/5">
            <div class="profile flex p-3 bg-white h-16 w-full rounded-lg">Profile</div>
            <div class="agenda flex p-3 bg-white h-16 w-full rounded-lg">Agenda</div>
            <div class="calendar flex p-3 bg-white h-16 w-full rounded-lg">calendar</div>
        </div>

    </div>
    <!--End outerDiv-->
</div>
<!--End outerDiv-->

</body>
</html>
